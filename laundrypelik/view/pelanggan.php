<?php
include "koneksi.php";
?>
<link rel="stylesheet" href="css/outlet.css">
<section class="home">
    <div class="text">Pelanggan</div>
    <div class="search-container">
        <form action="" method="post">
            <input type="text" name="keyword" placeholder="Search..." autofocus>
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <table cellpadding="10" cellspacing="0" align="center">
        <div class="tambah-data-btn">
            <a href="tambah/tambah_pelanggan.php">Tambah Pelanggan</a>
        </div>

        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Telpon</th>
            <th>Aksi</th>
        </tr>
        <?php
        if (isset($_POST['search'])) {
            $keyword = htmlspecialchars($_POST['keyword']);
            $sql = "SELECT * FROM tb_member WHERE nama LIKE '%$keyword%'";
        } else {
            $sql = "SELECT * FROM tb_member";
        }
        $no = 1;
        $query = mysqli_query($koneksi, $sql);

        while ($baris = mysqli_fetch_array($query)) {
            $isData = "PelikUser";
            ?>
        <tr>
            <td>
                <?= $no++ ?>
            </td>
            <td>
                <?= $baris['nama'] ?>
            </td>
            <td>
                <?= $baris['alamat'] ?>
            </td>
            <td>
                <?php
                    if ($baris['jenis_kelamin'] == "L") {
                        echo "Laki-Laki";
                    } else {
                        echo "Perempuan";
                    }
                    ?>
            </td>
            <td>
                <?= $baris['tlp'] ?>
            </td>
            <td class="actions">
                <a href="edit/edit_pelanggan.php?id=<?= $baris['0'] ?>" class="edit"><i
                        class="ri-edit-box-line"></i>EDIT</a>
                <a href="delete/delete_pelanggan.php?id=<?= $baris['0'] ?>" class="delete"><i
                        class="ri-delete-bin-line"></i>DELETE</a>
            </td>
        <?php
        }
        ?>
    </table>
</section>