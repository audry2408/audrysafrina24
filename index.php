<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login/login.php");
  exit();
}
include '../koneksi.php';

// Filter pencarian
$cari = $_GET['cari'] ?? '';
$where = $cari ? "WHERE customer_nama LIKE '%$cari%' OR layanan_nama LIKE '%$cari%'" : '';

// Ambil data pesanan
$query = mysqli_query($koneksi, "SELECT * FROM pesanan $where ORDER BY id DESC");
?>

<?php
// Tambah kolom aksi dalam tabel pesanan
// Tambahkan di bagian dalam <table>
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Pesanan - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kelola Data Pesanan</h3>
    <form class="d-flex" method="get">
      <input type="text" name="cari" class="form-control me-2" placeholder="Cari nama/layanan..." value="<?= htmlspecialchars($cari) ?>">
      <button class="btn btn-outline-primary">Cari</button>
    </form>
  </div>

  <div class="card shadow">
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Customer</th>
            <th>Nama Layanan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($query) > 0): ?>
          <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['customer_nama']) ?></td>
              <td><?= htmlspecialchars($row['layanan_nama']) ?></td>
              <td><?= htmlspecialchars(date('d-m-Y', strtotime($row['tanggal']))) ?></td>
              <td>
                <?php
                $warna = [
                  'menunggu' => 'secondary',
                  'diproses' => 'warning',
                  'selesai' => 'success'
                ];
                ?>
                <span class="badge bg-<?= $warna[$row['status']] ?? 'dark' ?>">
                  <?= ucfirst($row['status']) ?>
                </span>
              </td>
              <td>
                <form method="post" action="ubah_status.php" class="d-flex">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                  <select name="status" class="form-select form-select-sm me-2" required>
                    <option value="menunggu" <?= $row['status'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                    <option value="diproses" <?= $row['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                    <option value="selesai" <?= $row['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                  </select>
                  <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6" class="text-center text-muted">Tidak ada data pesanan.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
