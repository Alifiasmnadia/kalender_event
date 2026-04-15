<?php
include "koneksi.php";

if(isset($_POST['simpan'])){

$nama_event = $_POST['nama_event'];
$kategori = $_POST['kategori'];
$tanggal = $_POST['tanggal'];
$lokasi = $_POST['lokasi'];
$jumlah_peserta = $_POST['jumlah_peserta'];
$nama_sekolah = $_POST['nama_sekolah'];
$nama_guru_bk = $_POST['nama_guru_bk'];
$no_telp = $_POST['no_telp'];
$status = $_POST['status'];

// Upload foto
 $foto = "";

if(isset($_FILES['foto']) && $_FILES['foto']['name'] != ""){

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

   

    move_uploaded_file($tmp,"upload/".$foto);
}
   
// Insert ke database
    $query = mysqli_query($conn, "INSERT INTO tb_event
(nama_event,kategori,tanggal,lokasi,nama_sekolah,nama_guru_bk,no_telp,jumlah_peserta,status,foto)
VALUES
('$nama_event','$kategori','$tanggal','$lokasi','$nama_sekolah','$nama_guru_bk','$no_telp','$jumlah_peserta','$status','$foto')");

    // Redirect ke daftar event
    header("Location:event.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Tambah Event</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container mt-4">

<h3>Tambah Event</h3>
<p class="text-muted">Isi form di bawah untuk menambahkan event kampus baru.</p>

<div class="card-box">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Nama Kegiatan</label>
<input type="text" name="nama_event" class="form-control">
</div>

<div class="row">

<div class="col-md-6">
<label>Kategori</label>
<select name="kategori" class="form-control">
<option value="">Pilih kategori</option>
<option>Seminar</option>
<option>Workshop</option>
<option>Edu Fair</option>
<option>Pameran</option>
<option>Kunjungan Sekolah</option>
<option>Sosialisasi Sekolah</option>
</select>
</div>

<div class="col-md-6">
<label>Lokasi</label>
<select name="lokasi" class="form-control">
<option value="">Pilih lokasi</option>
<option>Aula</option>
<option>Ruang Seminar</option>
<option>Gedung Kampus</option>
<option>Sekolah</option>
</select>
</div>

<div class="col-md-6">
<label>Tanggal</label>
<input type="date" name="tanggal" class="form-control">
</div>

</div>

<div class="mt-3">
<label>Jumlah Peserta Hadir</label>
<input type="number" name="jumlah_peserta" class="form-control" placeholder="Masukan jumlah peserta">
</div>

<div class="mt-3">
<label>Status</label>
<select name="status" class="form-control">
<option value="">Pilih Status</option>
<option>Upcoming</option>
<option>Berlangsung</option>
<option>Selesai</option>
</select>
</div>

<div class="row mt-3">

<div class="col-md-6">
<label>Nama Sekolah</label>
<input type="text" name="nama_sekolah" class="form-control">
</div>

<div class="col-md-6">
<label>Nama Guru BK</label>
<input type="text" name="nama_guru_bk" class="form-control">
</div>

</div>

<div class="row mt-3">

<div class="col-md-6">
<label>No.Telepon Guru BK</label>
<input type="text" name="no_telp" class="form-control" placeholder="+62">
</div>

</div>

<div class="mt-4">

<label>Unggah</label>

<div class="upload-box">
<input type="file" name="foto">
<p class="mt-2">Pilih Foto</p>
</div>

</div>

<div class="mt-4 d-flex justify-content-end gap-2">

<a href="event.php" class="btn btn-secondary">Kembali</a>

<button type="submit" name="simpan" class="btn btn-primary">
Simpan
</button>

</div>

</form>

</div>

</div>

</body>
</html>