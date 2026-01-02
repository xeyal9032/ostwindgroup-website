"""
Rotate DB password for the current MySQL user.

Requirements:
- python3
- mysql-connector-python (not installed by default here)

Env vars:
- DB_HOST, DB_PORT, DB_USER, DB_PASSWORD
- NEW_DB_PASSWORD (optional; if missing, will be generated)
- WRITE_ENV=1 (optional; if set, updates /workspace/.env DB_PASSWORD)

Safety:
- Does NOT print passwords.
"""

import os
import secrets
from pathlib import Path


ROOT = Path(__file__).resolve().parents[1]
ENV_FILE = ROOT / ".env"


def _env(key: str, default: str = "") -> str:
    return os.getenv(key, default)


def _update_env_file(db_password: str) -> None:
    if not ENV_FILE.exists():
        return
    lines = ENV_FILE.read_text(encoding="utf-8").splitlines()
    out = []
    found = False
    for line in lines:
        if line.startswith("DB_PASSWORD="):
            out.append("DB_PASSWORD=" + db_password)
            found = True
        else:
            out.append(line)
    if not found:
        out.append("DB_PASSWORD=" + db_password)
    ENV_FILE.write_text("\n".join(out) + "\n", encoding="utf-8")


def main() -> int:
    try:
        import mysql.connector  # type: ignore
    except Exception:
        print("mysql-connector-python is not installed. Install it to run rotation.")
        return 2

    host = _env("DB_HOST", "localhost")
    port = int(_env("DB_PORT", "3306"))
    user = _env("DB_USER", "root")
    password = _env("DB_PASSWORD", "")

    new_password = _env("NEW_DB_PASSWORD", "")
    if not new_password:
        # strong printable password
        new_password = secrets.token_urlsafe(32)

    try:
        conn = mysql.connector.connect(host=host, port=port, user=user, password=password)
    except Exception as e:
        print("Could not connect to MySQL with current env configuration.")
        print(f"- DB_HOST={host}")
        print(f"- DB_PORT={port}")
        print("Set DB_HOST/DB_USER/DB_PASSWORD to your PRODUCTION DB, then rerun.")
        print("Error:", str(e))
        return 3
    cur = conn.cursor()
    try:
        # MySQL 8+: alter current authenticated account
        cur.execute("ALTER USER CURRENT_USER() IDENTIFIED BY %s", (new_password,))
    except Exception:
        # fallback: try set password for current user
        cur.execute("SET PASSWORD = %s", (new_password,))
    conn.commit()
    cur.close()
    conn.close()

    if _env("WRITE_ENV", "0") == "1":
        _update_env_file(new_password)
        print("DB password rotated and .env updated (password not printed).")
    else:
        print("DB password rotated (password not printed). Set WRITE_ENV=1 to update .env.")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())

