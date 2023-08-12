<?php
// Yönlendirme yapılacak URL'i burada belirtin
$redirectURL = 'http://192.168.0.104/index.php';

// Yönlendirme işlemini gerçekleştirir
header("Location: $redirectURL");
exit;
?>