<?php
session_start();
$role = @$_SESSION['role'];

if (!@$_SESSION['username']) {
    echo "<script>alert('Login First!');window.location.href='login.php'</script>";
} else if ($role == 'kasir' || $role == 'owner') {
    echo "<script>alert('Locked Access! | Your role cannot access this page.');window.location.href='../'</script>";
} else {
    include_once '../koneksi.php';
    // Rest of your code here
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Outlet</title>
    <link rel="stylesheet" href="../css/tambah_outlet.css">
    <link href="https://fonts.googleapis.com/css?family=Viga&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-wrapper">
            <div class="header">TAMBAH OUTLET</div>
            <form method="post" action="proses_tambah_outlet.php" class="form-group">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" required autocomplete="off" >
                </div>
                <div>
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" required autocomplete="off" >
                </div>
                <div>
                    <label for="alamat">Telpon</label>
                    <input type="text" name="tlp" id="tlp" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required autocomplete="off" >
                </div>
                <div class="box-btn">
                    <a href="../index.php?page=Outlet" class="cancel-btn">CANCEL</a>
                    <button class="submit-btn">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Hanya mengizinkan input angka pada elemen dengan id "tlp"
        document.getElementById('tlp').addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>

</html>
<?php
}
?>