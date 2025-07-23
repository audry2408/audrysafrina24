<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login/login.php");
  exit();
}
$user_id = $_SESSION['user_id'];
$where = "WHERE user_id = '$user_id' AND status = 'selesai'";
if (!empty($_GET['tanggal_awal']) && !empty($_GET['tanggal_akhir'])) {
  $awal = $_GET['tanggal_awal'];
  $akhir = $_GET['tanggal_akhir'];
  $where .= " AND tanggal BETWEEN '$awal' AND '$akhir'";
}
$data = mysqli_query($koneksi, "SELECT * FROM pesanan $where ORDER BY tanggal DESC");
?>

<!-- Tampilkan dengan Bootstrap Table -->
<div class="container mt-4">
  <h4>Riwayat Pengerjaan</h4>
  <form method="get" class="row mb-3">
    <!-- Form filter sama seperti di atas -->
  </form>
  <table class="table table-bordered">
    <thead>
      <tr><th>No</th><th>Tanggal</th><th>Layanan</th><th>Status</th></tr>
    </thead>
    <tbody>
      <?php $no=1; foreach ($data as $d): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $d['tanggal'] ?></td>
        <td><?= $d['layanan'] ?></td>
        <td><span class="badge bg-success"><?= $d['status'] ?></span></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
