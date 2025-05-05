<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menghapus sanitize_input() karena tidak didefinisikan
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Password akan di-hash dengan SHA-1

    $query = "SELECT * FROM admin WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        
        // Membandingkan password dengan SHA-1
        if (sha1($password) === $admin['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $admin['email'];
            header("Location: ../dashboard.php");
            exit;
        }
    }
    
    // Jika login gagal
    header("Location: ../index.php?error=1");
    exit;
} else {
    header("Location: ../index.php");
    exit;
}
?>