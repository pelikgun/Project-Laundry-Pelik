<?php
include '../koneksi.php';

$id = $_GET['id'];
$id_outlet = $_POST['id_outlet'];
$nama_paket = $_POST['nama_paket'];
$jenis = $_POST['jenis'];
$harga = $_POST['harga'];

$sql = "UPDATE tb_paket SET id_outlet = '$id_outlet', jenis = '$jenis', nama_paket = '$nama_paket', harga = '$harga' WHERE id = '$id'";
$query = mysqli_query($koneksi, $sql);


if (!$query) {
    echo "Update Package Failed : " . mysqli_error($koneksi);
} else {
    header('Location:../index.php?page=Paket');
}