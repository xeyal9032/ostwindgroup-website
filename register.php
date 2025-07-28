<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Kullanıcı zaten giriş yapmışsa ana sayfaya yönlendir
if (is_logged_in()) {
    redirect_to_home();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean_input($_POST['username'] ?? '');
    $email = clean_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validasyon
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = $translations['validation_required'] ?? 'This field is required.';
    } elseif (!is_valid_email($email)) {
        $error = $translations['validation_email'] ?? 'Please enter a valid email address.';
    } elseif (!is_valid_username($username)) {
        $error = $translations['validation_min_length'] ?? 'Username must be at least 3 characters.';
    } elseif (!is_strong_password($password)) {
        $error = $translations['validation_weak_password'] ?? 'Password must be at least 8 characters and contain uppercase, lowercase, and numbers.';
    } elseif ($password !== $confirm_password) {
        $error = $translations['validation_password_match'] ?? 'Passwords do not match.';
    } else {
        try {
            // Kullanıcı adı kontrolü
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = $translations['validation_username_exists'] ?? 'This username is already taken.';
            } else {
                // Email kontrolü
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $error = $translations['validation_email_exists'] ?? 'This email address is already taken.';
                } else {
                    // Kullanıcıyı kaydet
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                    $stmt->execute([$username, $email, $hashed_password]);
                    
                    $success = $translations['register_success'] ?? 'Registration successful! You can now login.';
                }
            }
        } catch (PDOException $e) {
            $error = $translations['register_error'] ?? 'An error occurred during registration.';
        }
    }
}

$page_title = $translations['register_title'] ?? 'Register';

include 'includes/header.php';
?>

<style>
.register-container {
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.register-header {
    text-align: center;
    margin-bottom: 30px;
}

.register-header h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.register-header p {
    color: #666;
    font-size: 14px;
}

.form-row {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.form-row .form-group {
    flex: 1;
    margin-bottom: 0;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #333;
    font-weight: 500;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    box-sizing: border-box;
}

.form-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
}

.register-btn {
    width: 100%;
    padding: 12px;
    background: #667eea;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s ease;
}

.register-btn:hover {
    background: #5a6fd8;
}

.register-footer {
    text-align: center;
    margin-top: 20px;
}

.register-footer a {
    color: #667eea;
    text-decoration: none;
}

.register-footer a:hover {
    text-decoration: underline;
}

.error-message {
    background: #ff6b6b;
    color: white;
    padding: 12px;
    border-radius: 4px;
    margin-bottom: 20px;
    text-align: center;
}

.success-message {
    background: #4CAF50;
    color: white;
    padding: 12px;
    border-radius: 4px;
    margin-bottom: 20px;
    text-align: center;
}

.requirements {
    background: #f8f9fa;
    border: 1px solid #e1e5e9;
    border-radius: 4px;
    padding: 15px;
    margin-bottom: 20px;
}

.requirements h4 {
    margin: 0 0 10px 0;
    color: #333;
    font-size: 14px;
}

.requirements ul {
    margin: 0;
    padding-left: 20px;
    color: #666;
    font-size: 13px;
}

.requirements li {
    margin-bottom: 5px;
}

@media (max-width: 480px) {
    .form-row {
        flex-direction: column;
        gap: 0;
    }
}
</style>

<div class="register-container">
    <div class="register-header">
        <h1>🎯 Qeydiyyat</h1>
        <p>Hesab yaradın</p>
    </div>
    
    <?php if ($error): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <div class="form-row">
            <div class="form-group">
                <label for="username">👤 İstifadəçi Adı</label>
                <input type="text" id="username" name="username" placeholder="İstifadəçi adınızı daxil edin" required value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label for="email">📧 E-mail</label>
                <input type="email" id="email" name="email" placeholder="E-mail ünvanınızı daxil edin" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label for="password">🔒 Şifrə</label>
            <input type="password" id="password" name="password" placeholder="Güclü şifrə yaradın" required>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">🔐 Şifrəni Təsdiqlə</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Şifrənizi təkrar daxil edin" required>
        </div>
        
        <div class="requirements">
            <h4>📋 Şifrə Tələbləri:</h4>
            <ul>
                <li>✅ Minimum 8 simvol</li>
                <li>✅ Böyük hərf daxil edin</li>
                <li>✅ Kiçik hərf daxil edin</li>
                <li>✅ Rəqəm daxil edin</li>
            </ul>
        </div>
        
        <button type="submit" class="register-btn">🚀 Qeydiyyatdan Keç</button>
    </form>
    
    <div class="register-footer">
        <p>Artıq hesabınız var? <a href="login.php">🔐 Giriş edin</a></p>
        <p><a href="index.php">🏠 Ana səhifəyə qayıt</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 