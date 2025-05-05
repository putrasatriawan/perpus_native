<?php
include 'session_check.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - ePerpustakaan</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1592496001020-c6eab5da97f7') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            border: none;
            border-radius: 15px;
        }
        .btn-custom {
            background-color: #795548;
            color: white;
        }
        .btn-custom:hover {
            background-color:rgb(249, 246, 245);
        }
    </style>
</head>
<body>
<div class="overlay">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-lg">
                    <h3 class="text-center mb-4">Selamat datang, <?= $_SESSION['email']; ?>!</h3>
                    <div class="d-grid gap-3">
                        <a href="anggota/index_anggota.php" class="btn btn-custom">
                            <i class="bi bi-person-lines-fill me-2"></i>Lihat Data Anggota
                        </a>
                        <a href="auth/logout.php" class="btn btn-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>