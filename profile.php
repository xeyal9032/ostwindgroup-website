<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

$language = Language::getInstance();
$translations = $language->getTranslations();

// Kullanıcı giriş yapmamışsa login sayfasına yönlendir
if(!is_logged_in()) {
    redirect_to_login();
}

$user_id = $_SESSION['user_id'];
$success = '';
$error = '';

// Kullanıcı bilgilerini al
$stmt = $conn->prepare("SELECT username, email, is_admin, created_at FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    redirect_to_login();
}

// Profil güncelleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!require_valid_csrf_post()) {
        $error = $translations['csrf_invalid'] ?? 'Security check failed. Please refresh the page and try again.';
    } else {
    $new_username = clean_input($_POST['username']);
    $new_email = clean_input($_POST['email']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    $current_is_admin = !empty($user['is_admin']);

    if(empty($new_username) || empty($new_email)) {
        $error = $translations['profile_username_email_required'] ?? 'İstifadəçi adı və e-poçt məcburidir.';
    } elseif(!is_valid_email($new_email)) {
        $error = $translations['profile_invalid_email'] ?? 'Düzgün e-poçt ünvanı daxil edin.';
    } elseif(!is_valid_username($new_username)) {
        $error = $translations['profile_invalid_username'] ?? 'Düzgün istifadəçi adı daxil edin.';
    } elseif(!$current_is_admin && strtolower($new_username) === 'admin') {
        $error = $translations['profile_username_exists'] ?? 'Bu istifadəçi adı artıq mövcuddur.';
    } elseif(!$current_is_admin && in_array(strtolower($new_email), ['admin@ostwindgroup.com', 'admin@example.com'], true)) {
        $error = $translations['profile_email_exists'] ?? 'Bu e-poçt ünvanı artıq mövcuddur.';
    } else {
        // Kullanıcı adının başka biri tarafından kullanılıp kullanılmadığını kontrol et
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
        $stmt->execute([$new_username, $user_id]);
        
        if($stmt->fetch()) {
            $error = $translations['profile_username_exists'] ?? 'Bu istifadəçi adı artıq mövcuddur.';
        } else {
            // Email'in başka biri tarafından kullanılıp kullanılmadığını kontrol et
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
            $stmt->execute([$new_email, $user_id]);
            
            if($stmt->fetch()) {
                $error = $translations['profile_email_exists'] ?? 'Bu e-poçt ünvanı artıq mövcuddur.';
            } else {
                // Şifre değişikliği yapılacaksa kontrol et
                if(!empty($current_password)) {
                    // Mevcut şifreyi kontrol et
                    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
                    $stmt->execute([$user_id]);
                    $current_user = $stmt->fetch();
                    
                    if(!password_verify($current_password, $current_user['password'])) {
                        $error = $translations['profile_current_password_wrong'] ?? 'Cari şifrə yanlışdır.';
                    } elseif(empty($new_password)) {
                        $error = $translations['profile_new_password_required'] ?? 'Yeni şifrə məcburidir.';
                    } elseif(!is_strong_password($new_password)) {
                        $error = $translations['profile_weak_password'] ?? 'Şifrə çox zəifdir.';
                    } elseif($new_password !== $confirm_password) {
                        $error = $translations['profile_passwords_not_match'] ?? 'Şifrələr uyğun gəlmir.';
                    } else {
                        // Şifre ile birlikte güncelle
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
                        if($stmt->execute([$new_username, $new_email, $hashed_password, $user_id])) {
                            $_SESSION['username'] = $new_username;
                            $user['username'] = $new_username;
                            $user['email'] = $new_email;
                            $success = $translations['profile_update_success'] ?? 'Profil uğurla yeniləndi.';
                        } else {
                            $error = $translations['profile_update_error'] ?? 'Profil yenilənərkən xəta baş verdi.';
                        }
                    }
                } else {
                    // Sadece kullanıcı adı ve email güncelle
                    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
                    if($stmt->execute([$new_username, $new_email, $user_id])) {
                        $_SESSION['username'] = $new_username;
                        $user['username'] = $new_username;
                        $user['email'] = $new_email;
                        $success = $translations['profile_update_success'] ?? 'Profil uğurla yeniləndi.';
                    } else {
                        $error = $translations['profile_update_error'] ?? 'Profil yenilənərkən xəta baş verdi.';
                    }
                }
            }
        }
    }
    }
}

// Sayfa başlığı
$page_title = $translations['profile_title'] ?? 'Profil - OstWindGroup';

// Header'ı dahil et
include 'includes/header.php';
?>

