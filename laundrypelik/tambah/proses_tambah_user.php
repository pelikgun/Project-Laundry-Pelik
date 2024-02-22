<?php
include '../koneksi.php';

$id_outlet = $_POST['id_outlet'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

$pass_hash = password_hash($password, PASSWORD_DEFAULT);

$sql_username = "SELECT COUNT(*) FROM tb_user WHERE username = '$username'";
$query_username = mysqli_query($koneksi, $sql_username);
$check_username = mysqli_fetch_row($query_username);

if ($check_username['0'] != 0) {
    echo "<script>alert('Username has been used! | Please use another username.');window.location.href='../tambah_user.php'</script>";
} else {
    $sql = "INSERT INTO tb_user VALUES (NULL, '$nama', '$username', '$pass_hash', '$id_outlet', '$role')";
    $query = mysqli_query($koneksi, $sql);

    if (!$query) {
        echo "Tambah User Gagal : " . mysqli_error($koneksi);
    } else {
        header('Location:../index.php?page=User');
    }
}