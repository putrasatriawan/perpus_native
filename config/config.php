<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'e_perpustakaan';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Buat tabel jika belum ada
$query = "CREATE TABLE IF NOT EXISTS anggota (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    alamat TEXT NOT NULL,
    email VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tanggal_lahir DATE NOT NULL,
    nim VARCHAR(20) NOT NULL,
    fakultas VARCHAR(50) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    tanggal_daftar DATE NOT NULL,
    masa_berlaku DATE NOT NULL
)";

$query_admin = "CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

mysqli_query($conn, $query);
mysqli_query($conn, $query_admin);

// Tambah admin default jika belum ada
$check_admin = "SELECT * FROM admin WHERE email = 'admin@perpustakaan.com'";
$result = mysqli_query($conn, $check_admin);

if (mysqli_num_rows($result) == 0) {
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $insert_admin = "INSERT INTO admin (email, password) VALUES ('admin@perpustakaan.com', '$password')";
    mysqli_query($conn, $insert_admin);
}
?>