<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['register'])) {
  $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
  $username = mysqli_real_escape_string($koneksi, $_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role     = $_POST['role'];

  $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
  if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username sudah digunakan!'); window.location='register.php';</script>";
  } else {
    $simpan = mysqli_query($koneksi, "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$password', '$role')");
    if ($simpan) {
      echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login/login.php';</script>";
    } else {
      echo "<script>alert('Registrasi gagal!'); window.location='register.php';</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi | Revolusi Jaya Mandiri</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .card {
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 10px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 450px;
    }
    .logo {
      width: 100px;
      margin: 0 auto 20px;
      display: block;
    }
  </style>
</head>
<body>
  <div class="card bg-white">
    <img src="logo.jpeg" alt="Logo Bengkel" class="logo">
    <h4 class="text-center mb-4">Form Registrasi</h4>
    <form method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="role" class="form-label">Daftar Sebagai</label>
        <select name="role" id="role" class="form-select" required>
          <option value="" disabled selected>-- Pilih Role --</option>
          <option value="admin">Admin</option>
          <option value="customer">Customer</option>
        </select>
      </div>
      <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
    </form>
    <div class="mt-3 text-center">
      Sudah punya akun? <a href="login/login.php">Login di sini</a>
    </div>
  </div>
</body>
</html>
