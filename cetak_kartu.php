<?php
include 'includes/auth.php';
include 'config/database.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM anggota WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$anggota = mysqli_fetch_assoc($result);

if (!$anggota) {
    header("Location: dashboard.php");
    exit;
}

// Generate barcode
$barcode = generate_barcode($anggota['id']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .kartu {
            width: 85mm;
            height: 54mm;
            border: 1px solid #000;
            padding: 5mm;
            margin: 0 auto;
            position: relative;
        }
        .kop {
            text-align: center;
            border-bottom: 1px solid #000;
            padding-bottom: 3mm;
            margin-bottom: 3mm;
        }
        .kop img {
            height: 15mm;
        }
        .foto {
            width: 20mm;
            height: 25mm;
            border: 1px solid #000;
            float: left;
            margin-right: 3mm;
            background-color: #f0f0f0;
            text-align: center;
            line-height: 25mm;
            font-size: 10px;
        }
        .data {
            float: left;
            width: 50mm;
            font-size: 10px;
        }
        .barcode {
            text-align: center;
            margin-top: 2mm;
            clear: both;
            font-family: 'Libre Barcode 128', cursive;
            font-size: 20px;
        }
        .clear {
            clear: both;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="kartu">
        <div class="kop">
            <img src="assets/images/logo-univ.png" alt="Logo Universitas">
            <h3>PERPUSTAKAAN UNIVERSITAS</h3>
        </div>
        
        <div class="foto">FOTO</div>
        
        <div class="data">
            <p><strong>ID Anggota:</strong> <?php echo $anggota['id']; ?></p>
            <p><strong>Nama:</strong> <?php echo $anggota['nama_lengkap']; ?></p>
            <p><strong>Jenis Kelamin:</strong> <?php echo $anggota['jenis_kelamin']; ?></p>
            <p><strong>Alamat:</strong> <?php echo substr($anggota['alamat'], 0, 20) . '...'; ?></p>
            <p><strong>Fakultas:</strong> <?php echo $anggota['fakultas']; ?></p>
            <p><strong>Jurusan:</strong> <?php echo $anggota['jurusan']; ?></p>
            <p><strong>Masa Berlaku:</strong> <?php echo date('d/m/Y', strtotime($anggota['masa_berlaku'])); ?></p>
        </div>
        
        <div class="clear"></div>
        
        <div class="barcode">
            <?php echo $barcode; ?>
        </div>
    </div>
    
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Cetak Kartu</button>
        <button onclick="window.location.href='dashboard.php'">Kembali</button>
    </div>
</body>
</html>