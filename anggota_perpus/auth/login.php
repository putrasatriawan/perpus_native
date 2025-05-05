<?php
session_start();
include '../config/db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
$user = mysqli_fetch_assoc($query);

if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    header('Location: ../dashboard.php');
} else {
    echo "<script>alert('Email atau password salah'); window.location.href='../index.php';</script>";
}