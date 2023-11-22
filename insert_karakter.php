<?php 
include "koneksi.php";

if(isset($_POST["insert"])){
    $id_karakter = $_POST['id_karakter'];
    $id_kelompok = $_POST['id_kelompok'];
    $nama_karakter = $_POST['nama_karakter'];
    $gambar = $_FILES['gambar']['name'];
    
    if($gambar != ""){
        $upload = "images/" . $gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $upload);
    }

    $deskripsi = $_POST['deskripsi'];

    $insert = "INSERT INTO karakter (id_karakter, nama_karakter, gambar, deskripsi, id_kelompok) VALUES ('$id_karakter', '$nama_karakter', '$upload', '$deskripsi', '$id_kelompok')";
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
                    <?php 
                        $kelompok_query = "SELECT * FROM kelompok ORDER BY id_kelompok";
                        $kelompok_result = mysqli_query($conn, $kelompok_query);

                        while($row = mysqli_fetch_array($kelompok_result)){
                            echo "<input type='radio' name='id_kelompok' value='$row[id_kelompok]'><img src='images/jedi.png' width='50px'> $row[id_kelompok] - $row[nama_kelompok] ";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>NAMA CHARACTER <br> <input type="text" name="nama_karakter"></td>
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