<div class="profile-page">
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <div class="avatar-circle">
                    <span class="avatar-text"><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                </div>
            </div>
            <h1><?php echo $translations['profile_title'] ?? 'Profil'; ?></h1>
            <p><?php echo $translations['profile_subtitle'] ?? 'Profil məlumatlarınızı yeniləyin'; ?></p>
        </div>
        
        <?php if($error): ?>
            <div class="alert alert-error">
                <div class="alert-icon">⚠️</div>
                <div class="alert-content">
                    <h4>Xəta</h4>
                    <p><?php echo htmlspecialchars($error); ?></p>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if($success): ?>
            <div class="alert alert-success">
                <div class="alert-icon">✅</div>
                <div class="alert-content">
                    <h4>Uğurlu</h4>
                    <p><?php echo htmlspecialchars($success); ?></p>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="profile-content">
            <div class="profile-section">
                <div class="section-header">
                    <h3>📋 Hesab Məlumatları</h3>
                    <p>Mövcud hesab məlumatlarınız</p>
                </div>
                
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-icon">👤</div>
                        <div class="info-content">
                            <label>İstifadəçi adı</label>
                            <span><?php echo htmlspecialchars($user['username']); ?></span>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon">📧</div>
                        <div class="info-content">
                            <label>E-poçt</label>
                            <span><?php echo htmlspecialchars($user['email']); ?></span>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon">📅</div>
                        <div class="info-content">
                            <label>Qeydiyyat tarixi</label>
                            <span><?php echo format_date($user['created_at']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <form method="POST" action="" class="profile-form">
                <?php echo csrf_input_field(); ?>
                <div class="profile-section">
                    <div class="section-header">
                        <h3>✏️ Profil Məlumatlarını Yenilə</h3>
                        <p>Şəxsi məlumatlarınızı yeniləyin</p>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="username">
                                <span class="label-icon">👤</span>
                                İstifadəçi adı
                            </label>
                            <input type="text" id="username" name="username" required 
                                   value="<?php echo htmlspecialchars($user['username']); ?>"
                                   placeholder="İstifadəçi adınızı daxil edin">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">
                                <span class="label-icon">📧</span>
                                E-poçt
                            </label>
                            <input type="email" id="email" name="email" required 
                                   value="<?php echo htmlspecialchars($user['email']); ?>"
                                   placeholder="E-poçt ünvanınızı daxil edin">
                        </div>
                    </div>
                </div>
                
                <div class="profile-section">
                    <div class="section-header">
                        <h3>🔐 Şifrəni Dəyiş</h3>
                        <p>Şifrənizi təhlükəsiz şəkildə yeniləyin</p>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="current_password">
                                <span class="label-icon">🔑</span>
                                Cari şifrə
                            </label>
                            <input type="password" id="current_password" name="current_password" 
                                   placeholder="Cari şifrənizi daxil edin">
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password">
                                <span class="label-icon">🔒</span>
                                Yeni şifrə
                            </label>
                            <input type="password" id="new_password" name="new_password" 
                                   placeholder="Yeni şifrə daxil edin">
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password">
                                <span class="label-icon">✅</span>
                                Şifrəni təsdiqlə
                            </label>
                            <input type="password" id="confirm_password" name="confirm_password" 
                                   placeholder="Yeni şifrəni təsdiqləyin">
                        </div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span class="btn-icon">💾</span>
                        Profil Yenilə
                    </button>
                </div>
            </form>
            
            <div class="profile-section">
                <div class="section-header">
                    <h3>🔧 Əlavə Əməliyyatlar</h3>
                    <p>Digər hesab əməliyyatları</p>
                </div>
                
                <div class="action-grid">
                    <a href="upload.php" class="action-card">
                        <div class="action-icon">📸</div>
                        <div class="action-content">
                            <h4>Fotoğraf Yükle</h4>
                            <p>Profil fotoğrafınızı yükləyin</p>
                        </div>
                        <div class="action-arrow">→</div>
                    </a>
                    
                    <a href="logout.php" class="action-card action-danger" 
                       onclick="return confirm('<?php echo $translations['logout_confirm'] ?? 'Çıxış etmək istədiyinizə əminsiniz?'; ?>')">
                        <div class="action-icon">🚪</div>
                        <div class="action-content">
                            <h4>Çıxış Et</h4>
                            <p>Hesabınızdan təhlükəsiz çıxış</p>
                        </div>
                        <div class="action-arrow">→</div>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="profile-footer">
            <a href="index.php" class="back-link">
                <span class="back-icon">←</span>
                Ana Səhifəyə Qayıt
            </a>
        </div>
    </div>
</div>

<style>
/* Profile Page Styles */
    .profile-page {
        min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 120px 20px 40px;
    position: relative;
}

.profile-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
    }
    
    .profile-container {
    max-width: 800px;
        margin: 0 auto;
        background: white;
    border-radius: 24px;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    position: relative;
    backdrop-filter: blur(10px);
}

.profile-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 48px 40px;
    text-align: center;
        position: relative;
    }
    
.profile-header::before {
    content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.2"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
}

.profile-avatar {
    margin-bottom: 24px;
}

.avatar-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    border: 3px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.avatar-text {
    font-size: 32px;
    font-weight: 700;
    color: white;
    }
    
    .profile-header h1 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 8px;
    position: relative;
    z-index: 1;
}

