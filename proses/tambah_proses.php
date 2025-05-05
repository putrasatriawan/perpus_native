<?php
include '../includes/auth.php';
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = sanitize_input($_POST['nama_lengkap']);
    $no_hp = sanitize_input($_POST['no_hp']);
    $alamat = sanitize_input($_POST['alamat']);
    $email = sanitize_input($_POST['email']);
    $jenis_kelamin = sanitize_input($_POST['jenis_kelamin']);
    $tanggal_lahir = sanitize_input($_POST['tanggal_lahir']);
    $nim = sanitize_input($_POST['nim']);
    $fakultas = sanitize_input($_POST['fakultas']);
    $jurusan = sanitize_input($_POST['jurusan']);
    
    $tanggal_daftar = date('Y-m-d');
    $masa_berlaku = calculate_expiry_date($tanggal_daftar);

    $query = "INSERT INTO anggota (nama_lengkap, no_hp, alamat, email, jenis_kelamin, tanggal_lahir, nim, fakultas, jurusan, tanggal_daftar, masa_berlaku) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssssssss", $nama_lengkap, $no_hp, $alamat, $email, $jenis_kelamin, $tanggal_lahir, $nim, $fakultas, $jurusan, $tanggal_daftar, $masa_berlaku);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../dashboard.php?success=1");
    } else {
        header("Location: ../tambah.php?error=" . urlencode("Gagal menambahkan data: " . mysqli_error($conn)));
    }
    exit;
} else {
    header("Location: ../tambah.php");
    exit;
}
?>