<?php
$page=isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page){
    case 'list' :
?>
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
                }
            ?>
            <h2> Pengembalian Buku </h2>
            <!-- <div class="col-md-4">
           
            <a  class="btn btn-success mb-3" href="index.php?p=pengembalian&page=input" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Tambah Pengembalian</a>
          

            </div> -->

                <table class="table table-bordered mt-3">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>ID Pengembalian</th>
                        <th>ID Peminjaman</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal Kembali</th>
                        <th>Petugas</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    include 'koneksi.php';

                    $ambil = mysqli_query($db, "SELECT id_pengembalian, peminjaman.id_peminjaman as idP, 
                    pengembalian.tanggal_pengembalian as tglK, nama_petugas , nama_anggota,denda FROM pengembalian
                    INNER JOIN peminjaman ON peminjaman.id_peminjaman=pengembalian.id_peminjaman
                    INNER JOIN anggota ON anggota.id_anggota=peminjaman.id_anggota    
                    INNER JOIN petugas ON petugas.id_petugas=peminjaman.id_petugas    
                    ORDER BY pengembalian.tanggal_pengembalian DESC");

                    $no = 1;
                    while ($data = mysqli_fetch_array($ambil)) {
                        
                        ?>
                        <tr>
                            <td> <?php echo $no ?> </td>
                            <td> <?php echo $data['id_pengembalian'] ?> </td>
                            <td> <?php echo $data['idP'] ?> </td>
                            <td> <?php echo $data['nama_anggota'] ?> </td>
                            <td> <?php echo $data['tglK'] ?> </td>
                            <td> <?php echo $data['nama_petugas'] ?> </td>
                            <td> <?php echo $data['denda'] ?> </td>
                            <td>
                                <a href="index.php?p=kembali&page=list&id_pengembalian=<?= $data['id_pengembalian'] ?>" class="btn btn-primary">Detail</a>
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
                <div class="col-md-9">
                <?php
                function getPengId() {
                    include 'koneksi.php';
                    $ymd = date('Ymd');
                    $sql = "SELECT MAX(id_pengembalian) as id from pengembalian";
            
                    if ($result = mysqli_query($db, $sql)) {
                        
                        $id = mysqli_fetch_assoc($result);
                        $max_id = $id['id'];
                        $rowcount = intval(substr($max_id,10,3));
                    }
                    $newNumber = ($rowcount) + 1;
            
                    $paddedNumber = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                    
                    $transactionNumber = "K" .$ymd. $paddedNumber;
                    
                    return $transactionNumber;
                    }
            ?>
                    <h2>Form Input Pengembalian</h2>
                    <div class="row">
                        <form action="proses_pengembalian.php?aksi=input_peng" method="post">
                           <div class="d-flex gap-2">

                               <div class="">
                                   <label class="form-label">ID Pengembalian</label>
                                <input type="text" class="form-control" value="<?= getPengId() ?>" name="id_pengembalian" readonly>
                            </div>
                            
                            <div class="">
                                <label class="form-label">ID Peminjaman</label>
                                <input type="text" class="form-control"  name="id_peminjaman" value="<?= $_GET['id_peminjaman']?>">
                            </div>
                            
                            <div class="">
                                <label class="form-label">Tanggal Kembali</label>
                                <input class="form-control" type="date" name="tgl_kembali" value="<?= date('Y-m-d')?>" readonly>
                            </div>

                            <input type="submit" class="btn btn-primary" name="submit" value="Selesai">
                                  
                        </div>
                        <table class="table table-bordered mt-3">
                <tr class="table-secondary">
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Hilang/Rusak</th>
                </tr>
                <?php
                    include 'koneksi.php';
                    $ambil = mysqli_query($db,"SELECT d.id_buku,judul,pengarang,penerbit,tahun_terbit FROM detail_peminjaman d
                    join buku b on(d.id_buku = b.id_buku)
                    join rak on (rak.id_rak = b.id_rak)
                    WHERE id_peminjaman = '$_GET[id_peminjaman]'");
                    $no = 1;
                    while($data = mysqli_fetch_array($ambil)){
                ?>
                    <tr>
                        <td> <?php echo $no ?> </td>
                        <td> <?php echo $data['judul'] ?> </td>
                        <td> <?php echo $data['pengarang'] ?> </td>
                        <td> <?php echo $data['penerbit'] ?> </td>
                        <td> <?php echo $data['tahun_terbit'] ?> </td>
                        <td> <input type="checkbox" class="form-check-input" name="bayar[]" value="<?=$data['id_buku']?>"> </td>
                    </tr>
                <?php
                    $no++;
                    }
                ?>
            </table>
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

