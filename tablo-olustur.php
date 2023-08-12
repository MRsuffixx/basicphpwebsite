<?php
// Veritabanı bağlantısı
include 'config.php';

// Bağlantı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Tablo oluşturma SQL sorgusu
$sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "id, users, email, password tabloları başarıyla oluşturuldu.";
    sleep(2);
    header("Location: index.php");
    exit;
} else {
    echo "Hata: " . $conn->error;
}

$conn->close();
?>
