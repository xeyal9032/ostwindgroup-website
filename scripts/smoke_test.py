import os
import re
import subprocess
import time
from http.cookiejar import CookieJar
from pathlib import Path
from urllib.error import HTTPError, URLError
from urllib.parse import urlencode
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
        k = k.strip()
        v = v.strip().strip('"').strip("'")
        env[k] = v
    return env


def http_get(opener, url: str) -> tuple[int, dict[str, str], str]:
    req = Request(url, method="GET")
    try:
        resp = opener.open(req, timeout=5)
        body = resp.read().decode("utf-8", errors="replace")
        headers = {k.lower(): v for k, v in resp.headers.items()}
        return resp.status, headers, body
    except HTTPError as e:
        body = e.read().decode("utf-8", errors="replace")
        headers = {k.lower(): v for k, v in e.headers.items()}
        return e.code, headers, body


def http_post_form(opener, url: str, data: dict[str, str]) -> tuple[int, dict[str, str], str]:
    encoded = urlencode(data).encode("utf-8")
    req = Request(url, data=encoded, method="POST")
    req.add_header("Content-Type", "application/x-www-form-urlencoded")
    try:
        resp = opener.open(req, timeout=5)
        body = resp.read().decode("utf-8", errors="replace")
        headers = {k.lower(): v for k, v in resp.headers.items()}
        return resp.status, headers, body
    except HTTPError as e:
        body = e.read().decode("utf-8", errors="replace")
        headers = {k.lower(): v for k, v in e.headers.items()}
        return e.code, headers, body


def main() -> int:
    env_file = ROOT / ".env"
    dotenv = load_dotenv(env_file)
    env = os.environ.copy()
    env.update(dotenv)

    host = "127.0.0.1"
    port = "8099"
    base = f"http://{host}:{port}"

    proc = subprocess.Popen(
        ["php", "-S", f"{host}:{port}", "-t", str(ROOT)],
        stdout=subprocess.DEVNULL,
        stderr=subprocess.DEVNULL,
        env=env,
    )
    try:
        # Wait for server
        jar = CookieJar()
        opener = build_opener(HTTPCookieProcessor(jar))
        for _ in range(30):
            try:
                code, _, _ = http_get(opener, base + "/index.php")
                if code in (200, 302):
                    break
            except URLError:
                pass
            time.sleep(0.2)

        results = []

        code, headers, _ = http_get(opener, base + "/index.php")
        results.append(("GET /index.php", code))

        code, headers, body = http_get(opener, base + "/login.php")
        results.append(("GET /login.php", code))
        csp = headers.get("content-security-policy", "")
        results.append(("CSP header present", 1 if csp else 0))
        if not csp:
            print("Debug: response headers keys:", sorted(headers.keys()))

        m = re.search(r"name=['\"]csrf_token['\"]\s+value=['\"]([a-f0-9]+)['\"]", body, re.IGNORECASE)
        if not m:
            results.append(("CSRF token found in login form", 0))
            print("Debug: login.php body snippet:", body[:400].replace("\n", "\\n"))
            csrf = ""
        else:
            results.append(("CSRF token found in login form", 1))
            csrf = m.group(1)

        # Attempt wrong logins to populate rate-limit (generic response expected)
        email = "admin@example.com"
        for _ in range(6):
            code, _, _ = http_post_form(
                opener,
                base + "/login.php",
                {"csrf_token": csrf, "email": email, "password": "wrong-password"},
            )
        results.append(("POST /login.php wrong password x6", code))

        # Upload page should redirect to login if not logged in
        code, _, _ = http_get(opener, base + "/upload.php")
        results.append(("GET /upload.php (unauth)", code))

        # Print summary
        ok = True
        for name, status in results:
            if name.startswith("CSP"):
                if status != 1:
                    ok = False
            elif name.startswith("CSRF"):
                if status != 1:
                    ok = False
            else:
                if status not in (200, 302):
                    ok = False

        print("Smoke test results:")
        for name, status in results:
            print(f"- {name}: {status}")

        return 0 if ok else 1
    finally:
        proc.terminate()
        try:
            proc.wait(timeout=3)
        except subprocess.TimeoutExpired:
            proc.kill()


if __name__ == "__main__":
    raise SystemExit(main())

