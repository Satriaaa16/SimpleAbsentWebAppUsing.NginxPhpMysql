// Contoh query untuk memeriksa username dan password
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
$stmt->execute(['username' => $username, 'password' => $password]);

$user = $stmt->fetch();
if ($user) {
    // Login berhasil
    $_SESSION['username'] = $user['username'];
    header('Location: dashboard.php'); // Ganti dengan halaman yang sesuai
    exit;
} else {
    echo "Username atau Password salah!";
}
