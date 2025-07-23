<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login/login.php");
  exit();
}

include '../koneksi.php';

// Validasi ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
  echo "<script>alert('ID tidak valid!'); window.location.href='index.php';</script>";
  exit();
}

// Ambil data layanan berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id = '$id'");
if (!$query) {
  die("Query error: " . mysqli_error($koneksi));
}
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
  echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php';</script>";
  exit();
}

$success = "";
$error = "";

// Jika form disubmit
if (isset($_POST['update'])) {
  $nama = trim($_POST['nama']);
  $deskripsi = trim($_POST['deskripsi']);
  $harga = trim($_POST['harga']);

  if ($nama && $deskripsi && $harga) {
    $update = mysqli_query($koneksi, "UPDATE layanan SET 
      nama = '".mysqli_real_escape_string($koneksi, $nama)."',
      deskripsi = '".mysqli_real_escape_string($koneksi, $deskripsi)."',
      harga = '".mysqli_real_escape_string($koneksi, $harga)."'
      WHERE id = '$id'
    ");

    if ($update) {
      $success = "Layanan berhasil diperbarui!";
    } else {
      $error = "Gagal memperbarui layanan: " . mysqli_error($koneksi);
    }
  } else {
    $error = "Semua field wajib diisi.";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Layanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-warning text-dark fw-bold">
      Edit Layanan Bengkel
    </div>
    <div class="card-body">
      <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
        <script>setTimeout(() => window.location.href = 'index.php', 1500);</script>
      <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Layanan</label>
          <input type="text" class="form-control" name="nama" id="nama"
                 value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
          <label for="harga" class="form-label">Harga (Rp)</label>
          <input type="number" class="form-control" name="harga" id="harga"
                 value="<?= htmlspecialchars($data['harga']) ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Perbarui</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
