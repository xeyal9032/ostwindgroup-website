import mysql.connector

def get_db_connection():
    return mysql.connector.connect(
        host='gtorg.mysql.tools',
        user='gtorg_xeyal',
        password='sE)4!2Jnf7',
        database='gtorg_xeyal',
        port=3306
    )

# Kullanım örneği:
# conn = get_db_connection()
# cursor = conn.cursor()
# cursor.execute('SELECT 1')
# print(cursor.fetchone())
# cursor.close()
# conn.close() 