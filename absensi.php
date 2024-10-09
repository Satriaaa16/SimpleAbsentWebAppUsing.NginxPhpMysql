<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $tanggal = date('Y-m-d');
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO mahasiswa (nama, nim, tanggal, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nama, $nim, $tanggal, $status]);
    echo "Absensi berhasil ditambahkan!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Absensi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            margin: 0;
            background-image: url('tes.jpeg'); /* Ganti dengan jalur gambar Anda */
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px; /* Membatasi lebar maksimum form */
            width: 100%; /* Agar form responsif */
        }

        .btn-back {
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>Tambah Absensi</h2>
        <form method="post" action="">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label>NIM:</label>
                <input type="text" class="form-control" name="nim" required>
            </div>
            <div class="form-group">
                <label>Status:</label>
                <select class="form-control" name="status" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Kirim</button>
        </form>

        <!-- Tombol Kembali -->
        <a href="index.php" class="btn btn-secondary btn-block btn-back">Kembali</a>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
