<?php 
include "koneksi.php";

session_start(); // Start the session

if (isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM pengguna WHERE username= '$username' AND password= '$password' ";
    $query = mysqli_query($conn, $sql);
    $hasil = mysqli_fetch_array($query);

    if ($hasil) {
        $_SESSION['id'] = $hasil['id'];
        $_SESSION['nama'] = $hasil['nama'];
        $_SESSION['username'] = $hasil['username'];
        $_SESSION['bio'] = $hasil['bio'];

        header("Location: index.php");
        exit();
    } else {
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
