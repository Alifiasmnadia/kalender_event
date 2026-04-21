<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location:index.php");
    exit;
}

include "koneksi.php";

/* TOTAL EVENT */
$total_event = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event"));

/* EVENT BULAN INI */
$bulan_ini = date("m");
$event_bulan = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM tb_event
WHERE MONTH(tanggal)='$bulan_ini'
"));

/* EVENT HARI INI */
$event_hari = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM tb_event
WHERE DATE(tanggal) = CURDATE()
"));

/* DATA KATEGORI */
$seminar = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Seminar'"));
$workshop = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Workshop'"));
$edufair = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Edu Fair'"));
$pameran = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Pameran'"));
$kunjungan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Kunjungan Sekolah'"));
$sosialisasi = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Sosialisasi Sekolah'"));

$data = [
"Seminar"=>$seminar,
"Workshop"=>$workshop,
"Edu Fair"=>$edufair,
"Pameran"=>$pameran,
"Kunjungan Sekolah"=>$kunjungan,
"Sosialisasi Sekolah"=>$sosialisasi
];
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Admin UBSI</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<link rel="stylesheet" href="style.css">

</head>

<body class="dashboard-page">

<?php
$halaman = basename($_SERVER['PHP_SELF']);
include 'navbar.php'; // ✅ include navbar
?>

<div class="container mt-4">

<!-- WELCOME -->
<div class="welcome-box">
<h5 class="mb-1">
👋 Selamat Datang, 
<b>
<?= (isset($_SESSION['role']) && $_SESSION['role']=="admin") 
    ? "Admin ".$_SESSION['nama'] 
    : $_SESSION['nama']; ?>
</b>
</h5>
<small>Kelola data event dengan mudah 🚀</small>
</div>

<!-- MENU -->
<div class="row mt-4 g-3">

<div class="col-md-6">
<div class="menu-card">
<div class="d-flex">
<div class="icon">📅</div>
<div>
<h5>Daftar Event</h5>
<small>Melihat dan mengelola semua event</small><br>
<a href="event.php" class="btn btn-primary btn-sm mt-2">
  Lihat Event
</a>
</div>
</div>
</div>
</div>

<div class="col-md-6">
<div class="menu-card">
<div class="d-flex">
<div class="icon">📊</div>
<div>
<h5>Data Statistik</h5>
<small>Menganalisis statistik event</small><br>
<a href="statistik.php" class="btn btn-primary btn-sm mt-2">
  Lihat Statistik
</a>
</div>
</div>
</div>
</div>

</div>

<!-- CARD STAT -->
<div class="row mt-4 g-3">

<div class="col-md-4">
<div class="card shadow text-center p-3">
<h6 class="text-muted">Total Event</h6>
<h2 class="fw-bold"><?= $total_event ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card shadow text-center p-3">
<h6 class="text-muted">Event Bulan Ini</h6>
<h2 class="fw-bold"><?= $event_bulan ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card shadow text-center p-3">
<h6 class="text-muted">Event Hari Ini</h6>
<h2 class="fw-bold"><?= $event_hari ?></h2>
</div>
</div>

</div>

<!-- STATISTIK -->
<div class="row mt-4 g-3">

<div class="col-md-4">
<h5>Statistik Kategori</h5>
<table class="table table-bordered table-striped">
<?php foreach($data as $nama=>$jumlah){ ?>
<tr>
<td><?= $nama ?></td>
<td width="80"><?= $jumlah ?></td>
</tr>
<?php } ?>
</table>
</div>

<div class="col-md-8">
<h5>Grafik Statistik Event</h5>
<canvas id="grafikEvent"></canvas>
</div>

</div>

<!-- EVENT TERBARU -->
<div class="row mt-4">

<div class="col-md-12">
<h5>Event Terbaru</h5>

<table class="table table-bordered table-striped">

<tr>
<th>Nama Event</th>
<th>Sekolah</th>
<th>Tanggal</th>
</tr>

<?php
$query = mysqli_query($conn,"
SELECT * FROM tb_event
ORDER BY tanggal DESC
LIMIT 5
");

while($d = mysqli_fetch_array($query)){
?>

<tr>
<td><?= $d['nama_event'] ?></td>
<td><?= $d['nama_sekolah'] ?></td>
<td><?= $d['tanggal'] ?></td>
</tr>

<?php } ?>

</table>

</div>

</div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('grafikEvent').getContext('2d');

new Chart(ctx, {
type: 'bar',
data: {
labels: ['Seminar','Workshop','Edu Fair','Pameran','Kunjungan Sekolah','Sosialisasi Sekolah'],
datasets: [{
label: 'Jumlah Event',
data: [
<?= $seminar ?>,
<?= $workshop ?>,
<?= $edufair ?>,
<?= $pameran ?>,
<?= $kunjungan ?>,
<?= $sosialisasi ?>
],
backgroundColor:[
'#4e73df',
'#1cc88a',
'#36b9cc',
'#f6c23e',
'#e74a3b',
'#858796'
]
}]
}
});
</script>

<!-- FOOTER -->
<?php include 'footer.php'; ?>

<!-- WAJIB: Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>