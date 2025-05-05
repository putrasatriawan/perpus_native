<?php
include 'includes/auth.php';
include 'config/database.php';
include 'includes/header.php';

// Ambil data anggota
$query = "SELECT * FROM anggota ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<h2>Data Anggota Perpustakaan</h2>
<a href="tambah.php" class="btn-tambah">Tambah Anggota Baru</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Lengkap</th>
            <th>NIM</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Fakultas</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama_lengkap']; ?></td>
            <td><?php echo $row['nim']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['no_hp']; ?></td>
            <td><?php echo $row['fakultas']; ?></td>
            <td><?php echo $row['jurusan']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                <a href="proses/hapus_proses.php?id=<?php echo $row['id']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                <a href="cetak_kartu.php?id=<?php echo $row['id']; ?>" class="btn-cetak" target="_blank">Cetak Kartu</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
include 'includes/footer.php';
?>