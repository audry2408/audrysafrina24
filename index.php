<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    } else {
        header("Location: customer/dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beranda | Revolusi Jaya Mandiri</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f6fa;
    }
    .container-box {
      background: #ffffff;
      padding: 40px;
      margin-top: 50px;
      border-radius: 15px;
      box-shadow: 0px 0px 25px rgba(0,0,0,0.1);
    }
    .logo img {
      width: 100px;
    }
    .btn-custom {
      padding: 12px 25px;
      font-size: 18px;
    }
    .footer {
      background: #343a40;
      color: #fff;
      padding: 30px 0;
      margin-top: 50px;
    }
  </style>
</head>
<body>

<!-- Kontainer utama -->
<div class="container">
  <div class="container-box text-center">

    <!-- Logo -->
    <div class="logo mb-3">
      <img src="logo.jpeg" alt="Logo Bengkel" class="mb-2">
      <h2 class="text-primary fw-bold">Bengkel Las Revolusi Jaya Mandiri</h2>
      <p class="text-muted">
        Spesialis Pembuatan & Perbaikan: Kanopi, Pagar, Tralis, Rak Besi, Pintu Besi dan Konstruksi Las Lainnya.<br>
        Profesional, Cepat, dan Terpercaya.
      </p>
    </div>

    <!-- Tombol Login & Daftar -->
    <div class="mt-4">
      <a href="login/login.php" class="btn btn-primary btn-custom me-3">🔐 Login</a>
      <a href="register.php" class="btn btn-outline-secondary btn-custom">📝 Daftar Akun</a>
    </div>
  </div>
</div>

<!-- Kontak dan Alamat -->
<div class="container mt-5">
  <div class="row text-center">
    <div class="col-md-4">
      <h5>📍 Alamat</h5>
      <p>Jl. tanggul kampung baru rt.07 rw. 10 , Kec. kembangan utara,<br>Kab. Las Mandiri, Jawa Barat</p>
    </div>
    <div class="col-md-4">
      <h5>📞 Kontak</h5>
      <p>0812-3456-7890 (WA/Call)</p>
    </div>
    <div class="col-md-4">
      <h5>✉️ Email</h5>
      <p>bengkel.revolusi@gmail.com</p>
    </div>
  </div>
</div>

<!-- Footer -->
<div class="footer text-center">
  <p class="mb-0">© <?= date("Y") ?> Bengkel Las Revolusi Jaya Mandiri. All rights reserved.</p>
</div>

</body>
</html>
