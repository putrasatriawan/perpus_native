<?php
include '../includes/auth.php';
include '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "DELETE FROM anggota WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../dashboard.php?success=1");
    } else {
        header("Location: ../dashboard.php?error=" . urlencode("Gagal menghapus data: " . mysqli_error($conn)));
    }
    exit;
} else {
    header("Location: ../dashboard.php");
    exit;
}
?>