<?php
include "koneksi.php"; // Adjust according to your koneksi.php file

$sql = "select nama, gambar FROM karakter ORDER BY id ASC"; // Change 'foto' to 'gambar' based on your table structure
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
                <td><img src='{$row['gambar']}' width='100px'></td>
                <td>{$row['nama']}</td>
            </tr>
            ";
        }
        ?>
    </table>
    <a href="insert_karakter.php">Tambah Karakter</a>
</body>
</html>
