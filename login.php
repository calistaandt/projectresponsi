<?php 
include "koneksi.php";

if(isset($_POST["login"])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from pengguna where username= '$username' and password= '$password' ";
    $query = mysqli_query($conn, $sql);
    if(mysqli_fetch_array($query) == true){
        header("Location: index.php");
    }else{
        ?>
        <script>
            alert("Email atau Password Salah! Periksa Data kembali.");
            document.location= "login.php";
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
    <title>Login</title>
</head>
<body>
    <center>
    <h1>LOGIN</h1>
    <form name="login" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Username <br> <input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password <br> <input type="password" name="password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="login" value="Login"></td>
            </tr>
        </table>
    </form>
    <p>Belum memiliki akun? <a href="registrasi.php">Registrasi</a></p>
    </center>
</body>
</html>
