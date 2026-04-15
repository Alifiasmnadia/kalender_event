<?php
include "koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM tb_event WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

$nama_event = $_POST['nama_event'];
$kategori = $_POST['kategori'];
$tanggal = $_POST['tanggal'];
$lokasi = $_POST['lokasi'];
$jumlah_peserta = $_POST['jumlah_peserta'];
$nama_sekolah = $_POST['nama_sekolah'];
$nama_guru_bk = $_POST['nama_guru_bk'];
$no_telp = $_POST['no_telp'];
$status = $_POST['status'];

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

if($foto != ""){
    
    if(!is_dir('upload')){
        mkdir('upload',0777,true);
    }

    move_uploaded_file($tmp,"upload/".$foto);

    mysqli_query($conn,"UPDATE tb_event SET
    nama_event='$nama_event',
    kategori='$kategori',
    tanggal='$tanggal',
    lokasi='$lokasi',
    nama_sekolah='$nama_sekolah',
    nama_guru_bk='$nama_guru_bk',
    no_telp='$no_telp',
    jumlah_peserta='$jumlah_peserta',
    status='$status',
    foto='$foto'
    WHERE id='$id'");

}else{

    mysqli_query($conn,"UPDATE tb_event SET
    nama_event='$nama_event',
    kategori='$kategori',
    tanggal='$tanggal',
    lokasi='$lokasi',
    nama_sekolah='$nama_sekolah',
    nama_guru_bk='$nama_guru_bk',
    no_telp='$no_telp',
    jumlah_peserta='$jumlah_peserta',
    status='$status'
    WHERE id='$id'");
}

header("Location:event.php");
}
?>
<!DOCTYPE html>
<html>
<head>

<title>Edit Event</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h3>Edit Event</h3>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Nama Kegiatan</label>
<input type="text" name="nama_event" class="form-control" value="<?= $data['nama_event'] ?>">
</div>

<div class="row">

<div class="col-md-6">
<label>Kategori</label>
<input type="text" name="kategori" class="form-control" value="<?= $data['kategori'] ?>">
</div>

<div class="col-md-6">
<label>Lokasi</label>
<input type="text" name="lokasi" class="form-control" value="<?= $data['lokasi'] ?>">
</div>

</div>

<div class="mt-3">
<label>Tanggal</label>
<input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal'] ?>">
</div>

<div class="mt-3">
<label>Jumlah Peserta</label>
<input type="number" name="jumlah_peserta" class="form-control" value="<?= $data['jumlah_peserta'] ?>">
</div>

<div class="mt-3">
<label>Status</label>
<input type="text" name="status" class="form-control" value="<?= $data['status'] ?>">
</div>

<div class="mt-3">
<label>Nama Sekolah</label>
<input type="text" name="nama_sekolah" class="form-control" value="<?= $data['nama_sekolah'] ?>">
</div>

<div class="mt-3">
<label>Nama Guru BK</label>
<input type="text" name="nama_guru_bk" class="form-control" value="<?= $data['nama_guru_bk'] ?>">
</div>

<div class="mt-3">
<label>No Telp</label>
<input type="text" name="no_telp" class="form-control" value="<?= $data['no_telp'] ?>">
</div>

<div class="mt-3">
<label>Foto</label>
<input type="file" name="foto">
</div>

<div class="mt-4">

<button type="submit" name="update" class="btn btn-primary">
Update
</button>

<a href="event.php" class="btn btn-secondary">
Kembali
</a>

</div>

</form>

</div>

</body>
</html>