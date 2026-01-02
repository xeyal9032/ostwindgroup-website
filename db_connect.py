import mysql.connector
import os


def _env(key: str, default=None):
    return os.getenv(key, default)

def get_db_connection():
    return mysql.connector.connect(
        host=_env("DB_HOST", "localhost"),
        user=_env("DB_USER", "root"),
        password=_env("DB_PASSWORD", ""),
        database=_env("DB_NAME", "gtorg_xeyal"),
        port=int(_env("DB_PORT", "3306")),
    )

# Kullanım örneği:
# conn = get_db_connection()
# cursor = conn.cursor()
# cursor.execute('SELECT 1')
# print(cursor.fetchone())
# cursor.close()
# conn.close() 