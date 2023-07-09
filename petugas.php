<?php
    include 'koneksi.php';

    $page = isset($_GET['page']) ? $_GET['page'] : 'list';

    switch($page){
        case 'list':

            $user = mysqli_query($db, "SELECT * FROM petugas");
            

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
                }
            ?>

        <!--Menampilkan Data User dengan tabel-->
        <h2>Data Petugas</h2>
        <div class="col-md-4 mb-2">
            <a href="index.php?p=petugas&page=input" class="btn btn-success" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Tambah Petugas</a>
        </div>

        </div>
        <table class="table table-bordered  table-hover table-responsive">
            <tr class="table-secondary">
                <th>No</th>
                <th>Nama Petugas</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>
            <?php $i = 1  ?>
            <?php foreach ($user as $row) : 
               
            ?>
            <tr>
                <td><?= $i; ?></td>
                <td> <?= $row["nama_petugas"]; ?></td>
                <td> <?= $row["username"]; ?></td>
                <td> <?= $row["alamat"]; ?></td>
                <td> <?= $row["no_telepon"]; ?></td>
                
                <td>
                    <a href="index.php?p=petugas&page=edit&id_edit=<?=$row["id_petugas"]; ?>" class="btn btn-warning"><span data-feather="edit"></a>
                    <a href="proses_petugas.php?aksi=hapus_user&id_hapus=<?= $row["id_petugas"]; ?>"
                        onclick="return confirm('Yakin hapus data ?');" class="btn btn-danger"><span data-feather="trash-2" ></span> </a>
                </td>
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
            <?php
                function getPetId() {
                    include 'koneksi.php';
                    $sql = "SELECT MAX(id_petugas) as id from petugas";
            
                    if ($result = mysqli_query($db, $sql)) {
                        
                        $id = mysqli_fetch_assoc($result);
                        $max_id = $id['id'];
                        $rowcount = intval(substr($max_id,1,4));
                    }
                    $newNumber = ($rowcount) + 1;
            
                    $paddedNumber = str_pad($newNumber, 4, '0', STR_PAD_LEFT);
                    
                    $transactionNumber = "P" . $paddedNumber;
                    
                    return $transactionNumber;
                    }
            ?>
            <h2>Form Input Petugas</h2>
            <div class="row">
                <form action="proses_petugas.php?aksi=input_user" method="post">
                   
                    
                        <input type="text" class="form-control" value="<?= getPetId() ?>" name="id_petugas" hidden>
                   
                    <div class="d-flex gap-3">

                        <div class="">
                            <label class="form-label">Nama Petugas</label>
                            <input type="text" class="form-control"  name="nama_petugas" required>
                        </div>
                        
                        <div class="">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3">
                            
                        <div class="">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                            
                        <div class="">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                    </div>

                    <div class="">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" pattern="[0-9]*" name="no_telepon" maxlength="15">
                    </div>

                    <div class="">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control"  name="alamat" ></textarea>
                    </div>          

                    <div class="mt-3">
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

            $edit = mysqli_query($db, "SELECT * FROM petugas WHERE id_petugas='$_GET[id_edit]'");
            $data = mysqli_fetch_array($edit);

            ?>
            <h2>Form Edit User</h2>
            <div class="row">
                <form action="proses_petugas.php?aksi=edit_user" method="post">
           
                    <input type="text" class="form-control" name="id_petugas" value="<?= $data['id_petugas'] ?>" hidden>
             
                    <div class="d-flex gap-3">

                        <div class="">
                            <label class="form-label">Nama Petugas</label>
                            <input type="text" class="form-control" value="<?= $data['nama_petugas'] ?>" name="nama_petugas">
                        </div>
                        
                        <div class="">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="d-flex gap-3">

                        <div class="">
                            <label class="form-label">Username </label>
                            <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>" required>
                        </div>
                        
                        <div class="">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                    </div>
                    
                    <div class="">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" pattern="[0-9]*" value="<?= $data['no_telepon'] ?>" name="no_telepon">
                    </div>

                    <div class="">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control"  name="alamat"><?= $data['alamat'] ?></textarea>
                    </div>


                    <div class="mt-3">
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