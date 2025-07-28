from flask import Flask, request, jsonify, session
from flask_cors import CORS
import mysql.connector
import bcrypt

app = Flask(__name__)
CORS(app)
app.secret_key = 'supersecretkey'  # Gelişmiş güvenlik için değiştirilmeli

# MySQL bağlantı ayarları (kullanıcıdan alınan bilgiler)
DB_CONFIG = {
    'host': 'gtorg.mysql.ukraine.com.ua',
    'user': 'gtorg_xeyal',
    'password': 'sE)4!2Jnf7',
    'database': 'gtorg_xeyal',
    'port': 3306
}

def get_db_connection():
    return mysql.connector.connect(**DB_CONFIG)

@app.route('/')
def home():
    return {'message': 'Şirket Tanıtım Sitesi Backend'}, 200

# Admin kayıt (hash'li şifre ile)
@app.route('/api/admin/register', methods=['POST'])
def admin_register():
    data = request.json
    login = data.get('login')
    password = data.get('password')
    phone = data.get('phone')
    email = data.get('email')
    hashed = bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt())
    try:
        conn = get_db_connection()
        cursor = conn.cursor()
        cursor.execute(
            "INSERT INTO admin (login, password, phone, email) VALUES (%s, %s, %s, %s)",
            (login, hashed.decode('utf-8'), phone, email)
        )
        conn.commit()
        cursor.close()
        conn.close()
        return {'status': 'success', 'message': 'Admin başarıyla kaydedildi.'}, 200
    except Exception as e:
        return {'status': 'error', 'message': f'Hata: {str(e)}'}, 500

# Admin login (hash kontrolü)
@app.route('/api/admin/login', methods=['POST'])
def admin_login():
    data = request.json
    login = data.get('login')
    password = data.get('password')
    try:
        conn = get_db_connection()
        cursor = conn.cursor()
        cursor.execute("SELECT id, password FROM admin WHERE login=%s", (login,))
        result = cursor.fetchone()
        cursor.close()
        conn.close()
        if result:
            admin_id, hashed = result
            if bcrypt.checkpw(password.encode('utf-8'), hashed.encode('utf-8')):
                session['admin_id'] = admin_id
                return {'status': 'success', 'message': 'Giriş başarılı!'}, 200
            else:
                return {'status': 'fail', 'message': 'Şifre yanlış!'}, 401
        else:
            return {'status': 'fail', 'message': 'Kullanıcı bulunamadı!'}, 404
    except Exception as e:
        return {'status': 'error', 'message': f'Hata: {str(e)}'}, 500

# Admin panel örnek endpoint (giriş kontrolü)
@app.route('/api/admin/panel', methods=['GET'])
def admin_panel():
    if 'admin_id' in session:
        return {'status': 'success', 'message': 'Admin paneline hoş geldiniz!'}, 200
    else:
        return {'status': 'fail', 'message': 'Yetkisiz erişim!'}, 401

# Admin çıkış
@app.route('/api/admin/logout', methods=['POST'])
def admin_logout():
    session.pop('admin_id', None)
    return {'status': 'success', 'message': 'Çıkış yapıldı.'}, 200

@app.route('/api/contact', methods=['POST'])
def contact():
    data = request.json
    name = data.get('name')
    email = data.get('email')
    message = data.get('message')
    try:
        conn = get_db_connection()
        cursor = conn.cursor()
        cursor.execute(
            "INSERT INTO iletisim (name, email, message) VALUES (%s, %s, %s)",
            (name, email, message)
        )
        conn.commit()
        cursor.close()
        conn.close()
        return {'status': 'success', 'message': 'İletişim formu başarıyla kaydedildi.'}, 200
    except Exception as e:
        return {'status': 'error', 'message': f'Hata: {str(e)}'}, 500

if __name__ == '__main__':
    app.run(debug=True) 