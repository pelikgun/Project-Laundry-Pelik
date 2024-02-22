<?php
include "koneksi.php";
?>
<link rel="stylesheet" href="css/outlet.css">
<section class="home">
<div class="text">Outlet</div>
    <div class="search-container">
        <form action="" method="post">
            <input type="text" name="keyword" placeholder="Search..." autofocus >
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <table cellpadding="10" cellspacing="0" align="center">
        <div class="tambah-data-btn">
            <a href="tambah/tambah_outlet.php">Tambah User</a>
        </div>

        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Telpon</th>
            <th>Aksi</th>
        </tr>
        <?php
        if (isset($_POST['search'])) {
            $keyword = htmlspecialchars($_POST['keyword']);
            $sql = "SELECT * FROM tb_outlet WHERE nama LIKE '%$keyword%'";
        } else {
            $sql = "SELECT * FROM tb_outlet";
        }
        $no = 1;
        $query = mysqli_query($koneksi, $sql);

        while ($baris = mysqli_fetch_array($query)) {
            $isData = "PelikUser";
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $baris['nama'] ?></td>
                <td><?= $baris['alamat'] ?></td>
                <td><?= $baris['tlp'] ?></td>
                <?php
                $id = $baris['id'];
                $hidesql = "SELECT * FROM (
                    SELECT id_outlet FROM tb_user WHERE id_outlet = '$id'
                    UNION
                    SELECT id_outlet FROM tb_paket WHERE id_outlet = '$id'
                    UNION
                    SELECT id_outlet FROM tb_transaksi WHERE id_outlet = '$id'
                    ) AS combined_data INNER JOIN tb_outlet ON combined_data.id_outlet = tb_outlet.id";
                $hidequery = mysqli_query($koneksi, $hidesql);
                $result = mysqli_num_rows($hidequery);

                if ($result == 0) {
                    ?>
                    <td>
                        <a href="edit/edit_outlet.php?id=<?= $baris['id'] ?>" class="edit-btn">EDIT</a>
                        <a href="delete/delete_outlet.php?id=<?= $baris['id'] ?>" class="delete-btn">HAPUS</a>
                    </td>
                    <?php
                } else {
                    ?>
                    <td class="actions">
                    <a href="edit/edit_outlet.php?id=<?= $baris['id'] ?>" class="edit-btn">EDIT</a>
                    </td>
            </tr>
            <?php
        }}
        ?>
    </table>
</section>

