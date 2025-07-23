<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
  header("Location: ../login/login.php");
  exit();
}

include '../koneksi.php';
$username = $_SESSION['username'];

// Ambil histori pesanan user
$query = mysqli_query($koneksi, "
  SELECT p.*, l.nama AS nama_layanan, l.harga
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
  <title>Histori Anda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-success text-white fw-bold">
      Histori Anda - Progres dan Riwayat Pekerjaan
    </div>
    <div class="card-body table-responsive">
      <?php if (mysqli_num_rows($query) > 0): ?>
        <table class="table table-bordered table-striped">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Tanggal</th>
              <th>Layanan</th>
              <th>Harga</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
              <td><?= htmlspecialchars($row['nama_layanan']) ?></td>
              <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
              <td>
                <?php if ($row['status'] == 'pending'): ?>
                  <span class="badge bg-warning text-dark">Menunggu</span>
                <?php elseif ($row['status'] == 'proses'): ?>
                  <span class="badge bg-info text-dark">Diproses</span>
                <?php else: ?>
                  <span class="badge bg-success">Selesai</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="alert alert-info">Belum ada histori layanan.</div>
      <?php endif; ?>
      <a href="index.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
    </div>
  </div>
</div>
</body>
</html>
