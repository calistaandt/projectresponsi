<?php 
    include('koneksi.php');
    session_start();

    if(isset($_GET['id_karakter'])){
        $id = $_GET['id_karakter'];
        $sql = "SELECT * FROM karakter WHERE id_karakter = $id";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
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
    <h1>Edit Karakter</h1>
        <form name="formulir" method="post" action="proses_karakter.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nama Karakter</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama_karakter" value="<?= $row['nama_karakter']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td>
                        <textarea name="deskripsi" cols="30" rows="10"><?= $row['deskripsi']; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="submit" name="update" value="Update">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <p>
                            <a href="detail_karakter.php">Batal</a>
                        </p>
                    </td>
                </tr>
            </table>
        </form>
    </center>
    <form action="proses_karakter.php" method="post" enctype="multipart/form-data" id="karakter">
        <input type="file" id="uploadInput" accept=".jpg, .png" name="gambar">
        <button type="submit" name="tambah_karakter">SIMPAN</button>
        <input type="radio" id="jedi" name="id_kelompok" value="1" <?php if($row['id_kelompok'] == '1'){echo "checked";} ?>>
        <label for="jedi"><img src="/css/img/jedi.png" alt=""></label>
        <input type="radio" id="sith" name="id_kelompok" value="2" <?php if($row['id_kelompok'] == '2'){echo "checked";} ?>>
        <label for="sith"><img src="/css/img/sith.png" alt=""></label>
        <input type="text" id="nama" name="nama_karakter" value="<?= $row['nama_karakter']; ?>">
        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"><?= $row['deskripsi']; ?></textarea>
    </form>
</body>
</html>