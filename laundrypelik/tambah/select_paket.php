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
    <title>SELECT OUTLET</title>
    <link rel="stylesheet" href="../css/select_paket.css">
    <link href="https://fonts.googleapis.com/css?family=Viga&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-wrapper">
            <div class="header">SELECT OUTLET</div>
            <form method="post" action="tambah_paket.php" class="form-group">
                <div class="select-input">
                <i class="ri-store-3-fill"></i>
                    <select name="id_outlet" id="" required>
                        <option value="" selected hidden>Select Outlet First!</option>
                        <?php
                            $sql = "SELECT * FROM tb_outlet" ;
                            $query = mysqli_query($koneksi, $sql);
                            $check = mysqli_num_rows($query);

                            if ($check > 0) {
                                while ($result = mysqli_fetch_assoc($query)) {
                            ?>
                        <option value="<?= $result['id'] ?>"><?= $result['nama'] ?></option>
                        <?php
                                }
                            } else {
                                ?>
                        <option value="" disabled>All accounts have been registered!</option>
                        <?php
                            }
                            ?>
                    </select>
                </div>
                <div class="box-btn">
                    <a href="../index.php?page=Outlet" class="cancel-btn">CANCEL</a>
                    <input type="submit" value="SUBMIT" class="submit-input">
                </div>

            </form>
        </div>
    </div>
</body>

</html>
<?php
}
?>