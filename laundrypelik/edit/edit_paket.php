<?php
session_start(); // Memulai session

$role = @$_SESSION['role'];

if (!@$_SESSION['username']) {
    echo "<script>alert('Login First!');window.location.href='login.php'</script>";
} else if ($role == 'kasir' || $role == 'owner') {
    echo "<script>alert('Locked Access! | Your role cannot access this page.');window.location.href='../'</script>";
} else {
    include_once '../koneksi.php';

    $id = $_GET['id'];

    $sqlpaket = "SELECT * FROM tb_paket WHERE id = '$id'";
    $querypaket = mysqli_query($koneksi, $sqlpaket);
    $data = mysqli_fetch_assoc($querypaket);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../assets/img/logo.svg" type="image/x-icon">
        <link rel="stylesheet" href="../css/edit_paket.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
        <title>EDIT Paket</title>
    </head>

    <body>
        <form action="proses_edit_paket.php?id=<?= $id ?>" method="post">
            <div class="container">
                <div class="box">
                    <span class="title">PACKAGE</span>
                    <div class="select-input">
                        <select name="id_outlet" id="">
                            <?php
                            $idoutlet = $data['id_outlet'];

                            $sqloutlet = "SELECT * FROM tb_outlet WHERE id = '$idoutlet'";
                            $queryoutlet = mysqli_query($koneksi, $sqloutlet);
                            $resultoutlet = mysqli_fetch_assoc($queryoutlet);
                            $check = mysqli_num_rows($queryoutlet);

                            $sql = "SELECT * FROM tb_outlet";
                            $query = mysqli_query($koneksi, $sql);
                            $check = mysqli_num_rows($query);

                            if ($resultoutlet['id_outlet'] == $result['id_outlet']) {
                            ?>
                                <option value="<?= $resultoutlet['id'] ?>" selected hidden><?= $resultoutlet['nama'] ?></option>
                                <?php
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
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-data">
                        <input type="text" name="nama_paket" id="" value="<?= $data['nama_paket'] ?>" placeholder="Package Name" autocomplete="off">
                    </div>
                    <div class="select-input">
                        <select name="jenis" id="">
                            <option value="<?= $data['jenis'] ?>" selected hidden><?= $data['jenis'] ?></option>
                            <option value="Kiloan">Kiloan</option>
                            <option value="Selimut">Selimut</option>
                            <option value="bed_cover">Bed Cover</option>
                            <option value="Kaos">Kaos</option>
                            <option value="Lain">Lain</option>
                        </select>
                    </div>
                    <div class="input-data">
                        <input type="text" name="harga" id="" value="<?= $data['harga'] ?>" placeholder="Price" autocomplete="off">
                    </div>
                    <div class="box-btn">
                        <a href="../index.php?page=Paket" class="cancel-btn">CANCEL</a>
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
