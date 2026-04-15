<?php
include "koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM tb_event WHERE id='$id'");

if($query){
    header("Location:event.php");
}else{
    echo "Data gagal dihapus";
}
?>