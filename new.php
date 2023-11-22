<?php
session_start();
include "koneksi.php";

$id_karakter = $_SESSION["id_karakter"];
$id_kelompok = $_SESSION["id_kelompok"];
$nama_karakter = $_SESSION["nama_karakter"];
$deskripsi = $_SESSION["deskripsi"];
$gambar = $_SESSION["gambar"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_karakter = mysqli_real_escape_string($conn, $_POST["nama_karakter"]);
    $deskripsi = mysqli_real_escape_string($conn, $_POST["deskripsi"]);

    if (isset($_FILES["gambar"]["name"]) && !empty($_FILES["gambar"]["name"])) {
        $upload = "images/" . basename($_FILES["gambar"]["name"]);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $upload);
    } else {
        $upload = $gambar;
    }

    $update = "UPDATE karakter SET nama_karakter=?, deskripsi=?, gambar=? WHERE id_karakter=?";
    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "sssi", $nama_karakter, $deskripsi, $upload, $id_karakter);
    $query = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($query) {
        $_SESSION["nama_karakter"] = $nama_karakter;
        $_SESSION["deskripsi"] = $deskripsi;
        $_SESSION["gambar"] = $upload;
        ?>
        <script>
            alert('Data Berhasil Diubah!');
            document.location='detail_karakter.php?det=<?php echo $id_karakter; ?>';
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
    <title>Edit Profil</title>
</head>

<body>
    <center>
        <h1>Edit Profil</h1>
        <form name="formulir" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>ID</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="id_karakter" value="<?php echo $id_karakter; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Nama Karakter</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama_karakter" value="<?php echo $nama_karakter; ?>">
                    </td>
                </tr>
                <!-- Add other relevant fields for updating a character profile -->
                <tr>
                    <td>deskripsi</td>
                    <td>:</td>
                    <td>
                        <textarea name="deskripsi" cols="30" rows="10"><?php echo $deskripsi; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>gambar Profil</td>
                    <td>:</td>
                    <td>
                        <input type="file" name="gambar" accept="image/*">
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
                            <a href="detail_karakter.php?det=<?php echo $id_karakter; ?>">Batal</a>
                        </p>
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>
