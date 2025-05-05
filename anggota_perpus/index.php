<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ePerpustakaan</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 900px;
            margin: 5% auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
        }
        .login-image {
            flex: 1;
            background: url('assets/img/library.webp') center center/cover no-repeat;
        }
        .login-form {
            flex: 1;
            background-color: #fff;
            padding: 40px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #795548;
        }
        .btn-login {
            background-color: #795548;
            color: white;
        }
        .btn-login:hover {
            background-color: #5d4037;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-image"></div>
    <div class="login-form">
        <h3 class="mb-4 text-center fw-bold">Selamat datang!</h3>
        <form action="auth/login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan kata sandi" required>
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                </div>
            </div>
            <button type="submit" class="btn btn-login w-100">Masuk</button>
        </form>
        <?php if (isset($_GET['error'])) echo "<p class='text-danger mt-3 text-center'>".$_GET['error']."</p>"; ?>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>