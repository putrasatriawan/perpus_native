<?php
include '../config/db.php';
include '../session_check.php';

$nama_lengkap     = $_POST['nama_lengkap'];
$nomor_telepon    = $_POST['nomor_telepon'];
$alamat           = $_POST['alamat'];
$email            = $_POST['email'];
$jenis_kelamin    = $_POST['jenis_kelamin'];
$tanggal_lahir    = $_POST['tanggal_lahir'];
$nim              = $_POST['nim'];
$fakultas         = $_POST['fakultas'];
$jurusan          = $_POST['jurusan'];

$tanggal_pendaftaran = date('Y-m-d');
$masa_berlaku_kartu  = date('Y-m-d', strtotime('+3 months', strtotime($tanggal_pendaftaran)));

$query = "INSERT INTO anggota (
    nama_lengkap, nomor_telepon, alamat, email, jenis_kelamin,
    tanggal_lahir, nim, fakultas, jurusan,
    tanggal_pendaftaran, masa_berlaku_kartu
) VALUES (
    '$nama_lengkap', '$nomor_telepon', '$alamat', '$email', '$jenis_kelamin',
    '$tanggal_lahir', '$nim', '$fakultas', '$jurusan',
    '$tanggal_pendaftaran', '$masa_berlaku_kartu'
)";

if (mysqli_query($conn, $query)) {
    header("Location: index_anggota.php?msg=Berhasil menambahkan data");
} else {
    echo "Error: " . mysqli_error($conn);
}
