<?php 
include "koneksi.php";

$upd= $_GET['upd'];
$nama= $_POST['nama'];
$gambar= $_POST['gambar'];
$kelompok= $_POST['kelompok'];
$deskripsi= $_POST['deskripsi'];
$update= $_POST['update'];

if(isset($update)){
    $Sql= "update karakter set nama= '$nama', gambar='$gambar', kelompok= '$kelompok', deskripsi= '$deskripsi' ";
    $query= mysqli_query($conn, $sql);
    if($query){
        ?>
		<script>alert('Data Berhasil Diubah!'); 
        document.location='detail_karakter.php';</script>
		<?php
    }
}

$sql= "select * from karakter where id= '$upd' ";
$query= mysqli_query($conn, $sql);
$hasil= mysqli_fetch_array($query);
if($hasil['id']!= ""){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Karakter</title>
    </head>
    <body>
        <center>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="updchar" method="post">
            <table>
                <tr>
                    <td>
                        
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