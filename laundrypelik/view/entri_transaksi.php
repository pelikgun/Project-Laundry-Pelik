<?php
if (@$_GET['idtransaksi']) {
    $idtransaksi = $_GET['idtransaksi'];
    // $_SESSION['idtransaksi'] = $idtransaksi;
} else if (@$_SESSION['idtransaksi']) {
    $idtransaksi = $_SESSION['idtransaksi'];
}

$data_transaksi = mysqli_fetch_row(mysqli_query($koneksi, "SELECT * FROM tb_transaksi INNER JOIN tb_member ON tb_transaksi.id_member = tb_member.id INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id INNER JOIN tb_user ON tb_transaksi.id_user = tb_user.id WHERE tb_transaksi.id = '$idtransaksi'"));

if (@$_POST['pilih_paket']) {
    $qty = $_POST['qty'];
    $nama_paket = $_POST['nama_paket'];
    $row_paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_paket WHERE nama_paket = '$nama_paket'"));
    $harga_paket = $row_paket['harga'];
    $total_harga = $qty * $harga_paket;
    $id_paket = $row_paket['id'];
    $keterangan = $_POST['keterangan'];
    mysqli_query($koneksi, "INSERT INTO tb_detail_transaksi VALUES(NULL, '$idtransaksi', '$id_paket', '$qty', '$keterangan', '$harga_paket', '$total_harga')");
    header("Location: " . $_SERVER['REQUEST_URI']);
}

if (@$_POST['bayar_sekarang']) {
    $tgl_bayar = date('Y-m-d H:i:s');
    mysqli_query($koneksi, "UPDATE tb_transaksi SET dibayar = 'dibayar', tgl_bayar = '$tgl_bayar' WHERE id = '$idtransaksi'");
    header("Location: " . $_SERVER['REQUEST_URI']);
}

if ($data_transaksi['11'] == 'belum_dibayar') {
    $pembayaran = 'UNPAID';
    $warna = '#695cfe';
} else {
    $pembayaran = 'PAYED';
    $warna = 'linear-gradient(to bottom right, #008000, #38b000)';
}

if (@$_POST['tombol_biaya_tambahan']) {
    $biaya_tambahan = $_POST['biaya_tambahan'];
    mysqli_query($koneksi, "UPDATE tb_transaksi SET biaya_tambahan = '$biaya_tambahan' WHERE id = '$idtransaksi'");
    header("Location: " . $_SERVER['REQUEST_URI']);
}
?>

