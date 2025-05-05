<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    $query = "SELECT * FROM admin WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        if (password_verify($password, $admin['password'])) {
            session_start();
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