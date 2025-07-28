<?php
require_once '../config.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}
$admin_login = $_SESSION['admin_login'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Paneli</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .admin-navbar { background: #222; color: #fff; padding: 1rem; display: flex; gap: 2rem; align-items: center; }
    .admin-navbar a { color: #fff; text-decoration: none; font-weight: 600; transition: color 0.2s; }
    .admin-navbar a:hover { color: #2563eb; }
    .admin-content { max-width: 700px; margin: 2rem auto; background: #fff; border-radius: 14px; box-shadow: 0 4px 24px rgba(37,99,235,0.07); padding: 2.5rem 2rem; text-align: center; }
  </style>
</head>
<body>
  <div class="admin-navbar">
    <a href="../index.php">Siteye Dön</a>
    <a href="panel.php">Panel Ana Sayfa</a>
    <a href="../logout.php">Çıkış Yap</a>
  </div>
  <div class="admin-content">
    <h1>Admin Paneline Hoş Geldiniz</h1>
    <p>Hoş geldiniz, <b><?php echo htmlspecialchars($admin_login); ?></b>!</p>
    <p>Buradan siteyi yönetebilirsiniz.</p>
  </div>
</body>
</html> 