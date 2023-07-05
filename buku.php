<body>
<?php
$page=isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page){
    case 'list' :
?>

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
        <h2> Data Buku </h2>
        <div class="col-md-4">
            <a href="index.php?p=buku&page=input" class="btn btn-success mb-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Tambah buku</a>
        </div>
            <table class="table table-bordered">
                <tr class="table-dark">
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Rak</th>
                    <th>Stok</th>
                    <th>Aksi</th>
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
                        <td> 
                            <a href="proses_buku.php?aksi=hapus_buku&id_hapus=<?= $data['id_buku']?> " class="btn btn-danger" 
                            onclick="return confirm ('Yakin akan menghapus data ?')"><span data-feather="trash-2" class="align-text-bottom"></span> Hapus</a>
                            <a href="index.php?p=buku&page=edit&id_edit=<?=$data['id_buku']?>" class="btn btn-warning">Edit</a>
                        </td>
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
                include 'koneksi.php';
                $sql = mysqli_query($db,"SELECT MAX(id_buku) FROM buku");
                $id = json_encode($sql);
                if ($id) {
                    $format = "B%04d";
                    $pisah = substr($id, 1, 4);
                    $tambah = intval($id) + 1;
                    $newId = sprintf($format,$tambah);
                }else {
                    $newId = 'B0001';
                }
            ?>
    <h3>Form Input Buku</h3>
    <div class="row">
        <div class="col-md-4">
            <form action="proses_buku.php?aksi=input_buku" method="post">
            

                <div class="mb-3">
                    <label class="form-label"> ID Buku </label>
                    <input type="text"name="id_buku" class="form-control" value="<?= $newId ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label"> Judul </label>
                    <input type="text"name="judul" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label"> Pengarang </label>
                    <input type="text"name="pengarang" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label"> Penerbit </label>
                    <input type="text"name="penerbit" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label"> Tahun Terbit </label>
                    <input type="number"name="tahun_terbit" class="form-control">
                </div>

                <div class="mb-3">
                        <label class="form-label">Rak</label>
                        <input type="number" class="form-control" name="rak">
                </div>

                <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga">
                </div>

                <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok">
                </div>

                <div class="mb-3">
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
            <div class="col-lg-6">
            <form action="proses_buku.php?aksi=edit_buku" method="post">

            <div class="mb-3">
                    <label class="form-label"> ID Buku </label>
                    <input type="text"name="id_buku" class="form-control" value="<?= $data['id_buku'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Judul </label>
                    <input type="text"name="judul" class="form-control" value="<?= $data['judul'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Pengarang </label>
                    <input type="text"name="pengarang" class="form-control" value="<?= $data['pengarang'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Penerbit </label>
                    <input type="text"name="penerbit" class="form-control" value="<?= $data['penerbit'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Tahun Terbit </label>
                    <input type="number"name="tahun_terbit" class="form-control" value="<?= $data['tahun_terbit'] ?>">
                </div>
                <div class="mb-3">
                        <label class="form-label">Rak</label>
                        <input type="number" class="form-control" name="rak" value="<?= $data['nama_rak'] ?>">
                </div>
                <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga" value="<?= $data['harga'] ?>">
                </div>
                <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" value="<?= $data['stok'] ?>">
                </div>
            
            <div class="mb-2">
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
