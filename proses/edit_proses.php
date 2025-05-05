<?php
include '../includes/auth.php';
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $nama_lengkap = sanitize_input($_POST['nama_lengkap']);
    $no_hp = sanitize_input($_POST['no_hp']);
    $alamat = sanitize_input($_POST['alamat']);
    $email = sanitize_input($_POST['email']);
    $jenis_kelamin = sanitize_input($_POST['jenis_kelamin']);
    $tanggal_lahir = sanitize_input($_POST['tanggal_lahir']);
    $nim = sanitize_input($_POST['nim']);
    $fakultas = sanitize_input($_POST['fakultas']);
    $jurusan = sanitize_input($_POST['jurusan']);

    $query = "UPDATE anggota SET 
              nama_lengkap = ?, 
              no_hp = ?, 
              alamat = ?, 
              email = ?, 
              jenis_kelamin = ?, 
              tanggal_lahir = ?, 
              nim = ?, 
              fakultas = ?, 
              jurusan = ? 
              WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssssssi", $nama_lengkap, $no_hp, $alamat, $email, $jenis_kelamin, $tanggal_lahir, $nim, $fakultas, $jurusan, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../dashboard.php?success=1");
    } else {
        header("Location: ../edit.php?id=$id&error=" . urlencode("Gagal mengupdate data: " . mysqli_error($conn)));
    }
    exit;
} else {
    header("Location: ../dashboard.php");
    exit;
}
?>