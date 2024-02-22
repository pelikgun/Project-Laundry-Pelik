<?php
include '../koneksi.php';

$id = $_GET['id'];
$password = $_POST['password'];

$pass_hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE tb_user SET password = '$pass_hash' WHERE id = '$id'";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    echo "Update Password Failed : " . mysqli_error($koneksi);
} else {
    header('Location:../index.php?page=User');
}