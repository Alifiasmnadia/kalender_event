<?php
include "koneksi.php";
$cari = isset($_GET['cari']) ? $_GET['cari'] : "";

if($cari != ""){
$query = mysqli_query($conn,"
SELECT * FROM tb_event 
WHERE nama_event LIKE '%$cari%' 
OR nama_sekolah LIKE '%$cari%'
OR kategori LIKE '%$cari%'
");
}else{
$query = mysqli_query($conn,"SELECT * FROM tb_event");
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<title>Daftar Event</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>


<body class="event-page">

<?php
$halaman = basename($_SERVER['PHP_SELF']);
?>

<?php include 'navbar.php'; ?>

<div class="container-fluid mt-4 px-5">
<h3>Daftar Event</h3>
<p class="text-muted">Menampilkan seluruh data event yang terdaftar</p>

<div class="card-box">

<div class="d-flex justify-content-between mb-3">

<form method="GET" class="d-flex w-25">
<input type="text" name="cari" class="form-control"
placeholder="Cari nama event..."
value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
<button type="submit" class="btn btn-primary ms-2">Cari</button>
</form>
<div>
<a class="btn btn-primary" href="t_event.php">Tambah Event</a>

<a class="btn btn-danger" href="cetak_event.php" target="_blank">
Cetak PDF
</a>
</div>

</div>

<div class="table-responsive">

<table class="table table-event table-bordered table-hover table-sm align-middle text-center">

<thead class="table-dark">
<tr>
<th>No</th>
<th>Foto</th>
<th>Nama Event</th>
<th>Tanggal</th>
<th>Sekolah</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php 
$no = 1;
while($e = mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++ ?></td>

<td>
<?php if($e['foto'] != ""){ ?>
<img src="upload/<?= $e['foto'] ?>" style="width:55px;height:40px;object-fit:cover;">
<?php }else{ ?>
<span class="text-muted">-</span>
<?php } ?>
</td>

<td class="text-start"><?= $e['nama_event'] ?></td>

<td><?= $e['tanggal'] ?></td>

<td><?= $e['nama_sekolah'] ?></td>

<td>
<?php
$status = strtolower(trim($e['status']));
$warna = 'bg-secondary'; // default kalau tidak cocok
$warna = 'bg-warning text-dark';

if($status == 'selesai'){
    $warna = 'bg-success';
}elseif($status == 'proses'){
    $warna = 'bg-warning text-dark';
}elseif($status == 'batal'){
    $warna = 'bg-danger';
}
?>

<span class="badge badge-custom <?= $warna ?>">
<?= $e['status'] ?>
</span>
</td>

<td>
<div class="d-flex justify-content-center gap-1">

<a href="edit_event.php?id=<?= $e['id'] ?>" 
class="btn btn-sm btn-warning px-2 py-1">
<i class="bi bi-pencil-square"></i>
</a>

<a href="hapus_event.php?id=<?= $e['id'] ?>" 
class="btn btn-sm btn-danger px-2 py-1"
onclick="return confirm('Yakin ingin menghapus event ini?')">
<i class="bi bi-trash"></i>
</a>

</div>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>
</div>


<?php include 'footer.php'; ?>


</body>
</html>