<?php
session_start();
include "koneksi.php";

$id_karakter = $_GET['upd'];
$_SESSION['selected_karakter_id'] = $id_karakter;

$sql = "SELECT * FROM karakter WHERE id_karakter = $id_karakter";
$query = mysqli_query($conn, $sql);

if ($query && mysqli_num_rows($query) > 0) {
    $karakter = mysqli_fetch_array($query);
    $nama_karakter = $karakter['nama_karakter'];
    $deskripsi = $karakter['deskripsi'];
    $gambar = $karakter['gambar'];
} 

if (isset($_POST['update'])) {
    $nama_karakter = mysqli_real_escape_string($conn, $_POST["nama_karakter"]);
    $deskripsi = mysqli_real_escape_string($conn, $_POST["deskripsi"]);

    // Check for file upload and move it
    if (isset($_FILES["gambar"]["name"]) && !empty($_FILES["gambar"]["name"])) {
        $upload = "images/" . basename($_FILES["gambar"]["name"]);
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $upload)) {
            // File successfully uploaded and moved
            echo "File successfully uploaded and moved to $upload";
        } else {
            // File upload failed
            echo "File upload failed.";
        }
    } else {
        $upload = $gambar;
    }

    // Update the database
    $update = "UPDATE karakter SET nama_karakter=?, deskripsi=?, gambar=? WHERE id_karakter=?";
    $stmt = mysqli_prepare($conn, $update);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssi", $nama_karakter, $deskripsi, $upload, $id_karakter);
        $query_success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($query_success) {
            // Update session variables
            $_SESSION["nama_karakter"] = $nama_karakter;
            $_SESSION["deskripsi"] = $deskripsi;
            $_SESSION["gambar"] = $upload;
            
            // Redirect after successful update
            ?>
            <script>
                alert('Data Berhasil Diubah!');
                document.location='detail_karakter.php';
            </script>
            <?php
        } else {
            // Query execution failed
            echo "Query execution failed: " . mysqli_error($conn);
        }
    } else {
        // Statement preparation failed
        echo "Statement preparation failed: " . mysqli_error($conn);
    }
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
                    <td>ID</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="id_karakter" value="<?= $id_karakter; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Nama Karakter</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama_karakter" value="<?= $nama_karakter; ?>">
                    </td>
                </tr>
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
                            <a href="detail_karakter.php">Batal</a>
                        </p>
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>
