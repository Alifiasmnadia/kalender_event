<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location:index.php");
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>

<body class="dashboard-page">

<!-- TOPBAR -->
<?php
$halaman = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark shadow" style="background: linear-gradient(to left, #0f172a, #1e3a8a);">
  <div class="container">

    <a class="navbar-brand fw-bold" href="dashboard.php">🎓 Admin UBSI</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">

      <!-- MENU -->
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link <?= ($halaman=='dashboard.php')?'active fw-bold':'' ?>" href="dashboard.php">
            Dashboard
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($halaman=='event.php')?'active fw-bold':'' ?>" href="event.php">
            Event
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($halaman=='statistik.php')?'active fw-bold':'' ?>" href="statistik.php">
            Statistik
          </a>
        </li>

        <!-- USER -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <?= isset($_SESSION['nama']) ? $_SESSION['nama'] : 'User'; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
          </ul>
        </li>

      </ul>

    </div>

  </div>
</nav>

<div class="container mt-4">

<!-- WELCOME -->
<div class="welcome-box">
<h5 class="mb-1">👋 Selamat Datang, <b>Alifia</b></h5>
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
<a href="statistik.php" class="btn btn-primary btn-sm mt-2">Lihat Statistik </a>
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


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">



<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>