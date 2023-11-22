<?php 
session_start();
include "koneksi.php";

$upd = $_GET['upd'];
$id_karakter = $_SESSION['id_karakter'];
$nama_karakter = $_SESSION['nama_karakter']; 
$deskripsi = $_SESSION['deskripsi'];
$gambar = $_SESSION['gambar'];
$id_kelompok = $_SESSION['id_kelompok'];
$update = $_POST['update'];

if (isset($update)) {
    $sql = "UPDATE karakter SET nama_karakter='$nama_karakter', gambar='$gambar', deskripsi='$deskripsi', id_kelompok='$id_kelompok' WHERE id='$upd'";
    $query = mysqli_query($conn, $sql);
    
    if ($query) {
        ?>
        <script>
            alert('Data Berhasil Diubah!'); 
            document.location='detail_karakter.php?det=<?php echo $upd; ?>';
        </script>
        <?php
    }
}

$sql = "SELECT * FROM karakter WHERE id='$upd'";
$query = mysqli_query($conn, $sql);
$hasil = mysqli_fetch_array($query);

if ($hasil['id'] != "") {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Karakter</title>
    </head>
    <body>
        <center>
        <form action="<?php echo $_SERVER["PHP_SELF"] . "?upd=" . $upd; ?>" name="updchar" method="post">
        <!-- Use the correct input name -->
        <table>
            <tr>
                <td>Nama Karakter</td>
                <td>:</td>
                <td>
                    <input type='text' name='nama_karakter' value='<?php echo $hasil['nama_karakter']; ?>'>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type='submit' name='update' value='Update Data'>
                    <br><p>
                        <a href="data_pegawai.php">Batal</a>
                    </p>
                </td>
            </tr>
        </table>
        </form>
        </center>
    </body>
    </html>
    <?php
}
?>
