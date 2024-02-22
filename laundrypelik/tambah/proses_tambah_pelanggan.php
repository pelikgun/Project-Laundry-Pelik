<?php
include '../koneksi.php';

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis = $_POST['jenis'];
$tlp = $_POST['tlp'];

$sql = "INSERT INTO tb_member VALUES (NULL, '$nama', '$alamat', '$jenis', '$tlp')";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    echo "Add Pelanggan Failed : " . mysqli_error($koneksi);
} else {
    header('Location:../index.php?page=Pelanggan');
}