<?php 
include "koneksi.php";

if(isset($_POST["registrasi"])){
    $id= $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2= $_POST['password2'];

    $sql= mysqli_num_rows(mysqli_query($conn, "select * from pengguna where username= '$username' "));
    if($sql > 0){
        ?>
        <script>
            alert("Username Anda Telah Digunakan! Silakan Ganti Username Anda.")
        </script>
        <?php
    }else{
        if($password == $password2){
            $insert = "insert into pengguna(id, nama, username, password) values ('$id', '$nama','$username', '$password')";
            $query = mysqli_query($conn, $insert);
            if($query){
                ?>
                <script>
                    alert("Registrasi Berhasil!"); 
                    document.location='login.php';
                </script>
                <?php
            }
        }else{
            ?>
            <script>
                alert("Periksa Data Kembali!");
            </script>
            <?php
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
    <form name="registrasi" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data" onsubmit="return cek()">
        <table>
            <tr>
                <td>
                    <input type="text" name="nama" id="fieldnama" placeholder="Nama"></td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="username" id="fielduser" placeholder="Username"></td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="password" id="fieldpass1" placeholder="Password"></td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="password2" id="fieldpass2" placeholder="Konfirmasi Password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="registrasi" value="Registrasi"></td>
            </tr>
        </table>
    </form>
    <p>Sudah memiliki akun? <a href="login.php">Login</a></p>
    </center>
    <script>
        function cek() {
            const fieldnama = document.getElementById("fieldnama");
            if (fieldnama.value == "") {
                alert("Nama Harus Diisi!");
                fieldnama.focus();
                return false;
            }

            const fielduser = document.getElementById("fielduser");
            if (fielduser.value == "") {
                alert("Username Harus Diisi!");
                fielduser.focus();
                return false;
            }

            const fieldpass1 = document.getElementById("fieldpass1");
            if (fieldpass1.value == "") {
                alert("Password Harus Diisi!");
                fieldpass1.focus();
                return false;
            }

            const fieldpass2 = document.getElementById("fieldpass2");
            if (fieldpass2.value == "") {
                alert("Konfirmasi Password Harus Diisi!");
                fieldpass2.focus();
                return false;
            }
        }
    </script>
</body>
</html>
