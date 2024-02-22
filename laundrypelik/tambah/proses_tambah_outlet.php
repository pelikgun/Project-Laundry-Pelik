<?php
include '../koneksi.php';

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$tlp = $_POST['tlp'];

$sql = "INSERT INTO tb_outlet VALUES (NULL, '$nama', '$alamat', '$tlp')";
var_dump($sql);
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    echo "Add Outlet Failed : " . mysqli_error($koneksi);
} else {
    header('Location:../index.php?page=Outlet');
}