<br>
<br>
<center>
    <input list="nama_member" type="text" name="" id="" >
    <datalist id="nama_member" >
        <?php
        include "../koneksi.php";
            $nama_member = mysqli_query($koneksi, "SELECT * FROM tb_member");
            while($data_member = mysqli_fetch_assoc($nama_member)){
        ?>
        <option value="<?=$data_member['nama']?>"></option>
        <?php
            }
        ?>
    </datalist>
</center>