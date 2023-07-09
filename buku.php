<body>
<?php
$page=isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page){
    case 'list' :
?>

<div class="container">
        <div class="row mt-2">
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
                <strong>Buku Masih Dipinjam!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>
        <h2> Data Buku </h2>
        <?php
            if ($_SESSION['level'] == 'admin') {
        ?>
        <div class="col-md-4">
            <a href="index.php?p=buku&page=input" class="btn btn-success mb-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Tambah buku</a>
        </div>
        <?php
            }
        ?>
            <table class="table table-bordered">
                <tr class="table-secondary">
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Rak</th>
                    <th>Stok</th>

                <?php
                    if ($_SESSION['level'] == 'admin') {
                ?>
                    <th>Aksi</th>
                <?php
                    }
                ?>
                </tr>
                <?php
                    include 'koneksi.php';
                    $ambil = mysqli_query($db,"SELECT * FROM buku join rak on(buku.id_rak = rak.id_rak) ORDER BY nama_rak");
                    $no = 1;
                    while($data = mysqli_fetch_array($ambil)){
                ?>
                    <tr>
                        <td> <?php echo $no ?> </td>
                        <td> <?php echo $data['judul'] ?> </td>
                        <td> <?php echo $data['pengarang'] ?> </td>
                        <td> <?php echo $data['penerbit'] ?> </td>
                        <td> <?php echo $data['tahun_terbit'] ?> </td>
                        <td> <?php echo $data['nama_rak'] ?> </td>
                        <td> <?php echo $data['stok'] ?> </td>
                        <?php
                            if ($_SESSION['level'] == 'admin') {
                        ?>
                        <td> 
                            <a href="index.php?p=buku&page=edit&id_edit=<?=$data['id_buku']?>" class="btn btn-warning"><span data-feather="edit" ></span> </a>
                            <a href="proses_buku.php?aksi=hapus_buku&id_hapus=<?= $data['id_buku']?> " class="btn btn-danger" 
                            onclick="return confirm ('Yakin akan menghapus data ?')"><span data-feather="trash-2" class="align-text-bottom"></span></a>
                        </td>

                        <?php
                            }
                        ?>
                    </tr>
                <?php
                    $no++;
                    }
                ?>
            </table>
        </div>
    </div>
<?php        
        break;
    case 'input' : 
?>

<div class="container">
            <?php
                function getBookId() {
                    include 'koneksi.php';
                    $sql = "SELECT MAX(id_buku) as id from buku";
            
                    if ($result = mysqli_query($db, $sql)) {
                        
                        $id = mysqli_fetch_assoc($result);
                        $max_id = $id['id'];
                        $rowcount = intval(substr($max_id,1,12));
                    }
                    $newNumber = ($rowcount) + 1;
            
                    $paddedNumber = str_pad($newNumber, 12, '0', STR_PAD_LEFT);
                    
                    $transactionNumber = "B" . $paddedNumber;
                    
                    return $transactionNumber;
                    }
            ?>
    <h3>Form Input Buku</h3>
    <div class="row">
        <div class="col-md-8">
            <form action="proses_buku.php?aksi=input_buku" method="post">
                <div class="d-flex gap-3">

                    <div class="">
                        <label class="form-label" for="id"> ID Buku </label>
                        <input type="text" id="id" name="id_buku" class="form-control" value="<?= getBookId() ?>" readonly>
                    </div>
                    
                    <div class="">
                        <label class="form-label" for="tahun"> Tahun Terbit </label>
                        <input type="text" name="tahun_terbit" id="tahun" class="form-control" maxlength="4" required>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-2">
                    
                    <div class="">
                        <label class="form-label" for="judul"> Judul </label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>
                    
                    <div class="">
                        <label class="form-label" for="rak">Rak</label>
                        <select name="rak" id="rak" class="form-select" required>
                        <option value=""  >Pilih Rak</option>
                        <?php
                            $raks = mysqli_query($db,'SELECT * FROM rak');
                            foreach ($raks as $rak) {
                        ?>
                            <option value="<?= $rak['id_rak'] ?>" ><?=$rak['nama_rak']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                </div>

                <div class="d-flex mt-2 gap-3">

                    <div class="">
                        <label class="form-label" for="pengarang"> Pengarang </label>
                        <input type="text" name="pengarang" id="pengarang" class="form-control" required>
                    </div>
                    
                    <div class="">
                        <label class="form-label" for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                </div>
                    
                <div class="d-flex mt-2 gap-3">

                    <div class="">
                        <label class="form-label" for="penerbit"> Penerbit </label>
                        <input type="text" name="penerbit" id="penerbit" class="form-control" required>
                    </div>
                    
                    <div class="">
                        <label class="form-label" for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" required>
                    </div>
                </div>
                    
                <div class="mt-2">
                    <input type="submit" name="submit" class="btn btn-primary">
                    <input type="reset" name="reset" class="btn btn-secondary">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    break;
    case 'edit' : 
    ?>
 <div class="container">
    <?php
            include 'koneksi.php';
            $ambil=mysqli_query($db,"SELECT * FROM buku WHERE id_buku='$_GET[id_edit]'");
            $data=mysqli_fetch_array($ambil);
        ?>
        <h3>Edit Data buku</h3>
        <div class="row">
            <div class="col-md-4">
            <form action="proses_buku.php?aksi=edit_buku" method="post">

            <div class="">
                    <label class="form-label"> ID Buku </label>
                    <input type="text"name="id_buku" class="form-control" value="<?= $data['id_buku'] ?>" readonly>
                </div>
                <div class="">
                    <label class="form-label"> Judul </label>
                    <input type="text"name="judul" class="form-control" value="<?= $data['judul'] ?>">
                </div>
                <div class="">
                    <label class="form-label"> Pengarang </label>
                    <input type="text"name="pengarang" class="form-control" value="<?= $data['pengarang'] ?>">
                </div>
                <div class="">
                    <label class="form-label"> Penerbit </label>
                    <input type="text"name="penerbit" class="form-control" value="<?= $data['penerbit'] ?>">
                </div>

                <div class="">
                    <label class="form-label"> Tahun Terbit </label>
                    <input type="number"name="tahun_terbit" class="form-control" value="<?= $data['tahun_terbit'] ?>">
                </div>
                <div class="">
                    <label class="form-label" for="rak">Rak</label>
                    <select name="rak" id="rak" class="form-select">
                <?php
                    
                    $raks = mysqli_query($db,'SELECT * FROM rak');
                    foreach ($raks as $rak) {
                ?>
                    <option value="<?= $rak['id_rak'] ?>" <?php $rak['id_rak'] == $data['id_rak'] ? 'selected' : '' ?> ><?=$rak['nama_rak']?></option>
                <?php
                    }
                ?>
                    </select>
                </div>
                <div class="">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga" value="<?= $data['harga'] ?>">
                </div>
                <div class="">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" value="<?= $data['stok'] ?>">
                </div>
            
            <div class="mt-2">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                <input type="Reset" class="btn btn-secondary" name="reset" value="Reset">
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
