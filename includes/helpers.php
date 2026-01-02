<?php
// Yardımcı fonksiyonlar

// Ensure session exists for auth/CSRF helpers
if (session_status() === PHP_SESSION_NONE) {
    // Basic secure defaults (works without HTTPS too)
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    $params = session_get_cookie_params();
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => $params['path'] ?? '/',
        'domain' => $params['domain'] ?? '',
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

/**
 * Güvenli string temizleme
 */
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Email formatını kontrol et
 */
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Şifre güvenliğini kontrol et
 */
function is_strong_password($password) {
    // En az 8 karakter, en az bir büyük harf, bir küçük harf ve bir rakam
    return strlen($password) >= 8 &&
           preg_match('/[A-Z]/', $password) &&
           preg_match('/[a-z]/', $password) &&
           preg_match('/[0-9]/', $password);
}

/**
 * Kullanıcı adı formatını kontrol et
 */
function is_valid_username($username) {
    // Sadece harf, rakam ve alt çizgi, 3-20 karakter
    return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username);
}

/**
 * Tarih formatını düzenle
 */
function format_date($date, $format = 'd.m.Y H:i') {
    return date($format, strtotime($date));
}

/**
 * CSRF token oluştur
 */
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * HTML hidden input for CSRF token
 */
function csrf_input_field() {
    $token = generate_csrf_token();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
}

/**
 * Verify CSRF token from POST body
 */
function require_valid_csrf_post() {
    $token = $_POST['csrf_token'] ?? '';
    if (!verify_csrf_token($token)) {
        http_response_code(403);
        return false;
    }
    return true;
}

/**
 * Prevent mail header injection (strip CRLF)
 */
function sanitize_email_header_value($value) {
    $value = (string)$value;
    return str_replace(["\r", "\n"], '', $value);
}

/**
 * CSRF token doğrula
 */
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Hata mesajı göster
 */
function show_error($message) {
    return '<div class="error">' . htmlspecialchars($message) . '</div>';
}

/**
 * Başarı mesajı göster
 */
function show_success($message) {
    return '<div class="success">' . htmlspecialchars($message) . '</div>';
}

/**
 * Kullanıcının giriş yapıp yapmadığını kontrol et
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Kullanıcıyı login sayfasına yönlendir
 */
function redirect_to_login() {
    header("Location: login.php");
    exit();
}

/**
 * Kullanıcıyı ana sayfaya yönlendir
 */
function redirect_to_home() {
    header("Location: index.php");
    exit();
}

/**
 * Güvenli yönlendirme
 */
function safe_redirect($url) {
    header("Location: " . htmlspecialchars($url));
    exit();
}

/**
 * Dosya boyutunu formatla
 */
function format_file_size($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}

/**
 * Rastgele string oluştur
 */
function generate_random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
}

// Dark/Light Mode fonksiyonları
function get_theme_mode() {
    return isset($_COOKIE['theme_mode']) ? $_COOKIE['theme_mode'] : 'light';
}

function set_theme_mode($mode) {
    setcookie('theme_mode', $mode, time() + (365 * 24 * 60 * 60), '/');
}

function get_theme_class() {
    $mode = get_theme_mode();
    return $mode === 'dark' ? 'dark-mode' : 'light-mode';
}
?> 