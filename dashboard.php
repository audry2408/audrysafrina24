<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
  header("Location: ../login/login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Customer - Bengkel Las</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar {
      background-color: #198754;
    }
    .navbar-brand, .nav-link, .text-white {
      color: #fff !important;
    }
    .card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border: none;
    }
    .btn-success {
      width: 100%;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Customer - Revolusi Jaya Mandiri</a>
    <div class="d-flex">
      <a href="../logout.php" class="btn btn-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </div>
  </div>
</nav>

<div class="container py-5">
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Pesan Layanan</h5>
          <p class="card-text">Ajukan permintaan pekerjaan las</p>
          <a href="../pesanan/tambah.php" class="btn btn-success">Pesan Sekarang</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Histori Anda</h5>
          <p class="card-text">Lihat progres dan histori layanan</p>
          <a href="../histori/index.php" class="btn btn-success">Lihat Histori</a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
