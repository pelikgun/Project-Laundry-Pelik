<?php
if (@$_POST['selanjutnya']) {
    $id_outlet = $_SESSION['id_outlet'];

    @$last_kode_invoice = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT kode_invoice FROM tb_transaksi ORDER BY id DESC LIMIT 1"));
    if (!$last_kode_invoice) {
        $kode_invoice = "INV/" . date("Y/m/d") . "/1";
    } else {
        $pecah_string = explode("/", $last_kode_invoice['kode_invoice']);
        $bulan_sebelum = $pecah_string[2];
        $bulan_sekarang = date('m');
        if ($bulan_sekarang != $bulan_sebelum) {
            $number_urut = 1;
        } else {
            $number_urut = $pecah_string[4];
            $number_urut++;
        }
        $kode_invoice = "INV/" . date("Y/m/d") . "/" . $number_urut;
    }

    $nama_member = $_POST['id_member'];
    $cari_id_member = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id FROM tb_member WHERE nama = '$nama_member'"));
    $id_member = $cari_id_member['id'];

    date_default_timezone_set('Asia/Makassar');
    $tanggal = date('Y-m-d H:i:s');

    $batas_waktu = date('Y-m-d H:i:s', strtotime($tanggal . ' +3 days'));

    $dibayar = "belum_dibayar";

    $biaya_tambahan = 0;

    $cari_transaksi = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_member FROM tb_transaksi WHERE id_member = '$id_member'"));
    if ($cari_transaksi % 3 == 0 && $cari_transaksi != 0) {
        $diskon = 0.1;
    } else {
        $diskon = 0;
    }

    $pajak = 0.0075;

    $status = "baru";

    $id_user = $_SESSION['id_user'];

    $hasil = mysqli_query($koneksi, "INSERT INTO tb_transaksi VALUES(NULL, '$id_outlet', '$kode_invoice', '$id_member', '$tanggal', '$batas_waktu', NULL, '$biaya_tambahan', '$diskon', '$pajak', '$status', '$dibayar', '$id_user')");
    $id_transaksi = mysqli_fetch_row(mysqli_query($koneksi, "SELECT LAST_INSERT_ID()"));
    $_SESSION['idtransaksi'] = $id_transaksi[0];
    if (!$hasil) {
        echo "Gagal menambahkan Transaksi : " . mysqli_error($koneksi);
    } else {
        header('Location:index.php?page=Entri_Transaksi');
        exit;
    }
}
?>
<link rel="stylesheet" href="css/transaksi.css">
<section class="home">
<div class="container">
    <div class="top">
        <div class="title-top">
            <i class="ri-money-dollar-circle-line"></i>
            <span class="title">Transaksi</span>
        </div>
    </div>
    <div class="box-transaction">
        <div class="box-card">
        <span class="title-transaction">Outlet <?= $_SESSION['nama_outlet'] ?></span>
            <form action="" method="POST">
                <div class="datalist-box">
                    <input type="text" list="name_member" name="id_member" id="" placeholder="Member Name" autocomplete="off" required>
                    <datalist id="name_member" required>
                        <?php
                        $sql = "SELECT * FROM tb_member";
                        $query = mysqli_query($koneksi, $sql);

                        while ($result = mysqli_fetch_assoc($query)) {
                        ?>
                            <option value="<?= $result['nama'] ?>"><?= $result['nama'] ?></option>
                        <?php
                        }
                        ?>
                    </datalist>
                </div>
                <?php
                if (@$_SESSION['idtransaksi']) {
                ?>
                    <div class="submit-box">
                        <input type="submit" value="SELANJUTNYA" name="selanjutnya">
                    </div>
                    <div class="submit-box">
                        <a href="index.php?page=Entri_Transaksi">Back To Last Transaction</a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="submit-box">
                        <input type="submit" value="SELANJUTNYA" name="selanjutnya">
                    </div>
                <?php
                }
                ?>

            </form>
        </div>
    </div>
</div>
</section>