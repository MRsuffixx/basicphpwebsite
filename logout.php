<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Çerezi silme (geçerli zamanı önceki bir tarihe ayarlama)
setcookie("loggedin", "", time() - 3600, "/");
setcookie("username", "", time() - 3600, "/");
setcookie("permission_level", "", time() - 3600, "/");

session_start();
session_destroy();$url = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
header("Location: http://$url/index.php");
exit();
?>