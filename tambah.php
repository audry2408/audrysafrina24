<?php
// pesanan/tambah.php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
  header("Location: ../login/login.php");
  exit();
}
include '../koneksi.php';

// Ambil daftar layanan
$layanan = mysqli_query($koneksi, "SELECT * FROM layanan");

// Proses simpan pesanan
if (isset($_POST['submit'])) {
  $id_user = $_SESSION['id_user'];
  $id_layanan = $_POST['id_layanan'];
  $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
  $tanggal = date('Y-m-d H:i:s');

  $query = "INSERT INTO pesanan (id_user, id_layanan, deskripsi, tanggal, status) 
            VALUES ('$id_user', '$id_layanan', '$deskripsi', '$tanggal', 'Menunggu Konfirmasi')";
  mysqli_query($koneksi, $query);
  header("Location: ../customer/dashboard.php?notif=Pesanan berhasil dikirim");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesan Layanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3>Form Pesan Layanan</h3>
  <form method="POST">
    <div class="mb-3">
      <label for="id_layanan" class="form-label">Pilih Layanan</label>
      <select name="id_layanan" class="form-select" required>
        <option value="">-- Pilih --</option>
        <?php while ($row = mysqli_fetch_assoc($layanan)) : ?>
          <option value="<?= $row['id'] ?>"><?= $row['nama_layanan'] ?> - Rp<?= number_format($row['harga']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi Permintaan</label>
      <textarea name="deskripsi" class="form-control" required></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-success">Kirim Pesanan</button>
    <a href="../customer/dashboard.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
