<?php 
$upd= $_GET['upd'];
$username= $_POST['username'];
$password= $_POST['password'];
$nama= $_POST['nama'];
$bio= $_POST['bio'];
$update= $_POST['upodate'];

if(isset($update)){
    $sql= "update penggguna set username= '$username, password='$password', nama='$nama', bio='$bio' where username='$upd' ";
    $query= mysqli_query($conn, $sql);
    if($query){
        ?>
        <script>
            alert("Data Berhasil Diubah");
            document.location="profil.php";
        </script>
        <?php
    }
}

$sql= "select * from pengguna where username= '$upd'";
$query= mysqli_query($conn, $sql);
$hasil= mysqli_fetch_array($query);
if($hasil['username'!=""]){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil</title>
    </head>
    <body>
        <center>
        <form name="editprofil" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <table>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $hasil['username']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td>
                        <input type="password" name="password" value="<?php echo $hasil['password']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="nama" value="<?php echo $hasil['nama']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Bio</td>
                    <td>:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $hasil['username']; ?>">
                    </td>
                </tr>
            </table>
        </form>
        </center>
    </body>
    </html>
    <?php
}
?>

