<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
session_start();
$url = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
$pagename = "Test1";
$lasturl = $_SERVER['REQUEST_URI'];
$lasturl2= $url . $lasturl;
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pagename; ?> | MyWebsite</title>
    <style>
        background-color: black;
    </style>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<body>
    <?php 
         include "../nav.php";
         ?>
    <main>
        <?php 
        echo $lasturl2;
        ?>
    </main>
    <footer>
        <p>&copy; 2023 Şirket Adı. Tüm hakları saklıdır.</p>
    </footer>
</body>

</html>
<?php
//fonksiyonlar
function girislink()
{

        $url = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    echo <<<HTML
            <li><a href="http://$url/login-register">Giriş/Kayıt</a></li>
            HTML;
}
function cikislink()
{
    $url = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    echo <<<HTML
    <li><a href="http://$url/logout" >Çıkış Yap</a></li>
HTML;
}

function hosgeldinyazi()
{
    echo '<h2>Hoş geldiniz, ' . $_COOKIE["username"] . '</h2>';
}
?>