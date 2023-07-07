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
            <h2> Pengembalian Buku </h2>
            <div class="col-md-4">
           
            <a  class="btn btn-success mb-3" href="index.php?p=pengembalian&page=input" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Tambah Pengembalian</a>
          

            </div>

                <table class="table table-bordered">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>ID Pengembalian</th>
                        <th>ID Peminjaman</th>
                        <th>Tanggal Kembali</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    include 'koneksi.php';

                    $ambil = mysqli_query($db, "SELECT * FROM peminjaman INNER JOIN 
                        petugas ON petugas.id_petugas=peminjaman.id_petugas ORDER BY tanggal_peminjaman DESC");

                    $no = 1;
                    while ($data = mysqli_fetch_array($ambil)) {
                        //hitung jumlah
                        $id_peminjaman = $data['id_peminjaman'];
                        ?>
                        <tr>
                            <td> <?php echo $no ?> </td>
                            <td> <?php echo $data['id_peminjaman'] ?> </td>
                            <td> <?php echo $data['id_anggota'] ?> </td>
                            <td> <?php echo $data['tanggal_peminjaman'] ?> </td>
                            <td> <?php echo $data['tanggal_pengembalian'] ?> </td>
                            <td>
                                <a href="index.php?p=detail&page=list&id_transaksi=<?= $data['id_peminjaman'] ?>" class="btn btn-primary">Detail</a>
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
    case 'input':           
        ?>
            <div class="container mt-3 ">
                <div class="col-md-4">
                <?php
                        include 'koneksi.php';
                        $sql = mysqli_query($db,"SELECT MAX(id_pengembalian) FROM pengembalian");
                        $id = json_encode($sql);
                        if ($id) {
                            $format = "K%04d";
                            $pisah = substr($id, 1, 4);
                            $tambah = intval($id) + 1;
                            $newId = sprintf($format,$tambah);
                        }else {
                            $newId = 'K0001';
                        }
                    ?>
                    <h2>Form Input Pengembalian</h2>
                    <div class="row">
                        <form action="proses_pengembalian.php?aksi=input_peng" method="post">
                           
                            <div class="mb-3">
                                <label class="form-label">ID Pengembalian</label>
                                <input type="text" class="form-control" value="<?= $newId ?>" name="id_pengembalian" readonly>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">ID Peminjaman</label>
                                <input type="text" class="form-control"  name="id_peminjaman" >
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Tanggal Kembali</label>
                                <input class="form-control" type="date" name="tgl_kembali" value="<?= date('Y-m-d')?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Denda</label>
                                <input class="form-control" type="number" name="denda" value="0" readonly>
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
<style>
.table-container {
    display: flex;
}
                            
.column-1 {
    margin-right: 170px;
    margin-left: 50px;
}

.center-text {
    text-align: center;
}



</style>

