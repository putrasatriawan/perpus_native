<?php
include '../config/db.php';
include '../session_check.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];

// Cek apakah data dengan ID tersebut ada
$cek = mysqli_query($conn, "SELECT * FROM anggota WHERE id = $id");
if (mysqli_num_rows($cek) == 0) {
    die("Data tidak ditemukan.");
}

// Hapus data
$hapus = mysqli_query($conn, "DELETE FROM anggota WHERE id = $id");

if ($hapus) {
    header("Location: index_anggota.php?msg=Data berhasil dihapus");
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
