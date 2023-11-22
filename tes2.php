<?php 
include "koneksi.php";
session_start();



$id_karakter= $_GET["id_karakter"];
$sql= "SELECT * FROM karakter WHERE id_karakter= $id_karakter";
$query= mysqli_query($conn, $sql);
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama_karakter= $_POST["nama_karakter"];
    $deskripsi= $_POST["deskripsi"];

    $update= "UPDATE karakter SET nama_karakter='$nama_karakter', deskripsi='$deskripsi' WHERE id_karakter='$id_karakter'";

    if ($conn->query($update) === TRUE) {
        header("Location: detail_karakter.php?id_karakter=" . $id_karakter);
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
if ($query->num_rows > 0) {
    $karakter = $query->fetch_assoc(); 
} else {
    header("Location: detail_karakter.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karakter</title>
</head>

<body>
    <center>
        <h1>Edit Karakter</h1>
        <form name="formulir" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nama Karakter</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama_karakter" value="<?php echo $karakter['nama_karakter']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td>
                        <textarea name="deskripsi" cols="30" rows="10"><?php echo $karakter['deskripsi']; ?></textarea>
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
</body>
</html>