.profile-header p {
    font-size: 18px;
    opacity: 0.9;
    position: relative;
    z-index: 1;
}

.profile-content {
    padding: 40px;
}

.profile-section {
    margin-bottom: 48px;
}

.profile-section:last-child {
    margin-bottom: 0;
}

.section-header {
    margin-bottom: 32px;
    text-align: center;
}

.section-header h3 {
    font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }
    
.section-header p {
        color: #666;
        font-size: 16px;
    }
    
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
        margin-bottom: 32px;
    }
    
.info-card {
    background: #f8f9fa;
    border-radius: 16px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.info-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
    border-color: #667eea;
}

.info-icon {
    font-size: 24px;
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
        display: flex;
        align-items: center;
    justify-content: center;
    color: white;
}

.info-content {
    flex: 1;
}

.info-content label {
    display: block;
    font-size: 14px;
    color: #666;
    margin-bottom: 4px;
        font-weight: 500;
    }
    
.info-content span {
    display: block;
    font-size: 16px;
    font-weight: 600;
        color: #1a1a1a;
}

.profile-form {
    background: #f8f9fa;
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 32px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-group label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
    font-weight: 600;
        color: #1a1a1a;
    font-size: 16px;
}

.label-icon {
    font-size: 18px;
    }
    
    .form-group input {
        width: 100%;
    padding: 16px 20px;
        border: 2px solid #e1e5e9;
        border-radius: 12px;
        font-size: 16px;
    transition: all 0.3s ease;
    background: white;
    color: #1a1a1a;
    }
    
    .form-group input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    transform: translateY(-2px);
}

.form-group input::placeholder {
    color: #999;
}

.form-actions {
    text-align: center;
    margin-top: 32px;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 16px 32px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn:hover::before {
    left: 100%;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(102, 126, 234, 0.4);
}

.btn-icon {
    font-size: 18px;
}

.alert {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 32px;
    border: 2px solid transparent;
}

.alert-error {
    background: #fef2f2;
    border-color: #fecaca;
    color: #dc2626;
}

.alert-success {
    background: #f0fdf4;
    border-color: #bbf7d0;
    color: #16a34a;
}

.alert-icon {
    font-size: 24px;
    flex-shrink: 0;
}

.alert-content h4 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 4px;
}

.alert-content p {
    font-size: 16px;
    margin: 0;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

.action-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 24px;
    background: white;
    border-radius: 16px;
    text-decoration: none;
    color: #1a1a1a;
    border: 2px solid #e1e5e9;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.action-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 0;
}

.action-card:hover::before {
    opacity: 0.05;
}

.action-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
    border-color: #667eea;
}

.action-card.action-danger:hover {
    border-color: #dc2626;
    background: #fef2f2;
}

.action-icon {
    font-size: 24px;
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
    z-index: 1;
    position: relative;
}

.action-card.action-danger .action-icon {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
}

.action-content {
    flex: 1;
    z-index: 1;
    position: relative;
}

.action-content h4 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 4px;
}

.action-content p {
    font-size: 14px;
    color: #666;
    margin: 0;
}

.action-arrow {
    font-size: 20px;
    color: #667eea;
    font-weight: 600;
    z-index: 1;
    position: relative;
}

.action-card.action-danger .action-arrow {
    color: #dc2626;
}

.profile-footer {
    padding: 32px 40px;
    background: #f8f9fa;
    text-align: center;
    border-top: 1px solid #e1e5e9;
    }
    
    .back-link {
    display: inline-flex;
        align-items: center;
        gap: 8px;
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
}

.back-link:hover {
    color: #764ba2;
    transform: translateX(-4px);
}

.back-icon {
    font-size: 18px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-page {
        padding: 100px 16px 32px;
    }
    
    .profile-container {
        border-radius: 16px;
    }
    
    .profile-header {
        padding: 32px 24px;
    }
    
    .profile-header h1 {
        font-size: 28px;
    }
    
    .profile-header p {
        font-size: 16px;
    }
    
    .profile-content {
        padding: 24px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .action-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header h3 {
        font-size: 20px;
    }
}

@media (max-width: 480px) {
    .profile-header {
        padding: 24px 16px;
    }
    
    .profile-content {
        padding: 16px;
    }
    
    .profile-footer {
        padding: 24px 16px;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .action-card {
        padding: 16px;
    }
    
    .info-card {
        padding: 16px;
    }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
    .profile-container {
        background: #1a1a1a;
        color: white;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 100%);
    }
    
    .info-card {
        background: #2d2d2d;
        color: white;
    }
    
    .profile-form {
        background: #2d2d2d;
    }
    
    .form-group input {
        background: #1a1a1a;
        color: white;
        border-color: #404040;
    }
    
    .action-card {
        background: #2d2d2d;
        color: white;
        border-color: #404040;
    }
    
    .profile-footer {
        background: #2d2d2d;
        border-color: #404040;
    }
}
</style>

<?php
// Footer'ı dahil et
include 'includes/footer.php';
?> 