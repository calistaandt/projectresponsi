<?php 
if(isset($_POST["edit_karakter"])){
    $id = $_GET["id_karakter"];
    $nama_karakter = $_POST['nama_karakter'];
    $id_kelompok = $_POST['id_kelompok'];
    $deskripsi = $_POST["deskripsi"];
    $gambar = $_FILES['gambar']['name'];

    $querryDel = "SELECT * FROM karakter WHERE id_karakter = '$id';";
    $sqlDel = mysqli_query($conn, $querryDel);
    $result = mysqli_fetch_assoc($sqlDel);

    $dir = "css/img/";
    $tmp_file = $_FILES['gambar']['tmp_name'];

    if($_FILES['gambar']['name'] == ""){
        $gambar = $result['gambar'];
    }else{
        $gambar = $_FILES['gambar']['name'];
        unlink("css/img/".$result['gambar']);
        move_uploaded_file($tmp_file, $dir.$gambar);
    }

    $sql = "UPDATE karakter SET nama_karakter='$nama_karakter', id_kelompok='$id_kelompok', deskripsi='$deskripsi', gambar='$gambar' WHERE id_karakter ='$id';";
    $query = mysqli_query($conn, $sql);

    if($query){
        header("location: index.php");
    }else{
        echo $querry;
    }
}
?>
