<?php
session_start();
if (!@$_SESSION['username']) {
    echo "<script>alert('Login First!');window.location.href='login.php'</script>";
}
include_once 'koneksi.php';

$title = @$_GET['page'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <!-- <link rel="stylesheet" href="fontawesome/css/all.css"> -->
    <title>Dashboard</title>
</head>
<script src="https://unpkg.com/@phosphor-icons/web"></script>

<body>

</body>
</html>