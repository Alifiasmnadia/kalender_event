<?php
include "koneksi.php";

$query = mysqli_query($conn,"SELECT * FROM tb_event");
?>

<!DOCTYPE html>
<html>
<head>
<title>Cetak Event</title>

<style>
body{
font-family: Arial;
}

h2{
text-align:center;
}

table{
width:100%;
border-collapse:collapse;
}

table, th, td{
border:1px solid black;
}

th, td{
padding:8px;
text-align:center;
}

th{
background:#f2f2f2;
}
</style>

</head>

<body onload="window.print()">

<h2>Laporan Data Event UBSI</h2>

<table>

<tr>
<th>No</th>
<th>Kategori</th>
<th>Nama Event</th>
<th>Tanggal</th>
<th>Lokasi</th>
<th>Nama Sekolah</th>
<th>Guru BK</th>
<th>No Telp</th>
<th>Peserta</th>
<th>Status</th>
</tr>

<?php
$no=1;
while($data = mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++ ?></td>
<td><?= $data['kategori'] ?></td>
<td><?= $data['nama_event'] ?></td>
<td><?= $data['tanggal'] ?></td>
<td><?= $data['lokasi'] ?></td>
<td><?= $data['nama_sekolah'] ?></td>
<td><?= $data['nama_guru_bk'] ?></td>
<td><?= $data['no_telp'] ?></td>
<td><?= $data['jumlah_peserta'] ?></td>
<td><?= $data['status'] ?></td>

</tr>

<?php } ?>

</table>

</body>
</html>