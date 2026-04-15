<?php
include "koneksi.php";

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date("n");

$seminar = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Seminar' AND MONTH(tanggal)='$bulan'"));
$workshop = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Workshop' AND MONTH(tanggal)='$bulan'"));
$pameran = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Pameran' AND MONTH(tanggal)='$bulan'"));
$edufair = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Edu Fair' AND MONTH(tanggal)='$bulan'"));
$kunjungan_sekolah = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Kunjungan Sekolah' AND MONTH(tanggal)='$bulan'"));
$sosialisasi_sekolah = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Sosialisasi Sekolah' AND MONTH(tanggal)='$bulan'"));
?>

<html>

<head>
<title>Statistik Event</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<body class="statisik-page">
   
<?php
$halaman = basename($_SERVER['PHP_SELF']);
?>

<?php include 'navbar.php'; ?>
<div class="container-fluid mt-4 px-5">

<h3>Data Statistik</h3>
<p class="text-muted">Menampilkan seluruh data Statisik event yang terdaftar</p>
<div class="card-box">

<form method="GET" class="mb-3">

<select name="bulan" class="form-control w-25" onchange="this.form.submit()">

<option value="1" <?= $bulan==1 ? 'selected' : '' ?>>Januari</option>
<option value="2" <?= $bulan==2 ? 'selected' : '' ?>>Februari</option>
<option value="3" <?= $bulan==3 ? 'selected' : '' ?>>Maret</option>
<option value="4" <?= $bulan==4 ? 'selected' : '' ?>>April</option>
<option value="5" <?= $bulan==5 ? 'selected' : '' ?>>Mei</option>
<option value="6" <?= $bulan==6 ? 'selected' : '' ?>>Juni</option>
<option value="7" <?= $bulan==7 ? 'selected' : '' ?>>Juli</option>
<option value="8" <?= $bulan==8 ? 'selected' : '' ?>>Agustus</option>
<option value="9" <?= $bulan==9 ? 'selected' : '' ?>>September</option>
<option value="10" <?= $bulan==10 ? 'selected' : '' ?>>Oktober</option>
<option value="11" <?= $bulan==11 ? 'selected' : '' ?>>November</option>
<option value="12" <?= $bulan==12 ? 'selected' : '' ?>>Desember</option>

</select>

</form>

<div>
<a class="btn btn-danger" href="cetak_statistik.php?bulan=<?= $bulan ?>" target="_blank">
Cetak PDF
</a>
</div>


<canvas id="grafikEvent"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('grafikEvent');

new Chart(ctx, {
type: 'bar',

data: {
labels: ['Seminar','Workshop','Pameran','Edu Fair', 'Kunjungan Sekolah', 'Sosialisasi Sekolah'],
datasets: [{
label: 'Jumlah Event',
data: [<?= $seminar ?>, <?= $workshop ?>, <?= $pameran ?>, <?= $edufair ?>, <?= $kunjungan_sekolah ?>, <?= $sosialisasi_sekolah ?>]
}]
}

});
</script>
</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>