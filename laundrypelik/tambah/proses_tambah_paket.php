<?php
include '../koneksi.php';

$id_outlet = $_POST['id_outlet'];
$nama_paket = $_POST['nama_paket'];
$jenis = $_POST['jenis'];
$harga = $_POST['harga'];

$sql = "INSERT INTO tb_paket VALUES (NULL, '$id_outlet', '$jenis', '$nama_paket', '$harga')";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    echo "Add Package Failed : " . mysqli_error($koneksi);
} else {
    header('Location:../index.php?page=Paket');
}