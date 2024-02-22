<?php
include '../koneksi.php';

$id = $_GET['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$tlp = $_POST['tlp'];

$sql = "UPDATE tb_outlet SET nama = '$nama', alamat = '$alamat', tlp = '$tlp' WHERE id = '$id'";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    echo "Update Outlet Failed : " . mysqli_error($koneksi);
} else {
    header('Location:../index.php?page=Outlet');
}