<?php
session_start();
include "koneksi.php";

$id_karakter = $_SESSION["id_karakter"];
$id_kelompok = $_SESSION["id_kelompok"];
$nama_karakter = $_SESSION["nama_karakter"];
$deskripsi = $_SESSION["deskripsi"];

if (isset($_GET['det'])) {
    $id_karakter = $_GET['det'];
    $_SESSION['selected_karakter_id'] = $id_karakter;
    $sql = "SELECT * FROM karakter WHERE id_karakter = $id_karakter";
    $query = mysqli_query($conn, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $karacter = mysqli_fetch_array($query);
        echo "<h1>" . $karacter['nama_karakter'] . "</h1>";
        echo "<img src='" . $karacter['gambar'] . "' width='100px'>";
        echo "<br><p> " . $karacter['deskripsi'] . "</p>";
    }
}

if (isset($_GET["del"])) {
    $id_karakter = $_GET["del"];
    $row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karakter WHERE id_karakter = '$id_karakter'"));
    $filegambar = $row["gambar"];
    unlink($filegambar);
    $hapus = "DELETE FROM karakter WHERE id_karakter = '$id_karakter'";
    $query = mysqli_query($conn, $hapus);
    if ($query) {
        ?>
        <script>
            alert("Data Berhasil Dihapus");
            document.location= "index.php";
        </script>
        <?php
    }
}

$query = "SELECT gambar FROM karakter WHERE id_karakter = $id_karakter";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $gambar = $row['gambar'];
    if (empty($gambar)) {
        $gambar = 'images/profil.png';
    }
} else {
    $gambar = 'images/profil.png';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Karakter</title>
</head>
<body>
    <p>
        <a href="index.php">Kembali</a>
    </p>
    <p><a href="tes2.php?id_karakter=<?php echo $id_karakter; ?>">Edit</a></p>
    <p>
        <a href="detail_karakter.php?del=<?= $id_karakter; ?>">Hapus</a>
    </p>
</body>
</html>
