<?php
include "koneksi.php";

$bulan = $_GET['bulan'];

$seminar = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Seminar' AND MONTH(tanggal)='$bulan'"));
$workshop = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Workshop' AND MONTH(tanggal)='$bulan'"));
$pameran = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Pameran' AND MONTH(tanggal)='$bulan'"));
$edufair = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Edu Fair' AND MONTH(tanggal)='$bulan'"));
$kunjungan_sekolah = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='kunjungan Sekolah' AND MONTH(tanggal)='$bulan'"));
$sosialisasi_sekolah = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Sosialisasi Sekolah' AND MONTH(tanggal)='$bulan'"));

// hitung jumlah event berdasarkan kategori
$seminar = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Seminar'"));
$workshop = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Workshop'"));
$pameran = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Pameran'"));
$edufair = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Edu Fair'"));
$kunjungan_sekolah = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Kunjungan Sekolah'"));
$sosialisasi_sekolah = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_event WHERE kategori='Sosialisasi Sekolah'"));
?>

<!DOCTYPE html>
<html>
<head>

<title>Cetak Statistik Event</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
font-family: Arial;
padding:40px;
}

h2{
text-align:center;
margin-bottom:30px;
}

canvas{
max-width:700px;
margin:auto;
display:block;
}

.footer{
margin-top:40px;
text-align:right;
}
</style>

</head>

<body>

<h2>Laporan Statistik Event UBSI</h2>

<canvas id="grafikEvent"></canvas>

<div class="footer">
Dicetak pada : <?php echo date("d-m-Y"); ?>
</div>

<script>

const ctx = document.getElementById('grafikEvent');

new Chart(ctx, {
type: 'bar',

data: {
labels: ['Seminar','Workshop','Pameran','Edu Fair', 'Kunjungan Sekolah', 'Sosialisasi Sekolah'],
datasets: [{
label: 'Jumlah Event',
data: [<?php echo $seminar ?>, <?php echo $workshop ?>, <?php echo $pameran ?>, <?php echo $edufair ?>, <?php echo $kunjungan_sekolah ?>, <?php echo $sosialisasi_sekolah ?>],
backgroundColor:[
'#4e73df',
'#1cc88a',
'#36b9cc',
'#f6c23e'
]
}]
},

options:{
responsive:true,
plugins:{
legend:{
display:true
}
}
}

});

// otomatis membuka print setelah grafik muncul
setTimeout(function(){
window.print();
},1000);

</script>

</body>
</html>