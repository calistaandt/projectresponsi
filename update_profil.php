<?php
session_start();
include "koneksi.php";

$id = $_SESSION["id"];
$username = $_SESSION["username"];
$nama = $_SESSION["nama"];
$bio = $_SESSION["bio"];
$foto = $_SESSION["foto"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
    $bio = mysqli_real_escape_string($conn, $_POST["bio"]);

    if (isset($_FILES["foto"]["name"]) && !empty($_FILES["foto"]["name"])) {
        $upload = "images/" . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $upload);
    } else {
        $upload = $foto;
    }

    $update = "UPDATE pengguna SET nama=?, bio=?, foto=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "sssi", $nama, $bio, $upload, $id);
    $query = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($query) {
        $_SESSION["nama"] = $nama;
        $_SESSION["bio"] = $bio;
        $_SESSION["foto"] = $upload;
        ?>
        <script>
            alert('Data Berhasil Diubah!');
            document.location='profil.php';
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
                        <input type="text" name="id" value="<?php echo $id; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama" value="<?php echo $nama; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Bio</td>
                    <td>:</td>
                    <td>
                        <textarea name="bio" cols="30" rows="10"><?php echo $bio; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Foto Profil</td>
                    <td>:</td>
                    <td>
                        <input type="file" name="foto" accept="image/*">
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
                            <a href="profil.php">Batal</a>
                        </p>
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>
