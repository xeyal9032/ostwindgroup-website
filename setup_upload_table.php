<?php
require_once 'includes/database.php';

echo "<h2>📁 Uploaded Files Tablosu Kurulumu</h2>";

try {
    // SQL dosyasını oku
    $sql_file = 'create_upload_table.sql';
    
    if (!file_exists($sql_file)) {
        throw new Exception("SQL dosyası bulunamadı: $sql_file");
    }
    
    $sql_content = file_get_contents($sql_file);
    
    // SQL komutlarını çalıştır
    $statements = explode(';', $sql_content);
    
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            try {
                $conn->exec($statement);
                echo "<p>✅ SQL komutu başarıyla çalıştırıldı</p>";
            } catch (PDOException $e) {
                // Foreign key constraint hatası olabilir, bu normal
                if (strpos($e->getMessage(), 'foreign key constraint') !== false) {
                    echo "<p>⚠️ Foreign key constraint hatası (bu normal olabilir): " . $e->getMessage() . "</p>";
                } else {
                    echo "<p>❌ SQL hatası: " . $e->getMessage() . "</p>";
                }
            }
        }
    }
    
    // Tabloyu kontrol et
    $stmt = $conn->query("SHOW TABLES LIKE 'uploaded_files'");
    if ($stmt->rowCount() > 0) {
        echo "<p>✅ uploaded_files tablosu başarıyla oluşturuldu!</p>";
        
        // Tablo yapısını göster
        $stmt = $conn->query("DESCRIBE uploaded_files");
        echo "<h3>📋 Tablo Yapısı:</h3>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>Alan</th><th>Tip</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Field']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Null']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Key']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Default']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Extra']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
    } else {
        echo "<p>❌ uploaded_files tablosu oluşturulamadı!</p>";
    }
    
} catch (Exception $e) {
    echo "<p>❌ Hata: " . $e->getMessage() . "</p>";
}

echo "<br><a href='upload.php'>📸 Upload Sayfasına Git</a>";
echo "<br><a href='index.php'>🏠 Ana Sayfaya Git</a>";
?> 