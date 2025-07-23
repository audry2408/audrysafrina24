<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
  header("Location: ../login/login.php");
  exit();
}
include '../koneksi.php';
$username = $_SESSION['username'];
$query = mysqli_query($koneksi, "
  SELECT p.*, l.nama AS nama_layanan 
  FROM pesanan p 
  JOIN layanan l ON p.layanan_id = l.id 
  WHERE p.username = '$username'
  ORDER BY p.tanggal DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Pesanan Saya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
  <h3>Riwayat Pesanan Anda</h3>
  <table class="table table-bordered mt-3 bg-white">
    <thead class="table-light">
      <tr>
        <th>No</th>
        <th>Nama Layanan</th>
        <th>Tanggal</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama_layanan']) ?></td>
          <td><?= htmlspecialchars($row['tanggal']) ?></td>
          <td><?= htmlspecialchars(ucwords($row['status'])) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
