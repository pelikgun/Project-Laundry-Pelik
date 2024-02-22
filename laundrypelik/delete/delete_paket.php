<?php
include "../koneksi.php";

$id=$_GET['id'];

$baris = mysqli_query($koneksi, "DELETE FROM tb_paket WHERE id = '$id'");

if(!$baris){    
    echo "ERROR".mysqli_error($koneksi);
}else{
    header('location:../index.php?page=Paket'); //php
    exit;

    // echo "<script>location.href='view_obat.php';</script>"; //javascript
}
?>