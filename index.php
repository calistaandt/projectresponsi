<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$sql = "SELECT id_karakter, nama_karakter, gambar FROM karakter ORDER BY id_karakter ASC"; 
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karakter</title>
</head>
<body>
    <h2>Data Karakter</h2>
    <table>
        <?php
        while ($row = mysqli_fetch_array($query)) {
            echo "
            <tr>
                <td><a href='detail_karakter.php?det=$row[id_karakter]'><img src='{$row['gambar']}' width='100px'></a></td>
                <td><a href='detail_karakter.php?det=$row[id_karakter]'>{$row['nama_karakter']}</td>
            </tr>
            ";
        }
        ?>
    </table>
    <a href="insert_karakter.php">Tambah Karakter</a><br>
    <a href="profil.php">Profil</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>
