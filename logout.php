<?php
require_once 'includes/database.php';
require_once 'includes/Language.php';
require_once 'includes/helpers.php';

// Session başlat
session_start();

// Bütün session dəyişənlərini təmizlə
$_SESSION = array();

// Session cookie-ni sil
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Session-u məhv et
session_destroy();

// Ana səhifəyə yönləndir
header("Location: index.php");
exit();
?> 