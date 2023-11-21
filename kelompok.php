<?php 
include "koneksi.php";

if(isset($_POST["simpan"])){
    $id_kelompok = $_POST['id_kelompok'];
    $nama_kelompok = $_POST['kelompok']; 
    $insert = "INSERT INTO kelompok (id_kelompok, nama_kelompok) VALUES ('$id_kelompok', '$nama_kelompok')";
    $query = mysqli_query($conn, $insert);

    if($query){
        ?>
        <script>alert("Data Berhasil Ditambahkan!"); 
        document.location='index.php';</script>
        <?php
    }
}
?>

<form method="post" action="">
    <table>
        <tr>
            <td>
                <input type="radio" name="kelompok" value="Sith">Sith
                <input type="radio" name="kelompok" value="Jedi">Jedi
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="simpan" value="Simpan"></td>
        </tr>
    </table>
</form>