<link rel="stylesheet" href="css/entri_transaksi.css">
<section class="home">
<div class="container">
    <div class="top">
        <div class="title-top">
            <i class="ri-file-list-3-line"></i>
            <span class="title">Detail</span>
        </div>
        <div class="box-bar-status">
            <?php
            if ($data_transaksi['10'] == 'baru') {
            ?>
                <div class="bar-status" style="width: 25%;">
                    <span style="left: 420px;">25%</span>
                </div>
            <?php
            } else if ($data_transaksi['10'] == 'proses') {
            ?>
                <div class="bar-status" style="width: 50%;">
                    <span style="left: 420px;">50%</span>
                </div>
            <?php
            } else if ($data_transaksi['10'] == 'selesai') {
            ?>
                <div class="bar-status" style="width: 75%;">
                    <span style="left: 420px;">75%</span>
                </div>
            <?php
            } else if ($data_transaksi['10'] == 'diambil') {
            ?>
                <div class="bar-status" style="width: 100%;">
                    <span style="left: 420px;">100%</span>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="box-detail-transaction">
        <div class="box-detail-container">
            <div class="box-detail">
                <div class="box-form" style="background: <?= $warna ?>;">
                    <div class="box-title">
                        <span class="title-form"><?= $pembayaran ?></span>
                    </div>
                    <table border="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>Invoice</td>
                                <td>:</td>
                                <td><?= $data_transaksi['2'] ?></td>
                            </tr>
                            <tr>
                                <td>Customer</td>
                                <td>:</td>
                                <td><?= $data_transaksi['14'] ?></td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>:</td>
                                <td><?= $data_transaksi['17'] ?></td>
                            </tr>
                            <tr>
                                <td>Customer Address</td>
                                <td>:</td>
                                <td><?= $data_transaksi['15'] ?></td>
                            </tr>
                            <tr>
                                <td>Employee</td>
                                <td>:</td>
                                <td><?= ucfirst($data_transaksi['23']) ?></td>
                            </tr>
                            <tr>
                                <td>Expired</td>
                                <td>:</td>
                                <td>
                                    <?php
                                    $data_transaksi['5'];
                                    $pecah_string_tanggal = explode(" ", $data_transaksi['5']);
                                    $pecah_string_hari = explode("-", $pecah_string_tanggal[0]);
                                    $pecah_string_jam = explode(":", $pecah_string_tanggal[1]);

                                    echo "Date : " . $pecah_string_hari[2] . "-" . $pecah_string_hari[1] . "-" . $pecah_string_hari[0];
                                    echo "<br>";
                                    echo "Time : " . $pecah_string_jam[0] . ":" . $pecah_string_jam[1];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>
                                    <select onchange="pilihStatus(this.options[this.selectedIndex].value, <?= $data_transaksi['0'] ?>)">
                                        <option value="baru" <?php if ($data_transaksi['10'] == 'baru') {
                                                                    echo "selected";
                                                                } ?>>
                                            New
                                        </option>
                                        <option value="proses" <?php if ($data_transaksi['10'] == 'proses') {
                                                                    echo "selected";
                                                                } ?>>
                                            Process
                                        </option>
                                        <option value="selesai" <?php if ($data_transaksi['10'] == 'selesai') {
                                                                    echo "selected";
                                                                } ?>>
                                            Done
                                        </option>
                                        <option value="diambil" <?php if ($data_transaksi['10'] == 'diambil') {
                                                                    echo "selected";
                                                                } ?>>
                                            Taked
                                        </option>
                                    </select>
                                    <script>
                                        function pilihStatus(value, id) {
                                            window.location.href = "edit/proses_edit_status.php?status=" + value + "&id=" + id;
                                        }
                                    </script>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                if ($data_transaksi['11'] == 'belum_dibayar') {
                ?>
                    <div class="box-add">
                        <form action="" method="post">
                            <div class="box-add-form">
                                <div class="box-input-add-form">
                                    <i class="ri-box-3-line"></i>
                                    <input type="text" name="nama_paket" list="nama_paket" id="" placeholder="Package" autocomplete="off" required>
                                    <datalist id="nama_paket">
                                        <?php
                                        $id_outlet = $data_transaksi['18'];
                                        $query_paket = mysqli_query($koneksi, "SELECT nama_paket FROM tb_paket WHERE id_outlet = '$id_outlet'");
                                        while ($data_paket = mysqli_fetch_assoc($query_paket)) {
                                        ?>
                                            <option value="<?= $data_paket['nama_paket'] ?>"></option>
                                        <?php
                                        }
                                        ?>
                                    </datalist>
                                </div>
                                <div class="box-input-add-form">
                                    <i class="ri-shopping-cart-2-line"></i>
                                    <input type="number" name="qty" id="" placeholder="QTY" autocomplete="off" required>
                                </div>
                                <div class="box-input-add-form">
                                    <i class="ri-file-list-3-line"></i>
                                    <input type="text" name="keterangan" id="" placeholder="Keterangan" autocomplete="off">
                                </div>
                                <div class="box-submit-form">
                                    <input type="submit" name="pilih_paket" value="Insert Package">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="box-status">
                <table>
                    <thead>
                        <tr>
                            <th>Package</th>
                            <th>Description</th>
                            <th>QTY</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result_detail = mysqli_query($koneksi, "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = '$idtransaksi'");
                        while ($detail = mysqli_fetch_assoc($result_detail)) {
                        ?>
                            <tr style="text-align: center;">
                                <td>
                                    <?php
                                    $idpaket = $detail['id_paket'];
                                    $paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_paket, jenis, harga FROM tb_paket WHERE id = '$idpaket'"));
                                    echo $paket['nama_paket'];
                                    echo "<br>";
                                    echo $paket['jenis'];
                                    ?>
                                </td>
                                <td><?= $detail['keterangan'] ?></td>
                                <td><?= $detail['qty'] ?></td>
                                <td>Rp.<?= number_format($detail['harga_paket'], 0, ',', '.') ?></td>
                                <td>
                                    <form action="delete/delete_paket_detail.php" method="get">
                                        <input type="text" name="id" id="" value="<?= $detail['id'] ?>" hidden>
                                        <?php
                                        if ($data_transaksi['11'] == 'belum_dibayar') {
                                        ?>
                                            <button>Rp.<?= number_format($detail['total_harga'], 0, ',', '.') ?></button>
                                        <?php
                                        } else {
                                        ?>
                                            <span style="color: #e5383b; font-weight: bold;">Rp.<?= number_format($detail['total_harga'], 0, ',', '.') ?></span>
                                        <?php
                                        }
                                        ?>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                        $grand_total = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id WHERE id_transaksi = '$idtransaksi'"));
                        if (!$grand_total['0'] == '0') {
                        ?>
                            <tr>
                                <td colspan="4" style="text-align: right; border-right: 1px solid #e6e5e5; font-weight: bold;">Pajak</td>
                                <td style="text-align: center; font-weight: bold;">
                                    <?php
                                    echo "0.75%";
                                    echo "<br>";
                                    $pajak = $grand_total['0'] * $data_transaksi['9'];
                                    echo "Rp." . number_format($pajak, 0, ',', '.');
                                    ?>
                                </td>
                            </tr>
                            <?php
                            if ($data_transaksi['7'] != 0) {
                            ?>
                                <tr>
                                    <td colspan="4" style="text-align: right; border-right: 1px solid #e6e5e5; font-weight: bold;">Biaya Tambahan</td>
                                    <td style="text-align: center; font-weight: bold;"><?= "Rp." . number_format($data_transaksi['7'], 0, ',', '.') ?></td>
                                </tr>
                            <?php
                            }
                            if ($data_transaksi['8'] != 0) {
                            ?>
                                <tr>
                                    <td colspan="4" style="text-align: right; border-right: 1px solid #e6e5e5; font-weight: bold;">Discount</td>
                                    <td style="text-align: center; font-weight: bold;">
                                        <?php
                                        echo "10%";
                                        echo "<br>";
                                        $diskon = $grand_total['0'] * $data_transaksi['8'];
                                        echo "Rp." . number_format($diskon, 0, ',', '.');
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            } else {
                                $diskon = 0;
                            }
                            ?>
                            <tr>
                                <td colspan="4" style="text-align: right; border-right: 1px solid #e6e5e5; font-weight: bold;">Total Keseluruhan</td>
                                <td style="text-align: center; font-weight: bold; color: #38b000;">
                                    <?php
                                    $total_keseluruhan = ($grand_total['0'] + $data_transaksi['7'] + $pajak) - $diskon;
                                    echo "Rp." . number_format($total_keseluruhan, 0, ',', '.');
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if (!$grand_total['0'] == '0') {
                ?>
                    <div class="box-biaya-tambahan-container">
                        <div class="box-biaya-tambahan">
                            <form action="" method="post">
                                <div class="box-input-biaya-tambahan" style="display: <?php if ($data_transaksi['11'] == 'dibayar') {
                                                                                            echo "none";
                                                                                        } ?>;">
                                    <i class="ri-btc-line"></i>
                                    <input type="number" name="biaya_tambahan" id="" placeholder="Biaya Tambahan" autocomplete="off" <?php if ($data_transaksi['11'] == 'dibayar') {
                                                                                                                                            echo "hidden";
                                                                                                                                        } ?>>
                                </div>
                                <div class="box-submit-biaya-tambahan">
                                    <input type="submit" value="Add" name="tombol_biaya_tambahan" <?php if ($data_transaksi['11'] == 'dibayar') {
                                                                                                        echo "hidden";
                                                                                                    } ?>>
                                </div>
                            </form>
                        </div>
                        <div class="box-button-pay">
                            <form action="" method="post">
                                <input type="submit" value="Pay Now" <?php if ($data_transaksi['11'] == 'dibayar') {
                                                                            echo "hidden";
                                                                        } ?> name="bayar_sekarang" onclick="return confirm('Really want to pay?')">
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
</section>