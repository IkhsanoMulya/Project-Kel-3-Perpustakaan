<?php
    include 'koneksi.php';

    $page = isset($_GET['page']) ? $_GET['page'] : 'list';

    switch($page){
        case 'list':

            $anggota = mysqli_query($db, "SELECT * FROM anggota");
?>

<body>
    <div class="container">
        <div class="row mb-2">
            <?php
                $pesan=isset($_GET['msg']) ? $_GET['msg'] : '';
                if ($pesan =='ok'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil disimpan!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <!--Menampilkan Data User dengan tabel-->
            <h2>Data Anggota</h2>
            <div class="col-md-4 mb-2">
                <a href="index.php?p=anggota&page=input" class="btn btn-success" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Tambah Anggota</a>
            </div>

        </div>
        <div class="card table-responsive">

            <table class="table table-bordered  table-hover ">
                <tr class="table-dark">
                <th>No</th>
                <th>Kode Anggota</th>
                <th>Nama Anggota</th>
                <th>Prodi</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>
            <?php $i = 1  ?>
            <?php foreach ($anggota as $row) : 
               
               ?>
            <tr>
                <td><?= $i; ?></td>
                <td> <?= $row['id_anggota'] ?></td>
                <td> <?= $row["nama_anggota"]; ?></td>
                <td> <?= $row["nama_prodi"]; ?></td>
                <td> <?= $row["alamat"]; ?></td>
                <td> <?= $row["no_telepon"]; ?></td>
                <td>
                    <a href="index.php?p=petugas&page=edit&id_edit=<?=$row["id_anggota"]; ?>" class="btn btn-warning">Edit</a>
                    <a href="proses_petugas.php?p=hapus_user&id_hapus=<?= $row["id_anggota"]; ?>"
                        onclick="return confirm('Yakin hapus data ?');" class="btn btn-danger"><span data-feather="trash-2" class="align-text-bottom"></span> Hapus</a>
                </td>
            </tr>
            <?php $i++  ?>
            <?php endforeach;  ?>
        </table>
    </div>
    </div>
    <?php
        break;
        case 'input' :
            
    ?>

<div class="container mt-3 ">
        <div class="col-md-4">
            <h2>Form Input Anggota</h2>
            <div class="row">
                <form action="proses_user.php?p=input_user" method="post">
                   
                    
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        <input type="reset" class="btn btn-secondary" name="reset" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
        break;
        case 'edit':
    ?>
    <div class="container mt-3 ">
        <div class="col-md-4">
            <?php
            include 'koneksi.php';

            $edit = mysqli_query($db, "SELECT * FROM user WHERE id_pengurus='$_GET[id_edit]'");
            $data = mysqli_fetch_array($edit);

            ?>
            <h2>Form Edit User</h2>
            <div class="row">
                <form action="proses_user.php?p=edit_user" method="post">
                <div class="mb-3">
                        <label class="form-label">ID Pengurus</label>
                        <input type="text" class="form-control" name="id_pengurus" value="<?= $data['id_pengurus'] ?>"readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username </label>
                        <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password">
                    </div>

                    <!-- <div class="mb-3">
                    <label class="form-label"> Level </label>
                        <select name="level" class="form-select">
                        <?php
                            $user=mysqli_query($db,"SELECT * FROM user");
                            while($data_user=mysqli_fetch_array($user)){
                            $terpilih=($data['id_pengurus']==$data_user['id_pengurus']) ? 'selected' : ''; //ternary
                        ?> 
                            <option value="<?= $data_user['level']?>"<?= $terpilih ?>> <?=$data_user['level']?> </option> 

                        <?php
                        }
                        ?>
                        </select>
                    </div> -->

                    <div class="mb-3">
                    <label class="form-label">Level</label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="level" value="admin" <?php if ($data['level']=='admin') echo 'checked'?>>
                            <label class="form-check-label">Admin</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="level" value="sekretaris" <?= ($data['level']=='sekretaris') ? 'checked' : ''?>>
                        <label class="form-check-label">Sekretaris</label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="level" value="bendahara" <?php if ($data['level']=='bendahara') echo 'checked'?>>
                            <label class="form-check-label">Bendahara</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="level" value="danus" <?= ($data['level']=='danus') ? 'checked' : ''?>>
                        <label class="form-check-label">Danus</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        <input type="reset" class="btn btn-secondary" name="reset" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    }
?>
</body>