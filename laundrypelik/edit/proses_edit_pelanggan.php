<?php
include '../koneksi.php';

$id = $_GET['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis'];
$tlp = $_POST['tlp'];

$sql = "UPDATE tb_member SET nama = '$nama', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin', tlp = '$tlp'  WHERE id = '$id'";
$query = mysqli_query($koneksi, $sql);


if (!$query) {
    echo "Update Pelanggan Failed : " . mysqli_error($koneksi);
} else {
    header('Location:../index.php?page=Pelanggan');
}