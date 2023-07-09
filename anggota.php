<?php
    include 'koneksi.php';

    $page = isset($_GET['page']) ? $_GET['page'] : 'list';

    switch($page){
        case 'list':

            $anggota = mysqli_query($db, "SELECT * FROM anggota INNER JOIN prodi ON anggota.id_prodi = prodi.id_prodi");
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
                <strong>Anggota Masih Memiliki Peminjaman Aktif!</strong>
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

            <table class="table table-bordered table-hover">
                <tr class="table-secondary">
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
                    <a href="index.php?p=anggota&page=edit&id_edit=<?=$row["id_anggota"]; ?>" class="btn btn-warning"><span data-feather="edit"></a>
                    <a href="proses_anggota.php?aksi=hapus_ang&id_hapus=<?= $row["id_anggota"]; ?>"
                        onclick="return confirm('Yakin hapus data ?');" class="btn btn-danger"><span data-feather="trash-2" ></span></a>
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

<div class="container">
        <div class="col-md-4">
            <h2>Form Input Anggota</h2>
            <div class="row">
                <form action="proses_anggota.php?aksi=input_ang" method="post">
                   
                <div class="">
                    <label class="form-label" for="id"> ID Anggota </label>
                    <input type="text" id="id" name="id_anggota" class="form-control" pattern="[0-9]*" maxlength="10" required>
                </div>

                <div class="">
                    <label class="form-label" for="nama"> Nama </label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>

                <div class="">
                    <label class="form-label" for="alamat"> Alamat </label>
                    <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                </div>

                <div class="">
                    <label class="form-label" for="tanggal lahir"> Tanggal Lahir </label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                </div>

                <div class="">
                    <label class="form-label" for="telepon"> No. Telepon </label>
                    <input type="text" name="no_telepon" id="telepon" pattern="[0-9]*" class="form-control" maxlength="15" required>
                </div>

                <div class="">
                    <label class="form-label" for="prodi">Prodi</label>
                    <select name="id_prodi" id="prodi" class="form-select" required>
                        <option value=""  >Pilih prodi</option>
                        <?php
                            $prodis = mysqli_query($db,'SELECT * FROM prodi');
                            foreach ($prodis as $prodi) {
                        ?>
                            <option value="<?= $prodi['id_prodi'] ?>" ><?=$prodi['nama_prodi']?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                    <div class="mt-2">

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
    <div class="container ">
        <div class="col-md-4">
            <?php
            include 'koneksi.php';

            $edit = mysqli_query($db, "SELECT * FROM anggota WHERE id_anggota='$_GET[id_edit]'");
            $data = mysqli_fetch_array($edit);

            ?>
            <h2>Form Edit Anggota</h2>
            <div class="row">
            <form action="proses_anggota.php?aksi=edit_ang" method="post">
                   
                   <div class="">
                       <label class="form-label" for="id"> ID Anggota </label>
                       <input type="text" id="id" name="id_anggota" value="<?= $data['id_anggota'] ?>" class="form-control" pattern="[0-9]*" maxlength="10" readonly required>
                   </div>
   
                   <div class="">
                       <label class="form-label" for="nama"> Nama </label>
                       <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['nama_anggota'] ?>" required>
                   </div>
   
                   <div class="">
                       <label class="form-label" for="alamat"> Alamat </label>
                       <textarea name="alamat" id="alamat" class="form-control" required><?= $data['alamat'] ?></textarea>
                   </div>
   
                   <div class="">
                       <label class="form-label" for="tanggal lahir"> Tanggal Lahir </label>
                       <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir'] ?>" required>
                   </div>
   
                   <div class="">
                       <label class="form-label" for="telepon"> No. Telepon </label>
                       <input type="text" name="no_telepon" id="telepon" pattern="[0-9]*" value="<?= $data['no_telepon'] ?>" class="form-control" maxlength="15" required>
                   </div>
   
                   <div class="">
                       <label class="form-label" for="prodi">Prodi</label>
                       <select name="id_prodi" id="prodi" class="form-select" required>
                           <?php
                               $prodis = mysqli_query($db,'SELECT * FROM prodi');
                               foreach ($prodis as $prodi) {
                           ?>
                               <option value="<?= $prodi['id_prodi'] ?>" <?php $prodi['id_prodi'] == $data['id_prodi'] ? 'selected' : ''?>  ><?=$prodi['nama_prodi']?></option>
                           <?php
                               }
                           ?>
                       </select>
                   </div>
                       <div class="mt-2">
   
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