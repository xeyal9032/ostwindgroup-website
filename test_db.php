<?php
// Veritabanı bağlantı testi
require_once 'includes/database.php';

echo "<h2>Veritabanı Bağlantı Testi</h2>";

try {
    // Bağlantıyı test et
    $stmt = $conn->query("SELECT 1");
    echo "<p style='color: green;'>✅ Veritabanı bağlantısı başarılı!</p>";
    
    // Veritabanı bilgilerini göster
    $stmt = $conn->query("SELECT DATABASE() as db_name");
    $db_info = $stmt->fetch();
    echo "<p><strong>Veritabanı:</strong> " . $db_info['db_name'] . "</p>";
    
    // Kullanıcılar tablosunu kontrol et
    $stmt = $conn->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green;'>✅ Users tablosu mevcut!</p>";
        
        // Kullanıcı sayısını göster
        $stmt = $conn->query("SELECT COUNT(*) as user_count FROM users");
        $user_count = $stmt->fetch();
        echo "<p><strong>Toplam kullanıcı:</strong> " . $user_count['user_count'] . "</p>";
        
        // Kullanıcıları listele
        $stmt = $conn->query("SELECT id, username, email, created_at FROM users LIMIT 5");
        $users = $stmt->fetchAll();
        
        if (count($users) > 0) {
            echo "<h3>Kullanıcılar:</h3>";
            echo "<table border='1' style='border-collapse: collapse;'>";
            echo "<tr><th>ID</th><th>Kullanıcı Adı</th><th>Email</th><th>Kayıt Tarihi</th></tr>";
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['id'] . "</td>";
                echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                echo "<td>" . $user['created_at'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        echo "<p style='color: red;'>❌ Users tablosu bulunamadı!</p>";
        echo "<p>database_setup.sql dosyasını çalıştırın.</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Veritabanı hatası: " . $e->getMessage() . "</p>";
    echo "<h3>Çözüm önerileri:</h3>";
    echo "<ul>";
    echo "<li>MySQL/MariaDB servisinin çalıştığından emin olun</li>";
    echo "<li>Veritabanı bilgilerini kontrol edin</li>";
    echo "<li>database_setup.sql dosyasını çalıştırın</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<p><a href='index.php'>Ana sayfaya dön</a></p>";
?> 