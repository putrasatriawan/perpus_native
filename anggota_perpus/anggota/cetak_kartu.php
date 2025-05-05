<?php
include '../config/db.php';
include '../session_check.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM anggota WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data anggota tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Kartu Anggota</title>
    <style>
        body {
            background: #555;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            width: 500px;
            padding: 20px;
            border-radius: 8px;
            font-family: Arial, sans-serif;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        .card-header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .card-header img.logo {
            width: 50px;
            margin-right: 10px;
        }

        .card-header h2 {
            font-size: 18px;
            margin: 0;
        }

        .card-body {
            display: flex;
            gap: 15px;
        }

        .foto {
            width: 120px;
            height: 150px;
            background: #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
        }

        .data {
            font-size: 14px;
        }

        .barcode {
            margin-top: 10px;
        }

        @media print {
            body {
                background: none;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <img src="../assets/img/logo-universitas.jpg" class="logo" alt="Logo Universitas">
            <h2>KARTU ANGGOTA PERPUSTAKAAN AMARTA</h2>
        </div>

        <div class="card-body">
            <div class="foto">
            <img src="../assets/img/foto-mahasiswa.png" class="foto" alt="Logo Universitas">
            </div>
            <div class="data">
                <p><strong>ID Anggota:</strong> <?= $data['id']; ?></p>
                <p><strong>Nama:</strong> <?= $data['nama_lengkap']; ?></p>
                <p><strong>Jenis Kelamin:</strong> <?= $data['jenis_kelamin']; ?></p>
                <p><strong>Alamat:</strong> <?= $data['alamat']; ?></p>
                <p><strong>Fakultas:</strong> <?= $data['fakultas']; ?></p>
                <p><strong>Jurusan:</strong> <?= $data['jurusan']; ?></p>
                <p><strong>Masa Berlaku:</strong> <?= $data['masa_berlaku_kartu']; ?></p>
            </div>
        </div>

        <div class="barcode">
            <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= $data['id']; ?>&size=100x100" alt="Barcode">
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
