<?php
require_once 'includes/database.php';

// SECURITY: bootstrap scripts must not be exposed in production.
// Enable only with ALLOW_ADMIN_BOOTSTRAP=1 and (optionally) ADMIN_BOOTSTRAP_TOKEN.
$allow = function_exists('ostwind_env') ? (ostwind_env('ALLOW_ADMIN_BOOTSTRAP', '0') === '1') : false;
$required_token = function_exists('ostwind_env') ? ostwind_env('ADMIN_BOOTSTRAP_TOKEN', '') : '';
$provided_token = $_GET['token'] ?? '';

if (!$allow || ($required_token !== '' && !hash_equals($required_token, $provided_token))) {
    http_response_code(403);
    echo "Forbidden";
    exit;
}

echo "<h2>🔧 Yeni Admin Hesabı Yaradılması</h2>";

try {
    // Yeni admin məlumatları (env ile)
    $admin_username = function_exists('ostwind_env') ? (ostwind_env('ADMIN_USERNAME', 'admin') ?: 'admin') : 'admin';
    $admin_email = function_exists('ostwind_env') ? (ostwind_env('ADMIN_EMAIL', 'admin@ostwindgroup.com') ?: 'admin@ostwindgroup.com') : 'admin@ostwindgroup.com';
    $admin_password = function_exists('ostwind_env') ? (ostwind_env('ADMIN_PASSWORD', '') ?: '') : '';

    if ($admin_password === '') {
        throw new Exception("ADMIN_PASSWORD env dəyişəni təyin edilməyib.");
    }
    
    // Şifrəni hash et
    $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
    
    // Köhnə admin hesabını sil
    $stmt = $conn->prepare("DELETE FROM users WHERE username = 'admin' OR email IN ('admin@example.com', 'admin@ostwindgroup.com')");
    $stmt->execute();
    
    // Yeni admin hesabını yarat
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, is_admin, created_at) VALUES (?, ?, ?, 1, NOW())");
    
    if ($stmt->execute([$admin_username, $admin_email, $hashed_password])) {
        echo "<p>✅ Yeni admin hesabı uğurla yaradıldı!</p>";
        echo "<h3>📋 Admin Məlumatları:</h3>";
        echo "<table border='1' style='border-collapse: collapse; margin: 20px 0;'>";
        echo "<tr><th>İstifadəçi Adı</th><td>$admin_username</td></tr>";
        echo "<tr><th>E-mail</th><td>$admin_email</td></tr>";
        echo "</table>";
        echo "<p><strong>⚠️ Şifrə ekrana yazdırılmadı (təhlükəsizlik üçün).</strong></p>";
    } else {
        echo "<p>❌ Admin hesabı yaradılarkən xəta baş verdi.</p>";
    }
    
    // Mövcud istifadəçiləri göstər
    $stmt = $conn->query("SELECT id, username, email, created_at FROM users ORDER BY created_at DESC");
    $users = $stmt->fetchAll();
    
    if ($users) {
        echo "<h3>👥 Mövcud İstifadəçilər:</h3>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>İstifadəçi Adı</th><th>E-mail</th><th>Qeydiyyat Tarixi</th></tr>";
        
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['id']) . "</td>";
            echo "<td>" . htmlspecialchars($user['username']) . "</td>";
            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
            echo "<td>" . htmlspecialchars($user['created_at']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
} catch (Exception $e) {
    echo "<p>❌ Xəta: " . $e->getMessage() . "</p>";
}

echo "<br><a href='login.php'>🔐 Giriş Səhifəsinə Git</a>";
echo "<br><a href='admin/'>👨‍💼 Admin Panelə Git</a>";
echo "<br><a href='index.php'>🏠 Ana Səhifəyə Git</a>";
?> 