<?php
include '../config/db.php';
include '../session_check.php';

$id               = $_POST['id'];
$nama_lengkap     = $_POST['nama_lengkap'];
$nomor_telepon    = $_POST['nomor_telepon'];
$alamat           = $_POST['alamat'];
$email            = $_POST['email'];
$jenis_kelamin    = $_POST['jenis_kelamin'];
$tanggal_lahir    = $_POST['tanggal_lahir'];
$nim              = $_POST['nim'];
$fakultas         = $_POST['fakultas'];
$jurusan          = $_POST['jurusan'];
$masa_berlaku_kartu = $_POST['masa_berlaku_kartu'];

$updateQuery = "UPDATE anggota SET 
    nama_lengkap = '$nama_lengkap',
    nomor_telepon = '$nomor_telepon',
    alamat = '$alamat',
    email = '$email',
    jenis_kelamin = '$jenis_kelamin',
    tanggal_lahir = '$tanggal_lahir',
    nim = '$nim',
    fakultas = '$fakultas',
    jurusan = '$jurusan'";

// Tambahkan jika masa berlaku kartu diubah
if (!empty($masa_berlaku_kartu)) {
    $updateQuery .= ", masa_berlaku_kartu = '$masa_berlaku_kartu'";
}

$updateQuery .= " WHERE id = $id";

if (mysqli_query($conn, $updateQuery)) {
    header("Location: index_anggota.php?msg=Data berhasil diperbarui");
} else {
    echo "Gagal update data: " . mysqli_error($conn);
}