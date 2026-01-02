-- Login rate limiting table

CREATE TABLE IF NOT EXISTS login_attempts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ip VARCHAR(45) NOT NULL,
  email VARCHAR(255) NOT NULL,
  attempt_count INT NOT NULL DEFAULT 0,
  first_attempt_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_attempt_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  locked_until DATETIME NULL,
  KEY idx_login_attempts_ip_email (ip, email),
  KEY idx_login_attempts_locked_until (locked_until)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

