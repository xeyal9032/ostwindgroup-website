import os
import re
import subprocess
import time
from http.cookiejar import CookieJar
from pathlib import Path
from urllib.error import HTTPError, URLError
from urllib.request import HTTPCookieProcessor, Request, build_opener


ROOT = Path(__file__).resolve().parents[1]


def load_dotenv(path: Path) -> dict[str, str]:
    env = {}
    if not path.exists():
        return env
    for raw in path.read_text(encoding="utf-8").splitlines():
        line = raw.strip()
        if not line or line.startswith("#") or "=" not in line:
            continue
        k, v = line.split("=", 1)
        env[k.strip()] = v.strip().strip('"').strip("'")
    return env


def http_req(opener, req: Request) -> tuple[int, dict[str, str], bytes]:
    try:
        resp = opener.open(req, timeout=10)
        data = resp.read()
        headers = {k.lower(): v for k, v in resp.headers.items()}
        return resp.status, headers, data
    except HTTPError as e:
        data = e.read()
        headers = {k.lower(): v for k, v in e.headers.items()}
        return e.code, headers, data


def build_multipart(fields: dict[str, str], file_field: str, filename: str, content_type: str, content: bytes) -> tuple[bytes, str]:
    boundary = "----ostwindboundary" + os.urandom(8).hex()
    lines: list[bytes] = []
    for k, v in fields.items():
        lines.append(f"--{boundary}\r\n".encode())
        lines.append(f'Content-Disposition: form-data; name="{k}"\r\n\r\n'.encode())
        lines.append(v.encode() + b"\r\n")
    lines.append(f"--{boundary}\r\n".encode())
    lines.append(f'Content-Disposition: form-data; name="{file_field}"; filename="{filename}"\r\n'.encode())
    lines.append(f"Content-Type: {content_type}\r\n\r\n".encode())
    lines.append(content + b"\r\n")
    lines.append(f"--{boundary}--\r\n".encode())
    body = b"".join(lines)
    return body, boundary


def main() -> int:
    env = os.environ.copy()
    env.update(load_dotenv(ROOT / ".env"))

    host = "127.0.0.1"
    port = "8100"
    base = f"http://{host}:{port}"

    proc = subprocess.Popen(
        ["php", "-S", f"{host}:{port}", "-t", str(ROOT)],
        stdout=subprocess.DEVNULL,
        stderr=subprocess.DEVNULL,
        env=env,
    )
    try:
        jar = CookieJar()
        opener = build_opener(HTTPCookieProcessor(jar))

        # Wait server
        for _ in range(30):
            try:
                code, _, _ = http_req(opener, Request(base + "/login.php", method="GET"))
                if code == 200:
                    break
            except URLError:
                pass
            time.sleep(0.2)

        # GET login page to get CSRF
        code, _, body = http_req(opener, Request(base + "/login.php", method="GET"))
        html = body.decode("utf-8", errors="replace")
        m = re.search(r"name=['\"]csrf_token['\"]\s+value=['\"]([a-f0-9]+)['\"]", html, re.IGNORECASE)
        if not m:
            print("FAIL: csrf_token not found on login page")
            return 1
        csrf = m.group(1)

        # POST login (admin@example.com / Test1234!)
        post = f"csrf_token={csrf}&email=admin%40example.com&password=Test1234%21".encode()
        req = Request(base + "/login.php", data=post, method="POST")
        req.add_header("Content-Type", "application/x-www-form-urlencoded")
        code, _, _ = http_req(opener, req)
        if code not in (200, 302):
            print("FAIL: login POST status", code)
            return 1

        # GET upload page (should be accessible after login)
        code, _, body = http_req(opener, Request(base + "/upload.php", method="GET"))
        if code != 200:
            print("FAIL: upload page status", code)
            return 1
        html = body.decode("utf-8", errors="replace")
        m = re.search(r"name=['\"]csrf_token['\"]\s+value=['\"]([a-f0-9]+)['\"]", html, re.IGNORECASE)
        if not m:
            print("FAIL: csrf_token not found on upload page")
            return 1
        upload_csrf = m.group(1)

        # Use a known-valid 1x1 PNG (avoid relying on repo images)
        png_bytes = (
            b"\x89PNG\r\n\x1a\n"
            b"\x00\x00\x00\rIHDR"
            b"\x00\x00\x00\x01\x00\x00\x00\x01\x08\x02\x00\x00\x00"
            b"\x90wS\xde"
            b"\x00\x00\x00\x0bIDAT\x08\xd7c\xf8\xff\xff?\x00\x05\xfe\x02\xfeA\xdd\xa2\x89"
            b"\x00\x00\x00\x00IEND\xaeB`\x82"
        )
        multipart, boundary = build_multipart(
            {"csrf_token": upload_csrf},
            "photo",
            "test.png",
            "image/png",
            png_bytes,
        )
        req = Request(base + "/upload.php", data=multipart, method="POST")
        req.add_header("Content-Type", f"multipart/form-data; boundary={boundary}")
        code, _, resp_body = http_req(opener, req)
        if code != 200:
            print("FAIL: upload POST status", code)
            return 1
        resp_html = resp_body.decode("utf-8", errors="replace")
        if "Fotoğraf başarıyla yüklendi" not in resp_html and "Fotoğraf" not in resp_html:
            # show a small snippet for debugging
            print("Debug: upload response snippet:", resp_html[:300].replace("\n", "\\n"))

        # Find latest file id in DB by asking JSON delete list? (no endpoint)
        # We will just request upload page and look for serve_upload.php?id=...
        code, _, body = http_req(opener, Request(base + "/upload.php", method="GET"))
        html = body.decode("utf-8", errors="replace")
        m = re.search(r"serve_upload\.php\?id=(\d+)", html)
        if not m:
            print("FAIL: could not find serve_upload link after upload")
            return 1
        file_id = m.group(1)

        # Fetch served file
        code, headers, data = http_req(opener, Request(base + f"/serve_upload.php?id={file_id}", method="GET"))
        if code != 200:
            print("FAIL: serve_upload status", code)
            return 1
        if not headers.get("content-type", "").startswith("image/"):
            print("FAIL: serve_upload content-type", headers.get("content-type"))
            return 1
        if len(data) < 50:
            print("FAIL: served content too small")
            return 1

        print("Upload smoke test: OK")
        return 0
    finally:
        proc.terminate()
        try:
            proc.wait(timeout=3)
        except subprocess.TimeoutExpired:
            proc.kill()


if __name__ == "__main__":
    raise SystemExit(main())

