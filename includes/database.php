<?php
/**
 * Database connection (PDO)
 *
 * Credentials must NOT be stored in source code.
 * Configure via environment variables or a local `.env` file in project root.
 *
 * Supported variables:
 * - APP_DEBUG (0/1)
 * - DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD, DB_CHARSET
 */

// Minimal dotenv loader (PHP 7.4 compatible, no dependencies)
if (!function_exists('ostwind_load_dotenv')) {
    function ostwind_load_dotenv($path) {
        if (!is_readable($path)) {
            return;
        }

        $lines = @file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }
            $pos = strpos($line, '=');
            if ($pos === false) {
                continue;
            }

            $key = trim(substr($line, 0, $pos));
            $value = trim(substr($line, $pos + 1));

            // Strip optional surrounding quotes
            $len = strlen($value);
            if ($len >= 2) {
                $first = $value[0];
                $last = $value[$len - 1];
                if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                    $value = substr($value, 1, -1);
                }
            }

            if ($key !== '' && getenv($key) === false) {
                putenv($key . '=' . $value);
                $_ENV[$key] = $value;
            }
        }
    }
}

if (!function_exists('ostwind_env')) {
    function ostwind_env($key, $default = null) {
        $val = getenv($key);
        return ($val === false) ? $default : $val;
    }
}

// Load .env from project root (../.env relative to /includes)
ostwind_load_dotenv(__DIR__ . '/../.env');

define('DB_HOST', ostwind_env('DB_HOST', 'localhost'));
define('DB_PORT', ostwind_env('DB_PORT', '3306'));
define('DB_USERNAME', ostwind_env('DB_USER', 'root'));
define('DB_PASSWORD', ostwind_env('DB_PASSWORD', ''));
define('DB_NAME', ostwind_env('DB_NAME', 'gtorg_xeyal'));
define('DB_CHARSET', ostwind_env('DB_CHARSET', 'utf8mb4'));

$app_debug = ostwind_env('APP_DEBUG', '0') === '1';

// Veritabanına bağlantı oluştur
try {
    $conn = new PDO(
        "mysql:host=" . DB_HOST .
        ";port=" . DB_PORT .
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
    // Kullanıcıya güvenli bir hata mesajı göster (debug değilse detay verme)
    if ($app_debug) {
        die("Database connection failed: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
    }
    die("Veritabanına bağlanırken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.");
}
?> 