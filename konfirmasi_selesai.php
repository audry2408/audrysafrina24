<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
  header("Location: ../login/login.php");
  exit();
}
include '../koneksi.php';

$id = $_GET['id'] ?? '';
if ($id) {
  $update = mysqli_query($koneksi, "UPDATE pesanan SET status = 'selesai' WHERE id = '$id'");
  if ($update) {
    echo "<script>alert('Pesanan telah diselesaikan'); window.location.href='index.php';</script>";
  } else {
    echo "<script>alert('Gagal menyelesaikan pesanan'); window.history.back();</script>";
  }
} else {
  echo "<script>alert('ID tidak valid'); window.history.back();</script>";
}
