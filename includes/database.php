<?php
// Database connection parameters
// Remote server settings
define('DB_SERVER', 'gtorg.mysql.ukraine.com.ua:3306');
define('DB_USERNAME', 'gtorg_xeyal');
define('DB_PASSWORD', 'sE)4!2Jnf7');
define('DB_NAME', 'gtorg_xeyal');
define('DB_CHARSET', 'utf8mb4');

// Veritabanına bağlantı oluştur
try {
    $conn = new PDO(
        "mysql:host=" . DB_SERVER . 
        ";dbname=" . DB_NAME . 
        ";charset=" . DB_CHARSET,
        DB_USERNAME,
        DB_PASSWORD,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        )
    );
} catch(PDOException $e) {
    // Hata mesajını logla
    error_log("Database Connection Error: " . $e->getMessage());
    // Kullanıcıya güvenli bir hata mesajı göster
    die("Veritabanına bağlanırken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.");
}
?> 