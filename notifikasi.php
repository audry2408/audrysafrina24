<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
  header("Location: login/login.php");
  exit();
}
include 'koneksi.php';

$query = mysqli_query($koneksi, "
  SELECT p.*, l.nama AS nama_layanan 
  FROM pesanan p 
  JOIN layanan l ON p.layanan_id = l.id 
  WHERE status = 'pending'
  ORDER BY tanggal DESC
");
?>

<div class="alert alert-info mt-3">
  <h5>Pesanan Baru Masuk</h5>
  <ul>
    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
      <li><?= htmlspecialchars($row['username']) ?> memesan <?= $row['nama_layanan'] ?> (<?= $row['tanggal'] ?>)</li>
    <?php endwhile; ?>
  </ul>
</div>
