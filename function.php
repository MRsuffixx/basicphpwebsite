<?php
function girislink()
{
    echo <<<HTML
            <li><a href="login-register">Giriş/Kayıt</a></li>
            HTML;
}
function cikislink()
{
    echo <<<HTML
            <li><a href="logout" >Çıkış Yap</a></li>
            HTML;
}
function hosgeldinyazi()
{
    if (isset($_COOKIE["loggedin"]) && $_COOKIE["loggedin"] === "true") {
        $girisyaptimi = "Evet";
        echo '<h2>Hoş geldiniz, ' . $_COOKIE["username"] . ' - Giriş Yapıldı mı? ' . $girisyaptimi . ' </h2>';
    } else {
        echo '<h2>Hoş geldiniz, ' . $_COOKIE["username"] . ' </h2>';
    }
}
?>
