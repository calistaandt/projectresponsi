<?php 
include "koneksi.php";

if(isset($_POST["insert"])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $gambar = $_FILES['gambar']['name'];

    $kelompok = isset($_POST['kelompok']) ? $_POST['kelompok'] : '';

    if($gambar != ""){
        $upload = "images/" . $gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $upload);
    }

    $deskripsi = $_POST['deskripsi'];

    $insert = "INSERT INTO karakter (id, nama, gambar, deskripsi, kelompok) VALUES ('$id', '$nama', '$upload', '$deskripsi', '$kelompok')";
    $query = mysqli_query($conn, $insert);

    if($query){
        ?>
        <script>alert("Data Berhasil Ditambahkan!"); 
        document.location='index.php';</script>
        <?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karakter</title>
</head>
<body>
    <center>
    <h1>Tambah Karakter</h1>
    <form method="post" name="inschar" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <input type="radio" name="kelompok" value="Sith">Sith
                    <input type="radio" name="kelompok" value="Jedi">Jedi
                    <input type="radio" name="kelompok" value="Mandalorians">Mandalorians
                    <input type="radio" name="kelompok" value="Resistance">Resistance
                    <input type="radio" name="kelompok" value="Bounty Hunters">Bounty Hunters
                    <input type="radio" name="kelompok" value="Wookiees">Wookiees
                </td>
            </tr>
            <tr>
                <td>NAMA CHARACTER <br> <input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>DESKRIPSI <br> <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td>GAMBAR <br> <input type="file" name="gambar"></td>
            </tr>
            <tr>
                <td><input type="submit" name="insert" value="Simpan"></td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>
