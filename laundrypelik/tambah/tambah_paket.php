<?php
session_start();
$role = @$_SESSION['role'];

if (!@$_SESSION['username']) {
    echo "<script>alert('Login First!');window.location.href='login.php'</script>";
} else if ($role == 'kasir' || $role == 'owner') {
    echo "<script>alert('Locked Access! | Your role cannot access this page.');window.location.href='../'</script>";
} else {
    include_once '../koneksi.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../assets/img/logo.svg" type="image/x-icon">
        <link rel="stylesheet" href="../css/tambah_paket.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
        <title>Add Package</title>
    </head>

    <body>
        <form action="proses_tambah_paket.php" method="post">
            <div class="container">
                <div class="box">
                <input type="text" name="id_outlet" hidden id="" value="<?=$_POST['id_outlet']?>" autocomplete="off" required>
                    <span class="title">PACKAGE</span>
                    <div class="input-data">
                        <i class="ri-box-3-fill"></i>
                        <input type="text" name="nama_paket" id="" placeholder="Nama Paket" autocomplete="off" required>
                    </div>
                    <div class="select-input">
                        <i class="ri-settings-5-fill"></i>
                        <select name="jenis" id="" required>
                            <option value="" selected hidden>Select Type</option>
                            <option value="Kiloan">Kiloan</option>
                            <option value="Selimut">Selimut</option>
                            <option value="bed_cover">Bed Cover</option>
                            <option value="Kaos">Kaos</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="input-data">
                        <i class="ri-money-dollar-circle-fill"></i>
                        <input type="text" name="harga" id="harga" placeholder="Price" autocomplete="off" required>
                    </div>
                    <div class="box-btn">
                        <a href="../index.php?page=Paket" class="cancel-btn">CANCEL</a>
                        <button class="submit-btn">SUBMIT</button>
                    </div>
                </div>
            </div>
        </form>
        <script>
            // Hanya mengizinkan input angka pada elemen dengan id "tlp"
            document.getElementById('harga').addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        </script>
    </body>

    </html>
<?php
}
?>
