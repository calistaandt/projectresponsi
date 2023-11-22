<?php 
session_start();
$nama_karakter= $_POST['nama_karakter'];
$deskripsi= $_POST['deskripsi'];
$_SESSION['nama_karakter']= $nama_karakter;
$_SESSION['deskripsi']= $deskripsi;
header("Location: detail_karakter.php?det=$row[id_karakter]");
?>