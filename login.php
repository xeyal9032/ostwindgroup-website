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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!require_valid_csrf_post()) {
        $error = $translations['csrf_invalid'] ?? 'Security check failed. Please refresh the page and try again.';
    } else {
    $email = clean_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = $translations['validation_required'] ?? 'This field is required.';
    } else {
        try {
            $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Prevent session fixation
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                redirect_to_home();
            } else {
                $error = $translations['login_error'] ?? 'Invalid email or password';
            }
        } catch (PDOException $e) {
            $error = $translations['login_error'] ?? 'Invalid email or password';
        }
    }
    }
}

$page_title = $translations['login_title'] ?? 'Login';

include 'includes/header.php';
?>

<style>
.login-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 30px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.login-header {
    text-align: center;
    margin-bottom: 30px;
}

.login-header h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.login-header p {
    color: #666;
    font-size: 14px;
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

.login-btn {
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

.login-btn:hover {
    background: #5a6fd8;
}

.login-footer {
    text-align: center;
    margin-top: 20px;
}

.login-footer a {
    color: #667eea;
    text-decoration: none;
}

.login-footer a:hover {
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
</style>

<div class="login-container">
    <div class="login-header">
        <h1>🔐 Giriş</h1>
        <p>Hesabınıza giriş edin</p>
    </div>
    
    <?php if ($error): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <?php echo csrf_input_field(); ?>
        <div class="form-group">
            <label for="email">📧 E-mail</label>
            <input type="email" id="email" name="email" placeholder="E-mail ünvanınızı daxil edin" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="password">🔒 Şifrə</label>
            <input type="password" id="password" name="password" placeholder="Şifrənizi daxil edin" required>
        </div>
        
        <button type="submit" class="login-btn">🚀 Giriş Et</button>
    </form>
    
    <div class="login-footer">
        <p>Hesabınız yoxdur? <a href="register.php">🎯 Qeydiyyatdan keçin</a></p>
        <p><a href="index.php">🏠 Ana səhifəyə qayıt</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 