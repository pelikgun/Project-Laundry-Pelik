<?php
$role = @$_SESSION['role'];
$username = @$_SESSION['username'];

if ($role == 'kasir' || $role == 'owner') {
    echo "<script>alert('Locked Access! | Your role cannot access this page.');window.location.href='../peliklaundry'</script>";
}
?>
<link rel="stylesheet" href="css/outlet.css">
<section class="home" >
<div class="text">USER</div>
<div class="container">
    <div class="top">
        <div class="title-top">
            <i class="ri-group-line"></i>
        </div>
        <div class="search-container">
        <form action="" method="post">
            <input type="text" name="keyword" placeholder="Search..." autofocus>
            <button type="submit" name="search">Search</button>
        </form>
        </div>
    </div>
    <div class="box-table">
        <div class="table">
        <div class="tambah-data-btn">
            <a href="tambah/tambah_user.php">Tambah User</a>
        </div>
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAME</th>
                        <th>OUTLET</th>
                        <th>USERNAME</th>
                        <th>PASSWORD</th>
                        <th>ROLE</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['search'])) {
                        $keyword = htmlspecialchars($_POST['keyword']);
                        $sql = "SELECT * FROM tb_user INNER JOIN tb_outlet ON tb_user.id_outlet = tb_outlet.id WHERE username LIKE '%$keyword%'";
                    } else {
                        $sql = "SELECT * FROM tb_user INNER JOIN tb_outlet ON tb_user.id_outlet = tb_outlet.id";
                    }

                    $no = 1;
                    $query = mysqli_query($koneksi, $sql);

                    while ($data = mysqli_fetch_array($query)) {
                        $isData = "PelikLaundry";
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['1'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['username'] ?></td>
                            <td><a href="edit/edit_user.php?id=<?= $data['0'] ?>" class="edit">EDIT</a></td>
                            <td><?= ucfirst($data['role']) ?></td>
                            <?php
                            if ($data['username'] == $username) {
                            ?>
                                <td><a class="disable"></i>DELETE</a></td>
                            <?php
                            } else {
                            ?>
                                <td><a href="delete/delete_user.php?id=<?= $data['0'] ?>" class="delete"></i>DELETE</a></td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    if (!isset($isData)) {
                    ?>
                        <tr>
                            <td colspan="10">Not Found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>