<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
  header("Location: ../login/login.php");
  exit();
}

include '../koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $hapus = mysqli_query($koneksi, "DELETE FROM layanan WHERE id = '$id'");

  if ($hapus) {
    echo "<script>
      alert('Layanan berhasil dihapus!');
      window.location.href = 'index.php';
    </script>";
  } else {
    echo "<script>
      alert('Gagal menghapus layanan: " . mysqli_error($koneksi) . "');
      window.location.href = 'index.php';
    </script>";
  }
} else {
  echo "<script>
    alert('ID tidak valid!');
    window.location.href = 'index.php';
  </script>";
}
