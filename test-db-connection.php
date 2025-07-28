<?php
require_once 'includes/database.php';

echo "<h2>Veritabanı Bağlantı Testi</h2>";

try {
    // Bağlantıyı test et
    $stmt = $conn->query("SELECT 1");
    echo "<p style='color: green;'>✅ Veritabanı bağlantısı başarılı!</p>";
    
    // Kullanıcı sayısını kontrol et
    $stmt = $conn->query("SELECT COUNT(*) as user_count FROM users");
    $result = $stmt->fetch();
    echo "<p>👥 Toplam kullanıcı sayısı: " . $result['user_count'] . "</p>";
    
    // Admin sayısını kontrol et
    $stmt = $conn->query("SELECT COUNT(*) as admin_count FROM admin");
    $result = $stmt->fetch();
    echo "<p>👨‍💼 Toplam admin sayısı: " . $result['admin_count'] . "</p>";
    
    // Son kullanıcıları listele
    echo "<h3>Son Kullanıcılar:</h3>";
    $stmt = $conn->query("SELECT username, email, created_at FROM users ORDER BY created_at DESC LIMIT 5");
    echo "<ul>";
    while ($row = $stmt->fetch()) {
        echo "<li>" . htmlspecialchars($row['username']) . " (" . htmlspecialchars($row['email']) . ") - " . $row['created_at'] . "</li>";
    }
    echo "</ul>";
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>❌ Veritabanı bağlantı hatası: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?> 