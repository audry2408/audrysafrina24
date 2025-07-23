<?php
// login/proses_login.php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
$data = mysqli_fetch_assoc($query);

if ($data && password_verify($password, $data['password'])) {
  $_SESSION['username'] = $data['username'];
  $_SESSION['role'] = $data['role'];
  $_SESSION['id_user'] = $data['id']; // <- penting untuk histori

  if ($data['role'] == 'admin') {
    header("Location: ../admin/dashboard.php");
  } elseif ($data['role'] == 'customer') {
    header("Location: ../customer/dashboard.php");
  }
} else {
  echo "Login gagal. Username atau password salah.";
}
