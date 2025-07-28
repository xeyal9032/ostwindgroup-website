<?php
require_once 'includes/database.php';

echo "<h2>🔧 Admin Hesabı Yaradılması</h2>";

try {
    // Admin məlumatları
    $admin_username = 'admin';
    $admin_email = 'admin@ostwindgroup.com';
    $admin_password = 'Admin123!';
    
    // Şifrəni hash et
    $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
    
    // Admin hesabının mövcud olub-olmadığını yoxla
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$admin_username, $admin_email]);
    
    if ($stmt->fetch()) {
        echo "<p>⚠️ Admin hesabı artıq mövcuddur!</p>";
    } else {
        // Admin hesabını yarat
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())");
        
        if ($stmt->execute([$admin_username, $admin_email, $hashed_password])) {
            echo "<p>✅ Admin hesabı uğurla yaradıldı!</p>";
            echo "<h3>📋 Admin Məlumatları:</h3>";
            echo "<table border='1' style='border-collapse: collapse; margin: 20px 0;'>";
            echo "<tr><th>İstifadəçi Adı</th><td>$admin_username</td></tr>";
            echo "<tr><th>E-mail</th><td>$admin_email</td></tr>";
            echo "<tr><th>Şifrə</th><td>$admin_password</td></tr>";
            echo "</table>";
            echo "<p><strong>⚠️ Bu məlumatları təhlükəsiz yerdə saxlayın!</strong></p>";
        } else {
            echo "<p>❌ Admin hesabı yaradılarkən xəta baş verdi.</p>";
        }
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