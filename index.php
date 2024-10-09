<?php
require 'koneksi.php'; // Pastikan koneksi ke database sudah benar
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke halaman login jika tidak terautentikasi
    exit;
}

// Ambil data mahasiswa dari database
try {
    $stmt = $pdo->query("SELECT * FROM mahasiswa ORDER BY tanggal DESC");
    $records = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
    exit;
}

// Ambil username dari sesi
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Absensi Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            height: 100vh; /* Mengatur tinggi halaman */
            margin: 0; /* Menghilangkan margin default */
            background-image: url('tes.jpeg'); /* Ganti dengan jalur gambar Anda */
            background-size: cover; /* Menutupi seluruh area */
            background-position: center; /* Memusatkan gambar */
            display: flex; /* Menggunakan Flexbox */
            flex-direction: column; /* Mengatur arah Flexbox menjadi kolom */
        }

        .container {
            flex: 1; /* Membuat container mengisi ruang yang tersedia */
            display: flex;
            flex-direction: column; /* Mengatur isi container menjadi kolom */
            justify-content: center; /* Memusatkan isi secara vertikal */
            align-items: center; /* Memusatkan isi secara horizontal */
            background-color: rgba(255, 255, 255, 0.8); /* Warna latar belakang putih dengan transparansi */
            padding: 20px; /* Padding di sekitar container */
            border-radius: 10px; /* Sudut membulat */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Efek bayangan */
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7); /* Latar belakang footer transparan */
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
            transition: color 0.3s;
        }

        h1 {
            color: #343a40;
            margin-bottom: 20px;
            text-align: center; /* Centered title */
        }

        .table {
            margin-top: 30px; /* Jarak antara navbar dan tabel */
            margin-bottom: 30px; /* Jarak antara tabel dan footer */
            background-color: #ffffff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #007bff;
            color: #ffffff;
        }

        .table td {
            vertical-align: middle;
        }

        .logo {
            width: 50px; /* Ukuran logo */
            height: auto;
            margin-left: auto;
            margin-right: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">Absensi Mahasiswa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="absensi.php">Tambah Absensi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tambah.user.php">Tambah User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="scan.qr.php">Scan QR Code</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
    <img src="image/logo.png" alt="Logo" class="logo"> <!-- Logo di sebelah kanan -->
</nav>

<div class="container">
    <h1>Dashboard Absensi Mahasiswa</h1>
    <p>Welcome, <strong><?php echo htmlspecialchars($username); ?></strong>!</p>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($records): ?>
                <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['nama']); ?></td>
                        <td><?php echo htmlspecialchars($record['nim']); ?></td>
                        <td><?php echo date("d-m-Y", strtotime(htmlspecialchars($record['tanggal']))); ?></td> <!-- Pemformatan tanggal -->
                        <td><?php echo htmlspecialchars($record['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data absensi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Absensi Mahasiswa. All rights reserved.</p>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
