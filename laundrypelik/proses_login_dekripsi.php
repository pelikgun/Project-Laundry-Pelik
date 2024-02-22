<?php
session_start();
$user = $_POST['username'];
$password_login = $_POST['password'];


include "koneksi.php";
$login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$user'");
$query_lvluser = mysqli_fetch_assoc($login);
$id_outlet_dari_tb_user = $query_lvluser['id_outlet'];
$outlet_query = mysqli_query($koneksi, "SELECT nama FROM tb_outlet WHERE id = '$id_outlet_dari_tb_user'");
$query_outlet = mysqli_fetch_assoc($outlet_query);
$nama_outlet = $query_outlet['nama'];

$cek = password_verify($password_login, $query_lvluser['password']); //dekripsi
// $cek = mysqli_num_rows($login);

if($cek > 0){
    //setcookie('username', $user, time() + (60 * 60 * 24 * 5), '/');
    //setcookie('leveluser', $query_lvluser['leveluser'], time() + (60 * 60 * 24 * 5), '/');
    $_SESSION['username'] = $user;
    $_SESSION['role'] = $query_lvluser['role'];
    $_SESSION['id_user'] = $query_lvluser['id'];
    $_SESSION['id_outlet'] = $query_lvluser['id_outlet'];
    $_SESSION['nama_outlet'] = $query_outlet['nama'];
    // header('dashboard.php');
    echo "berhasil login";
    header('Location:index.php');
}else{
    echo"<script>alert('gagal login password anda salah');location.href='login.php'</script>";
}

?>