<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$url = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <title>MyWebsite</title>
    <style type="text/css">
        /* CSS */
        .mybutonlar {
            align-items: center;
            background-color: #190061;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: .25rem;
            box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
            box-sizing: border-box;
            color: white;
            cursor: pointer;
            display: inline-flex;
            font-family: system-ui, -apple-system, system-ui, "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: 600;
            justify-content: center;
            line-height: 1.25;
            margin: 5px;
            min-height: 3rem;
            padding: calc(.875rem - 1px) calc(1.5rem - 1px);
            position: relative;
            text-decoration: none;
            transition: all 250ms;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: baseline;
            width: auto;
        }

        .mybutonlar:hover,
        .mybutonlar:focus {
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
            color: gray;
        }

        .mybutonlar:hover {
            transform: translateY(-1px);
        }

        .mybutonlar:active {
            background-color: #F0F0F1;
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px;
            color: rgba(0, 0, 0, 0.65);
            transform: translateY(0);
        }
    </style>
    <link rel="stylesheet" href="-/style/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <?php 
         include "nav.php";
         ?>
    <main>
        <?php 
            if (isset($_COOKIE["loggedin"]) && $_COOKIE["loggedin"] === "true") {
            hosgeldinyazi();
        }
        ?>
        <div>
            <?php
            $folder_path = "-/"; // my klasörünün yolu
            $button_html = ''; // Butonların HTML kodu

            // Klasördeki dosyaları tarayalım
            $files = glob($folder_path . "my*.php");
            if ($files) {
                // Her dosya için butonları oluşturalım
                foreach ($files as $file) {
                    // Dosyanın içeriğini alalım
                    $file_content = file_get_contents($file);

                    // Dosyanın içindeki "pagename" değişkenini bulalım
                    preg_match('/\$pagename\s*=\s*"([^"]+)"/', $file_content, $matches);
                    $page_name = isset($matches[1]) ? $matches[1] : 'Sayfa';

                    // Buton HTML kodunu oluşturalım
                    $button_html .= '<button class="mybutonlar" role="button" onclick="location.href=\'' . $file . '\'">' . $page_name . '</button> &nbsp&nbsp';
                }
            } else {
                echo "Hiç my php dosyası bulunamadı.";
            }
            ?>
            <div class="buton-container">
                <?php echo $button_html; ?>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 Şirket Adı. Tüm hakları saklıdır.</p>
    </footer>

</body>

</html>
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