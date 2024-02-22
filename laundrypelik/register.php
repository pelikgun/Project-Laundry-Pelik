<?php
include_once "koneksi.php";
session_start();
?>
<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Registration Form in HTML & CSS | CodingLab </title>
    <link rel="stylesheet" href="css/login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="images/1.png" alt="">
            </div>
            <div class="back">
                <img class="backImg" src="images/1.png" alt="">
                <div class="text">
                    <span class="text-1">Cuci Cepat <br> Hemat Waktu</span>
                    <span class="text-2">Laundry Pelik</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Register</div>
                    <form action="proses_register_enkripsi.php" method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Enter your name" name="nama_lengkap" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="Enter your email" name="username" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Enter your password" name="password" required>
                            </div>
                            <div class="form-row">
                                <label for="id_outlet">Outlet</label>
                                <select name="id_outlet" id="id_outlet">
                                    <?php
                                        $query = mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                                        while($hasil = mysqli_fetch_assoc($query)){
                                    ?>
                                    <option value="<?=$hasil['id'];?>"><?=$hasil['nama'];?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <label for="leveluser">Level User</label>
                                <select name="leveluser" id="leveluser">
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="owner">Owner</option>
                                </select>
                            </div>

                            <!-- <a href="register.php">Not have account? Register first</a> -->
                            <div class="button input-box">
                                <input type="submit" value="Submit">
                            </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>