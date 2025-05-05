<?php
include 'includes/auth.php';
include 'includes/header.php';
include 'config/database.php';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi dan sanitasi input
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

    // Insert ke database
    $query = "INSERT INTO anggota (nama_lengkap, no_hp, alamat, email, jenis_kelamin, tanggal_lahir, nim, fakultas, jurusan, tanggal_daftar, masa_berlaku) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssssssss", $nama_lengkap, $no_hp, $alamat, $email, $jenis_kelamin, $tanggal_lahir, $nim, $fakultas, $jurusan, $tanggal_daftar, $masa_berlaku);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: dashboard.php?success=1");
        exit;
    } else {
        $error = "Gagal menambahkan data: " . mysqli_error($conn);
    }
}
?>

<h2>Tambah Anggota Baru</h2>
<?php if ($error): ?>
    <div class="error-message"><?php echo $error; ?></div>
<?php endif; ?>

<form action="tambah.php" method="post">
    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" required>
    </div>
    
    <div class="form-group">
        <label for="no_hp">No HP:</label>
        <input type="text" id="no_hp" name="no_hp" required>
    </div>
    
    <div class="form-group">
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    
    <div class="form-group">
        <label>Jenis Kelamin:</label>
        <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki" required>
        <label for="laki">Laki-laki</label>
        <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
        <label for="perempuan">Perempuan</label>
    </div>
    
    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
    </div>
    
    <div class="form-group">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required>
    </div>
    
    <div class="form-group">
        <label for="fakultas">Fakultas:</label>
        <input type="text" id="fakultas" name="fakultas" required>
    </div>
    
    <div class="form-group">
        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" required>
    </div>
    
    <button type="submit" class="btn-submit">Submit</button>
    <a href="dashboard.php" class="btn-cancel">Batal</a>
</form>

<?php
include 'includes/footer.php';
?>