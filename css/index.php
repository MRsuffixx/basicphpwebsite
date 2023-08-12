<?php
$url = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
$redirectURL = "http://$url/index.php";

// Yönlendirme işlemini gerçekleştirir
header("Location: $redirectURL");
exit;
?>

