<?php include 'koneksi.php'; ?>

<?php $page = isset($_GET['page']) ? $_GET['page'] : 'list';

    switch($page){
        case 'list':
?>

<?php
    $prodi = mysqli_query($db, "SELECT * FROM prodi");
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
            <h2>Data Prodi</h2>
            <div class="col-md-4">
                <a href="index.php?p=prodi&page=input" class="btn btn-success mb-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Tambah Prodi</a>
            </div>
        <form action="proses_prodi.php?aksi=create" method="post">
        <table class="table table-bordered">
            <tr class="table-dark">
                <th>No</th>
                <th>Nama Prodi</th>
                <?php
                    if ($_SESSION['level']=='admin'){
                ?>
                <th>Aksi</th>
                <?php
                    }
                ?>
            </tr>
            <?php $i = 1  ?>
            <?php foreach ($prodi as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td> <?= $row["nama_prodi"]; ?></td>
                <?php
                    if ($_SESSION['level']=='admin'){
                ?>
                <td>
                    <a href="index.php?p=prodi&page=edit&id_edit=<?=$row["id_prodi"]; ?>" class="btn btn-warning">Edit</a>
                    <a href="proses_prodi.php?p=hapus_prd&id_hapus=<?= $row["id_prodi"]; ?>"
                        onclick="return confirm('Yakin hapus data ?');" class="btn btn-danger"><span data-feather="trash-2" class="align-text-bottom"></span> Hapus</a>
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
            <h2>Form Input Prodi</h2>
            <div class="row">
                <form action="proses_prodi.php?p=input_prd" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama </label>
                        <input type="text" class="form-control" name="nama">
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

            $edit = mysqli_query($db, "SELECT * FROM prodi WHERE id_prodi='$_GET[id_edit]'");
            $data = mysqli_fetch_array($edit);

            ?>
            <h2>Form Edit Prodi</h2>
            <div class="row">
                <form action="proses_prodi.php?p=edit_prodi" method="post">
                        <input type="text" class="form-control" name="id" value="<?= $data['id_prodi'] ?>"hidden>
                    <div class="mb-3">
                        <label class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" name="nama" value="<?= $data['nama_prodi'] ?>">
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