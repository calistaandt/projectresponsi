<?php 
include "koneksi.php";

session_start();
$id = $_SESSION["id"];
$username = $_SESSION["username"];
$nama = $_SESSION["nama"];
$bio = $_SESSION["bio"];

$query = "SELECT foto FROM pengguna WHERE id = $id";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $foto = $row['foto'];
    if (empty($foto)) {
        $foto = 'images/profil.png';
    }
} else {
    $foto = 'images/profil.png';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
</head>
<body>
    <center>
    <h1>PROFIL</h1>

    <form name='formulir' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <table>
            <tr>
                <td></td>
                <td></td>
                <td>
                <img src='<?= $foto; ?>' alt="Profile Picture" width="100">
                </td>
            </tr>
            <tr>
                <td>ID</td>
                <td>:</td>
                <td>
                    <input type='text' name='id' value='<?= $id; ?>' readonly>
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>
                    <input type='text' name='nama' value='<?= $nama; ?>' readonly>
                </td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td>
                    <input type='text' name='username' value='<?= $username; ?>' readonly>
                </td>
            </tr>
            <tr>
                <td>Bio</td>
                <td>:</td>
                <td>
                    <textarea name='bio' cols='30' rows='10' readonly><?= $bio; ?></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <p>
                        <a href="update_profil.php?upd=<?php echo $_SESSION['id']; ?>">Edit Profil</a><br>
                        <a href="index.php">Kembali</a>
                    </p>
                </td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>
