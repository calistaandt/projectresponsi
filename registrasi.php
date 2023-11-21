<?php 
include "koneksi.php";

if(isset($_POST["registrasi"])){
    $id= $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2= $_POST['password2'];

    $sql= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengguna WHERE username= '$username' "));
    if($sql > 0){
        echo "Username Anda Telah Digunakan! Silakan Ganti Username Anda.";
    }else{
        if($password == $password2){
            $insert = "INSERT INTO pengguna(id, nama, username, password) VALUES ('$id', '$nama','$username', '$password')";
            $query = mysqli_query($conn, $insert);
            if($query){
                header("Location: login.php");
            }
        }else{
            echo "Periksa Data Kembali!";
        }
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <center>
    <h1>REGISTRASI</h1>
    <form name="registrasi" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <input type="text" name="nama" placeholder="Nama"></td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="username" placeholder="Username"></td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="password" placeholder="Password"></td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="password2" placeholder="Konfirmasi Password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="registrasi" value="Registrasi"></td>
            </tr>
        </table>
    </form>
    <p>Sudah memiliki akun? <a href="login.php">Login</a></p>
    </center>
</body>
</html>
