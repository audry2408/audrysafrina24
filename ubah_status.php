<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login/login.php");
  exit();
}

include '../koneksi.php';

// Validasi ID pesanan
$id = $_GET['id'] ?? '';
if (!$id) {
  echo "<script>alert('ID pesanan tidak valid.'); window.location.href='index.php';</script>";
  exit();
}

// Cek apakah pesanan ada
$cek = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id = '$id'");
if (mysqli_num_rows($cek) === 0) {
  echo "<script>alert('Pesanan tidak ditemukan.'); window.location.href='index.php';</script>";
  exit();
}

// Update status menjadi 'selesai'
$update = mysqli_query($koneksi, "UPDATE pesanan SET status = 'selesai' WHERE id = '$id'");
if ($update) {
  echo "<script>alert('Status pesanan diperbarui menjadi selesai.'); window.location.href='index.php';</script>";
} else {
  echo "<script>alert('Gagal mengubah status.'); window.location.href='index.php';</script>";
}
?>
