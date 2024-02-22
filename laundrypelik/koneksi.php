<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database_name = "laundryfelix";
    $koneksi = mysqli_connect($host, $username, $password, $database_name);

    if(!$koneksi){
        die("Koneksi database gagal: ".mysqli_connect_error());
}