<?php 
session_start();
$nama= $_POST["nama"];
$gambar= $_POST["gambar"];
$deskripsi= $_POST["deskripsi"];
$kelompok= $_POST["kelompok"];
$_SESSION["nama"]= $nama;
$_SESSION["gambar"]= $gambar;
$_SESSION["deskripsi"]= $deskripsi;
$_SESSION["kelompok"]= $kelompok;
header("Location: detail_karakter.php");
?>