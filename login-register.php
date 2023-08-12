<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
session_start();
$url = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
//giriş yapmışmı kontrol ediliyor cookie ile.
if (isset($_COOKIE["loggedin"]) && $_COOKIE["loggedin"] === "true") {
    gonder();
    exit;
}


//Veri Tabanı Bilgileri.
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

//Veri Tabanına Bağlanırken Hata Oldu Mu?
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt ve Giriş Sistemi</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            text-align: center;
            align-items: center;
            justify-content: center;
            background: #151515;
            color: white;
        }

        .login-form {
            position: relative;
            width: 370px;
            height: auto;
            background: #1b1b1b;
            padding: 40px 35px 60px;
            box-sizing: border-box;
            border: 1px solid black;
            border-radius: 5px;
            box-shadow: inset 0 0 1px #272727;
        }

        .text {
            font-size: 30px;
            color: #c7c7c7;
            font-weight: 600;
            letter-spacing: 2px;
        }

        form {
            margin-top: 40px;
        }

        form .field {
            margin-top: 20px;
            display: flex;
        }

        .field .fas {
            height: 50px;
            width: 60px;
            color: #868686;
            font-size: 20px;
            line-height: 50px;
            border: 1px solid #444;
            border-right: none;
            border-radius: 5px 0 0 5px;
            background: linear-gradient(#333, #222);
        }

        .field input,
        form button {
            height: 50px;
            width: 100%;
            outline: none;
            font-size: 19px;
            color: #868686;
            padding: 0 15px;
            border-radius: 0 5px 5px 0;
            border: 1px solid #444;
            caret-color: #339933;
            background: linear-gradient(#333, #222);
        }

        input:focus {
            color: #339933;
            box-shadow: 0 0 5px rgba(0, 255, 0, .2),
                inset 0 0 5px rgba(0, 255, 0, .1);
            background: linear-gradient(#333933, #222922);
            animation: glow .8s ease-out infinite alternate;
        }

        @keyframes glow {
            0% {
                border-color: #339933;
                box-shadow: 0 0 5px rgba(0, 255, 0, .2),
                    inset 0 0 5px rgba(0, 0, 0, .1);
            }

            100% {
                border-color: #6f6;
                box-shadow: 0 0 20px rgba(0, 255, 0, .6),
                    inset 0 0 10px rgba(0, 255, 0, .4);
            }
        }

        button {
            margin-top: 30px;
            border-radius: 5px !important;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
        }

        button:hover {
            color: #339933;
            border: 1px solid #339933;
            box-shadow: 0 0 5px rgba(0, 255, 0, .3),
                0 0 10px rgba(0, 255, 0, .2),
                0 0 15px rgba(0, 255, 0, .1),
                0 2px 0 black;
        }

        .link {
            margin-top: 25px;
            color: #868686;
        }

        .link a {
            color: #339933;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

        /* Div ve içerik için varsayılan stiller */
        .sisli-border {
            position: fixed;
            top: 5px;
            left: 5px;
            border: 2px solid lightblue;
            padding: 10px;
            border-radius: 20%;
        }

        .sisli-border p {
            margin: 0;
        }

        /* Mouse üzerine gelince efektin uygulanması */
        .sisli-border:hover {
            border-color: rgba(255, 255, 255, 0.5);
            /* Hafif beyaz (opaklık: 0.5) */
            background-color: rgba(255, 255, 255, 0.1);
            /* Hafif sisli beyaz (opaklık: 0.1) */
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            /* Kenarlarına hafif gölge */
            border-radius: 30%;
        }

        .sisli-border-yazi {
            text-decoration: none;
            font-size: auto;
            color: white;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>

    <div class="login-form">
        <div class="kayitform">
            <div class="text">
                <h4>Kayıt Formu</h4>
            </div>
            <form method="post" action="">
                <div class="field">
                    <div class="fas fa-user"></div>
                    <input type="text" name="username" required placeholder="Kullanıcı Adı">
                </div>
                <div class="field">
                    <div class="fas fa-envelope"></div>
                    <input type="email" name="email" required placeholder="E-Posta">
                    <br>
                </div>
                <div class="field">
                    <div class="fas fa-lock"></div>
                    <input type="password" name="password" required placeholder="Şifre">
                    <br>
                </div>
                <div class="field">
                    <input type="submit" name="register" value="Kayıt Ol">
                </div>
                <span style="color: white;">Eğer kayıt olmak isterseniz cookie izni ve tüm sonuçları kabul etmiş olursunuz!</span>
            </form>
        </div>
        <?php
        // Kayıt işlemi
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Şifreyi şifreleme
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Kullanıcı adı veya e-posta zaten kayıtlı mı kontrolü
            $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $result = $conn->query($check_query);

            if ($result->num_rows > 0) {
                echo <<<HTML
        <div class="field" style="font-size: 20px;"> <h5 style="color:red;">Kullanıcı Adı yada E-Posta Kayıtlı.</h5> </div>
        HTML;
            } else {
                // Kullanıcıyı veritabanına ekleme
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
                if ($conn->query($sql) === true) {
                    echo <<<HTML
        <div class="field" style="font-size: 20px;"> <h5 style="color:white;">Kayıt başarıyla tamamlandı! Giriş yapabilirsiniz.</h5> </div>
        HTML;
                } else {
                    echo "Hata oluştu: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        ?>
        <div class="kayitform">
            <div class="text">
                <br>
                <h4>Giriş Formu</h4>
            </div>
            <form method="post" action="">
                <div class="field">
                    <div class="fas fa-user"></div>
                    <input type="text" name="login_username_email" required placeholder="Kullanıcı adı veya E-posta">
                </div>

                <div class="field">
                    <div class="fas fa-lock"></div>
                    <input type="password" name="login_password" required placeholder="Şifre">
                </div>

                <div class="field">
                    <input type="submit" name="login" value="Giriş Yap">
                </div>
            </form>
        </div>
        <?php
        // Giriş işlemi
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
            $login_username_email = $_POST["login_username_email"];
            $login_password = $_POST["login_password"];

            // Veritabanında kullanıcıyı arama
            $sql = "SELECT * FROM users WHERE username='$login_username_email' OR email='$login_username_email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashed_password = $row["password"];

                // Şifre doğrulama
                if (password_verify($login_password, $hashed_password)) {
                    ob_end_clean();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $row["username"];
                    cookie();
                    gonder();
                    exit;
                } else {
                    echo <<<HTML
            <div class="field" style="font-size: 20px; color: white;"> <h5>Kullanıcı Adı Yada Şifre Bulunamadı!</h5> </div>
            HTML;
                }
            } else {
                echo <<<HTML
            <div class="field" style="font-size: 20px; color: white;"> <h5>Kullanıcı Adı Yada Şifre Bulunamadı!</h5> </div>
            HTML;
            }
        }

        ?>
    </div>
    <div class="sisli-border">
        <a href="http://<?php echo $url; ?>/index.php" class="sisli-border-yazi">Ana Sayfa</a>
    </div>
    <?php
    // Function Yeri
    function cookie()
    {
        setcookie("loggedin", "true", time() + (86400 * 30), "/"); // Oturum süresi 30 gün
        setcookie("username", $_SESSION["username"], time() + (86400 * 30), "/");
    }
    function gonder()
    {
        header("location: http://$url/");
    }
    ob_end_flush();
    ?>
</body>

</html>