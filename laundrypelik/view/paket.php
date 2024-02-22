<?php
include "koneksi.php";
?>
<link rel="stylesheet" href="css/outlet.css">
<section class="home">
<div class="text">Package</div>
    <div class="search-container">
        <form action="" method="post">
            <input type="text" name="keyword" placeholder="Search..." autofocus >
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <table cellpadding="10" cellspacing="0" align="center">
        <div class="tambah-data-btn">
            <a href="tambah/select_paket.php">Tambah Package</a>
        </div>

        <tr>
            <th>ID</th>
            <th>Nama Outlet</th>
            <th>Jenis</th>
            <th>Nama Paket</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php
        if (isset($_POST['search'])) {
            $keyword = htmlspecialchars($_POST['keyword']);
            $sql = "SELECT * FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id WHERE nama_paket LIKE '%$keyword%'";
        } else {
            $sql = "SELECT * FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id";
        }
        $no = 1;
        $query = mysqli_query($koneksi, $sql);

        while ($baris = mysqli_fetch_array($query)) {
            $isData = "PelikUser";
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $baris['nama'] ?></td>
                <td><?= $baris['jenis'] ?></td>
                <td><?= $baris['nama_paket'] ?></td>
                <td><?= $baris['harga'] ?></td>
                    <td class="actions">
                    <a href="edit/edit_paket.php?id=<?= $baris['0'] ?>" class="edit-btn">EDIT</a>
                    <a href="delete/delete_paket.php?id=<?= $baris['0'] ?>" class="edit-btn">DELETE</a>
                    </td>
            </tr>
            <?php
        }
        if (!isset($isData)) {
            ?>
    </table>
</section>
<?php
}
?>
