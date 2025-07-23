<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login | Bengkel Las Revolusi Jaya Mandiri</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-box {
      margin-top: 80px;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .logo {
      font-size: 28px;
      font-weight: bold;
      color: #007bff;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center">
    <div class="login-box col-md-5">
      <div class="text-center mb-4">
        <div class="logo">🔧 Revolusi Jaya Mandiri</div>
        <small class="text-muted">Login ke akun Anda</small>
      </div>
      <form action="proses_login.php" method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Login Sebagai</label>
          <select name="role" class="form-control" required>
            <option value="customer">Customer</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk</button>
        <div class="text-center mt-3">
          Belum punya akun? <a href="../register.php">Daftar Sekarang</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
