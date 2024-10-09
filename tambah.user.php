<?php
require 'koneksi.php'; // Pastikan koneksi ke database sudah benar
session_start();

$success = ''; // Inisialisasi variabel sukses

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Simpan password dalam bentuk hash
    $position = $_POST['position']; // Ambil posisi dari form

    // Menambahkan user ke database
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, position) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $position]);
        $success = "User berhasil ditambahkan!";
    } catch (PDOException $e) {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Tambah User</h2>
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label for="position">Posisi:</label>
            <input type="text" class="form-control" name="position" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah User</button>
    </form>
</div>

</body>
</html>
