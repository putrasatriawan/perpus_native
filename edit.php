<?php
include 'includes/auth.php';
include 'config/database.php';
include 'includes/header.php';

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
    
    // Update data
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
        header("Location: dashboard.php?success=1");
        exit;
    } else {
        $error = "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<h2>Edit Data Anggota</h2>
<?php if ($error): ?>
    <div class="error-message"><?php echo $error; ?></div>
<?php endif; ?>

<form action="edit.php?id=<?php echo $id; ?>" method="post">
    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo $anggota['nama_lengkap']; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="no_hp">No HP:</label>
        <input type="text" id="no_hp" name="no_hp" value="<?php echo $anggota['no_hp']; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required><?php echo $anggota['alamat']; ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $anggota['email']; ?>" required>
    </div>
    
    <div class="form-group">
        <label>Jenis Kelamin:</label>
        <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki" <?php echo ($anggota['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?> required>
        <label for="laki">Laki-laki</label>
        <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" <?php echo ($anggota['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>>
        <label for="perempuan">Perempuan</label>
    </div>
    
    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $anggota['tanggal_lahir']; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" value="<?php echo $anggota['nim']; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="fakultas">Fakultas:</label>
        <input type="text" id="fakultas" name="fakultas" value="<?php echo $anggota['fakultas']; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" value="<?php echo $anggota['jurusan']; ?>" required>
    </div>
    
    <button type="submit" class="btn-submit">Update</button>
    <a href="dashboard.php" class="btn-cancel">Batal</a>
</form>

<?php
include 'includes/footer.php';
?>