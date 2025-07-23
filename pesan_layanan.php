<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'customer') {
  header("Location: ../login/login.php");
  exit();
}
include '../koneksi.php';

// Ambil daftar layanan dari database
$layanan = mysqli_query($koneksi, "SELECT * FROM layanan");

// Handle form kirim
$success = "";
$error = "";

if (isset($_POST['kirim'])) {
  $username = $_SESSION['username'];
  $layanan_id = $_POST['layanan_id'];
  $tanggal = date('Y-m-d');
  $status = 'pending';

  if ($layanan_id) {
    $insert = mysqli_query($koneksi, "INSERT INTO pesanan (username, layanan_id, tanggal, status) VALUES ('$username', '$layanan_id', '$tanggal', '$status')");
    if ($insert) {
      $success = "Pesanan berhasil dikirim!";
    } else {
      $error = "Gagal mengirim pesanan: " . mysqli_error($koneksi);
    }
  } else {
    $error = "Silakan pilih layanan terlebih dahulu.";
  }
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
  <div class="card">
    <div class="card-header bg-primary text-white">
      Ajukan Permintaan Pekerjaan Las
    </div>
    <div class="card-body">
      <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
      <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label for="layanan_id" class="form-label">Pilih Layanan</label>
          <select name="layanan_id" id="layanan_id" class="form-select" required>
            <option value="">-- Pilih --</option>
            <?php while ($row = mysqli_fetch_assoc($layanan)) : ?>
              <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nama']) ?> - Rp<?= number_format($row['harga'], 0, ',', '.') ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <button type="submit" name="kirim" class="btn btn-success">Kirim Pesanan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
