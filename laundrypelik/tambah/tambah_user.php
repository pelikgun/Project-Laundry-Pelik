<?php
session_start();
$role = @$_SESSION['role'];

if (!@$_SESSION['username']) {
    echo "<script>alert('Login First!');window.location.href='login.php'</script>";
} else if ($role == 'kasir' || $role == 'owner') {
    echo "<script>alert('Locked Access! | Your role cannot access this page.');window.location.href='../../'</script>";
} else {
    include_once '../koneksi.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../assets/img/logo.svg" type="image/x-icon">
        <link rel="stylesheet" href="../css/tambah_user.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
        <title>Tambah User</title>
    </head>

    <body>
        <form action="proses_tambah_user.php" method="post">
            <div class="container">
                <div class="box">
                    <span class="title">User</span>
                    <div class="input-data">
                        <input type="text" name="nama" id="" placeholder="Name" autocomplete="off" required>
                    </div>
                    <div class="input-data">
                        <input type="text" name="username" id="" placeholder="Username" autocomplete="off" required>
                    </div>
                    <div class="input-data">
                        <input type="password" name="password" id="" placeholder="Password" autocomplete="off" required>
                    </div>
                    <div class="select-input">
                        <select name="id_outlet" id="" required>
                            <option value="" selected hidden>Select Outlet</option>
                            <?php
                            $sql = "SELECT * FROM tb_outlet WHERE id NOT IN (SELECT id_outlet FROM tb_user)";
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
                    <div class="select-input">
                        <select name="role" id="" required>
                            <option value="" selected hidden>Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    <div class="box-btn">
                        <a href="../../index.php?page=Employee" class="cancel-btn">CANCEL</a>
                        <button class="submit-btn">SUBMIT</button>
                    </div>
                </div>
            </div>
        </form>
    </body>

    </html>
<?php
}
?>