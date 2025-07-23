<?php
require('../vendor/autoload.php'); // menggunakan Dompdf
use Dompdf\Dompdf;

include '../koneksi.php';

$where = "WHERE status = 'selesai'";
if (!empty($_GET['tanggal_awal']) && !empty($_GET['tanggal_akhir'])) {
  $awal = $_GET['tanggal_awal'];
  $akhir = $_GET['tanggal_akhir'];
  $where .= " AND tanggal BETWEEN '$awal' AND '$akhir'";
}
$data = mysqli_query($koneksi, "SELECT * FROM pesanan $where");

$html = '
<h3>Histori Pengerjaan Bengkel</h3>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr><th>No</th><th>Tanggal</th><th>Layanan</th><th>Status</th></tr>';
$no = 1;
foreach ($data as $row) {
  $html .= "<tr>
    <td>{$no++}</td>
    <td>{$row['tanggal']}</td>
    <td>{$row['layanan']}</td>
    <td>{$row['status']}</td>
  </tr>";
}
$html .= '</table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("histori_pengerjaan.pdf", ["Attachment" => false]);
exit;
