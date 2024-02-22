<?php
session_start();

$role = @$_SESSION['role'];

if (!@$_SESSION['username']) {
    echo "<script>alert('Login First!');window.location.href='login.php'</script>";
} else if ($role == 'kasir' || $role == 'owner') {
    echo "<script>alert('Locked Access! | Your role cannot access this page.');window.location.href='../../'</script>";
} else {
    include_once '../koneksi.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_member WHERE id = '$id'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/img/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../css/edit_pelanggan.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
    <title>Edit Pelanggan</title>
</head>

<body>
    <form action="proses_edit_pelanggan.php?id=<?= $id ?>" method="post">
        <div class="container">
            <div class="box">
                <span class="title">PELANGGAN</span>
                <div class="input-data">
                    <!-- <i class="ri-store-3-fill"></i> -->
                    <input type="text" name="nama" id="" placeholder="Outlet Name" value="<?= $data['nama']; ?>" autocomplete="off" required>
                </div>
                <div class="input-data">
                    <!-- <i class="ri-map-pin-fill"></i> -->
                    <input type="text" name="alamat" id="" placeholder="Address" value="<?= $data['alamat']; ?>" autocomplete="off" required>
                </div>
                <div class="select-input">
                        <!-- <i class="ri-user-fill"></i> -->
                        <select name="jenis" id="" required>
                            <option value="<?= $data['jenis_kelamin'] ?>" selected hidden>
                                <?php
                                if ($data['jenis_kelamin'] == 'L') {
                                    echo "Laki-Laki";
                                } else {
                                    echo "Perempuan";
                                }
                                ?>
                            </option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                </div>
                <div class="input-data">
                    <!-- <i class="ri-phone-fill"></i> -->
                    <input type="text" name="tlp" id="tlp" placeholder="Phone Number" value="<?= $data['tlp']; ?>" autocomplete="off" required>
                </div>
                <div class="box-btn">
                    <a href="../index.php?page=Pelanggan" class="cancel-btn">CANCEL</a>
                    <button class="submit-btn">SUBMIT</button>
                </div>
            </div>
        </div>

        <!-- <script>
            // Hanya mengizinkan input angka pada elemen dengan id "tlp"
            document.getElementById('tlp').addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        </script> -->
    </form>
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