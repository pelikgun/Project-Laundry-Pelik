<?php
include "../koneksi.php";

$id=$_GET['id'];

$hasil = mysqli_query($koneksi, "DELETE FROM tb_outlet WHERE id = '$id'");

if(!$hasil){    
    echo "ERROR".mysqli_error($koneksi);
}else{
    header('location:../index.php?page=Outlet'); //php
    exit;

    // echo "<script>location.href='view_obat.php';</script>"; //javascript
}
?>