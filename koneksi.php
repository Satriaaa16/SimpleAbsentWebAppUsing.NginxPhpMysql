<?php
$host = '127.0.0.1'; // Use 127.0.0.1 instead of localhost
$db   = 'absen';
$user = 'root';
$pass = 'Ser@ng161203'; // Your MySQL password

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4"; // Use TCP/IP instead of socket
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "<script>alert('Koneksi berhasil!');</script>";
} catch (\PDOException $e) {
    echo "<script>alert('Koneksi gagal: " . addslashes($e->getMessage()) . "');</script>";
}
?>
