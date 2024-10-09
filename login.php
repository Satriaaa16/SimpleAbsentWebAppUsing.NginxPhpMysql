<?php
require 'koneksi.php'; // Pastikan koneksi ke database sudah benar
session_start();

// Cek apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirect ke dashboard jika sudah login
    exit;
}

// Proses login jika form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // Periksa apakah user ditemukan dan password cocok
    if ($user && password_verify($password, $user['password'])) {
        // Login berhasil
        $_SESSION['username'] = $user['username'];
        header('Location: index.php'); // Ganti dengan halaman yang sesuai
        exit;
    } else {
        // Pesan kesalahan
        $error_message = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #007bff; /* Warna background biru */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: white; /* Warna form putih */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #007bff; /* Warna teks biru */
            margin-bottom: 20px;
        }

        .form-group label {
            color: #007bff; /* Warna label biru */
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Login</h2>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</div>

</body>
</html>
