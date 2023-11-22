<?php
session_start();
include "koneksi.php";

// Assuming you have id_karakter set in the session somewhere in your application
$id_karakter = $_SESSION["id_karakter"];

// Check if 'det' parameter is set in the URL
if (isset($_GET['det'])) {
    $det_id_karakter = $_GET['det'];
    $_SESSION['selected_karakter_id'] = $det_id_karakter;

    // Retrieve character information from the database
    $sql = "SELECT * FROM karakter WHERE id_karakter = $det_id_karakter";
    $query = mysqli_query($conn, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $karacter = mysqli_fetch_array($query);


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
            window.location.href = "index.php";
        </script>
        <?php
    }
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
    <?php 
        echo "<h1>".$_SESSION['nama_karakter']."</h1>";
        echo "<img src='" . $karacter['gambar'] . "' width='100px'>";
        echo "<br><p> " . $_SESSION['deskripsi'] . "</p>";
    ?>
    <p>
        <a href="index.php">Kembali</a>
    </p>
    <p><a href="tes2.php?id_karakter=<?php echo $det_id_karakter; ?>">Edit</a></p>
    <p>
        <a href="detail_karakter.php?del=<?= $id_karakter; ?>">Hapus</a>
    </p>
</body>
</html>
