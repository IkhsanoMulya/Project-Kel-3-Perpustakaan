<?php include 'koneksi.php'; ?>

<?php $page = isset($_GET['page']) ? $_GET['page'] : 'list';

    switch($page){
        case 'list':
?>

<?php
    $rak = mysqli_query($db, "SELECT * FROM rak");
?>

<body>
    <div class="container">
        <div class="row mb-2">
        <?php
                $pesan=isset($_GET['msg']) ? $_GET['msg'] : '';
                if ($pesan =='yes'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil disimpan!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }elseif ($pesan =='no') {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Gagal disimpan!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }elseif ($pesan =='del') {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil dihapus!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }elseif ($pesan =='delno') {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Gagal dihapus!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }elseif ($pesan =='aktif') {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Masih Ada Buku di Rak Ini!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>
            <h2>Data Rak</h2>
            <div class="col-md-4">
                <a href="index.php?p=rak&page=input" class="btn btn-success mb-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Tambah Rak</a>
            </div>
        <table class="table table-bordered">
            <tr class="table-secondary">
                <th>No</th>
                <th>Nama Rak</th>
                <!-- <?php
                    if ($_SESSION['level']=='admin'){
                ?> -->
                <th>Aksi</th>
                <!-- <?php
                    }
                ?> -->
            </tr>
            <?php $i = 1  ?>
            <?php foreach ($rak as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td> <?= $row["nama_rak"]; ?></td>
                <?php
                    if ($_SESSION['level']=='admin'){
                ?>
                <td>
                    <a href="index.php?p=rak&page=edit&id_edit=<?=$row["id_rak"]; ?>" class="btn btn-warning"><span data-feather="edit"></a>
                    <a href="proses_rak.php?aksi=hapus_rak&id_hapus=<?= $row["id_rak"]; ?>"
                        onclick="return confirm('Yakin hapus data ?');" class="btn btn-danger"><span data-feather="trash-2"></span></a>
                </td>
                <?php
                    }
                ?>
            </tr>
            <?php $i++  ?>
            <?php endforeach;  ?>
        </table>
    </div>
    
    <?php
        break;
        case 'input' :
    
    ?>
    <div class="container mt-3 ">
        <div class="col-md-4">
            <h2>Form Input rak</h2>
            <div class="row">
                <form action="proses_rak.php?aksi=input_rak" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Rak </label>
                        <input type="text" class="form-control" name="nama" required>
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
        break;
        case 'edit':
    ?>
    <div class="container mt-3 ">
        <div class="col-md-4">
            <?php
            include 'koneksi.php';

            $edit = mysqli_query($db, "SELECT * FROM rak WHERE id_rak='$_GET[id_edit]'");
            $data = mysqli_fetch_array($edit);

            ?>
            <h2>Form Edit rak</h2>
            <div class="row">
                <form action="proses_rak.php?aksi=edit_rak" method="post">
                <input type="hidden" class="form-control" name="id" value="<?= $_GET['id_edit']?>">
                    <div class="mb-3">
                        <label class="form-label">Nama rak</label>
                        <input type="text" class="form-control" name="nama" value="<?= $data['nama_rak'] ?>" required>
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
        break;
            }
    ?>
</body>