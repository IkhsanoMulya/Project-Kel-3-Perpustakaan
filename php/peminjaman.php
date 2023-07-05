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
            <h2> Transaksi IT Mart </h2>
            <div class="col-md-4">
            <form method="post" action="proses_transaksi.php?aksi=new_transaksi">
                <input type="hidden"name="kasir" class="form-control" value="<?php echo ($_SESSION['user'])?>">
                <button type="submit" class="btn btn-primary mb-3" name="new_transaksi" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">New Transaksi</button>
            </form>

            </div>
                <form action="proses_transaksi.php?aksi=create" method="post">
                <table class="table table-bordered">
                    <tr class="table-dark">
                        <th>No</th>
                        <th>Kasir</th>
                        <th>Waktu</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi </th>
                    </tr>
                    <?php
                    include 'koneksi.php';

                    $ambil = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN 
                        pengurus ON transaksi.kasir=pengurus.id_pengurus ORDER BY waktu DESC");

                    $no = 1;
                    while ($data = mysqli_fetch_array($ambil)) {
                        //hitung jumlah
                        $id_transaksi = $data['id_transaksi'];

                        $hitungjumlah = mysqli_query($db, "SELECT * from detail_transaksi where
                            id_transaksi='$id_transaksi'");

                        $jumlah = mysqli_num_rows($hitungjumlah);
                        ?>
                        <tr>
                            <td> <?php echo $no ?> </td>
                            <td> <?php echo $data['nama_pengurus'] ?> </td>
                            <td> <?php echo $data['waktu'] ?> </td>
                            <td> <?php echo $jumlah ?> </td>
                            <td> <?php echo $data['status_transaksi'] ?> </td>
                            <td>
                                <a href="index.php?p=it-mart&page=detail_trans&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn btn-primary">Tampilkan</a>
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
    case 'detail_trans' : 
?>
    <div class="container">        

        <form action="proses_transaksi.php?aksi=tambah_barang" method="post">
            
            <h2> Transaksi : <?=$_GET['id_transaksi']?></h2>

            <div class="mb-3">
                
                <?php
                $id_transaksi = $_GET['id_transaksi'];
                $ambil = mysqli_query($db,"SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
                $data_transaksi = mysqli_fetch_assoc($ambil);
                $status_transaksi = $data_transaksi['status_transaksi'];
                if ($status_transaksi !== 'completed') {
                ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalBarang">
                        Tambah Barang
                    </button>
                <?php
                    }
                ?>

                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#ModalStrukPembayaran">
                    Struk Pembayaran
                </button>

               
            </div>

            <!-- Modal Tambah Barang-->
            <div class="modal fade" id="ModalBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Barang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <select name=id_barang class="form-control">

                            <?php
                                $id_transaksi = $_GET['id_transaksi'];

                                $getbarang = mysqli_query($db, "SELECT * FROM barang WHERE id_barang NOT IN
                                   (SELECT id_barang FROM detail_transaksi WHERE id_transaksi = '$id_transaksi')");

                                
                                while($data = mysqli_fetch_array($getbarang)){
                                    $id_barang = $data['id_barang'];
                                    $nama_barang = $data['nama_barang'];
                                    $stock = $data['stock'];
                                    $harga = $data['harga'];
                            ?>
                                <option value="<?=$id_barang;?>"><?=$nama_barang;?> - Rp <?=$harga;?> ( <?=$stock;?> pcs )</option>
                            <?php
                                }
                            ?>
                            </select>
                                <input type="number" name="qty" class="form-control mt-4" placeholder="Jumlah" min="1" required>
                                <input type="hidden" name="id_transaksi"  value="<?php echo $_GET['id_transaksi']; ?>">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="add_barang" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <form action="proses_transaksi.php?aksi=edit_barang" method="post">

            <form action="proses_transaksi.php?aksi=pembayaran" method="post">
            
                <!-- Modal Struk Pembayaran -->
                <div class="modal fade" id="ModalStrukPembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Struk Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <?php
                                    $id_transaksi = $_GET['id_transaksi'];

                                    $transaksi = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN 
                                                pengurus ON transaksi.kasir=pengurus.id_pengurus
                                                WHERE id_transaksi = ' $id_transaksi'");
                                    $row = mysqli_fetch_assoc($transaksi);
                                    $uang = $row['uang_yg_dibayar'];
                                    $kasir = $row['nama_pengurus'];
                                    $waktu = $row['waktu'];
                                    
                                    $get_total = mysqli_query($db, "SELECT SUM(subtotal) AS total_subtotal
                                    FROM detail_transaksi WHERE id_transaksi = ' $id_transaksi'");
                                    $row = mysqli_fetch_assoc($get_total);
                                    $total = $row['total_subtotal'];

                                    $kembalian = $uang - $total;

                                ?>
                            
                            
                            <div class="center-text">
                            <h5>IT MART HMJ Tekinfo</h5>
                            <h7>Kesekretariatan Gedung E Lantai 1</h7>
                            </div>
                        
                            <div class="center-text">
                            <h7>-------------------------------------------------------</h7>
                            </div> 

                            <div class="column-1">
                                <table class="center-table">
                                <tr>
                                    <td>Kasir</td>
                                    <td><?php echo $kasir?></td>
                                </tr>
                                <tr>
                                    <td>Transaksi</td>
                                    <td><?php echo $id_transaksi?></td>
                                </tr>
                                </table>
                            </div>
                            
                            <div class="center-text">
                            <h7>_______________________________________________________________________________</h7>

                            </div>

                            <table class="table table-borderless table-sm">
                                
                                <?php
                                    include 'koneksi.php';
                                    
                                    $id_transaksi = $_GET['id_transaksi'];
                                    $kondisi = $id_transaksi !== '' ? "WHERE id_transaksi = '$id_transaksi'" : '';
                    
                                    $ambil = mysqli_query($db,"SELECT * FROM detail_transaksi INNER JOIN 
                                            barang ON detail_transaksi.id_barang=barang.id_barang $kondisi");

                                    $no = 1;
                                    while($data = mysqli_fetch_array($ambil)){
                                        $subtotal = $data['qty']*$data['harga'];
                                ?>
                                    <tr>
                                        <td> <?php echo $data['qty'] ?> </td>
                                        <td> <?php echo $data['nama_barang'] ?> </td>
                                        <td>Rp. <?php echo number_format($subtotal) ?> </td>
                                    </tr>
                                <?php
                                    $no++;
                                    }
                                ?>
                            </table>

                            <div class="table-container">
                            <div class="column-1">
                                <table class="center-table">
                                <tr>
                                    <td>Total       :</td>
                                </tr>
                                <tr>
                                    <td>Payment     :</td>
                                </tr>
                                <tr>
                                    <td>Kembalian   :</td>
                                </tr>
                                </table>
                            </div>
                            <div>
                                <table>
                                <tr>
                                    <td>Rp. <?php echo number_format($total) ?></td>
                                </tr>
                                <tr>
                                    <td>Rp. <?php echo number_format($uang) ?></td>
                                </tr>
                                <tr>
                                    <td>Rp. <?php echo number_format($kembalian) ?></td>
                                </tr>
                                </table>
                            </div>
                            </div>

                            <div class="center-text">
                            <h7>----------------<?php echo $waktu ?>---------------------</h7>
                            </div>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <table class="table table-bordered">
                <?php
                include 'koneksi.php';
                $id_transaksi = $_GET['id_transaksi'];
                $ambil = mysqli_query($db,"SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
                $data_transaksi = mysqli_fetch_assoc($ambil);
                $status_transaksi = $data_transaksi['status_transaksi'];
                ?>
                <tr>
                    <th>No</th>
                    <th>Barang</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th>Sub-Total</th>
                    <?php
                        if ($status_transaksi !== 'completed') {
                    ?>
                    <th>Aksi</th>
                    <?php
                    }
                    ?>
                </tr>

                <?php
                

                $id_transaksi = $_GET['id_transaksi'];
                $kondisi = $id_transaksi !== '' ? "WHERE id_transaksi = '$id_transaksi'" : '';

                $select_barang = mysqli_query($db, "SELECT * FROM detail_transaksi INNER JOIN 
                barang ON detail_transaksi.id_barang=barang.id_barang $kondisi");

                
                $no = 1;
                while ($data = mysqli_fetch_array($select_barang)) {
                    $subtotal = $data['qty'] * $data['harga'];
                    ?>

                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['nama_barang'] ?></td>
                        <td>Rp. <?php echo number_format($data['harga']) ?></td>
                        <td><?php echo $data['qty'] ?></td>
                        <td>Rp. <?php echo number_format($subtotal) ?></td>
                        <td>
                        <?php
                        if ($status_transaksi !== 'completed') {
                        ?>
                            <a href="proses_transaksi.php?aksi=delete_barang&id_hapus=<?= $data['id_detailtransaksi'] ?>&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn btn-danger" onclick="return confirm ('Yakin akan menghapus data ?')">
                                <span data-feather="trash-2" class="align-text-bottom"></span> Hapus
                            </a>

                        <?php
                        }
                        ?>
                        </td>
                    </tr>

                    <?php
                    $no++;
                }
                ?>
            </table>

            <form action="proses_transaksi.php?aksi=uang_dibayar" method="post">
                <input type="hidden" name="id_transaksi"  value="<?php echo $_GET['id_transaksi']; ?>">

                <?php
                    $get_total = mysqli_query($db, "SELECT total_bayar
                    FROM transaksi WHERE id_transaksi = ' $id_transaksi'");
                    $total = mysqli_fetch_assoc($get_total)['total_bayar'];
                    
                    $id_transaksi = $_GET['id_transaksi'];
                    $ambil = mysqli_query($db,"SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
                    $data_transaksi = mysqli_fetch_assoc($ambil);
                    $status_transaksi = $data_transaksi['status_transaksi'];
                ?>

                <table class="table" style="width: 40%;">
                    <tr>
                        <td>Total</td>
                        <td>Rp. <?php echo number_format($total) ?> </td>
                    </tr>
                    <tr>
                    <?php
                    if ($status_transaksi !== 'completed') {
                    ?>
                        <td><div class="mb-3">
                                <label class="form-label">Bayar</label>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="bayar" min="<?php echo $total; ?>" required>
                        </td>
                    </div>
                    <?php
                        }
                    ?>
                    </tr>
                </table>

                <div class="mb-3">
                    <label class="form-label"></label>
                    <?php
                    if ($status_transaksi !== 'completed') {
                    ?>
                        <input type="submit"name="input" class="btn btn-primary" value="Bayar">
                    <?php
                        }
                    ?>
                </div>
            </form>
    </div>

    <?php                
    break;
    case 'pembayaran' : 
    ?>
    <div class="container"> 
    <h2> Pembayaran </h2>
            <div class="mb-3">
            <form method="post" action="proses_transaksi.php?aksi=new_transaksi">
                <input type="hidden"name="kasir" class="form-control" value="<?php echo ($_SESSION['user'])?>">
            </form>

            </div>
                <?php
                $id_transaksi = $_GET['id_transaksi'];

                $get_total = mysqli_query($db, "SELECT SUM(subtotal) AS total_subtotal
                            FROM detail_transaksi WHERE id_transaksi = ' $id_transaksi'");
                            $row = mysqli_fetch_assoc($get_total);
                            $total = $row['total_subtotal'];
                ?>
                            
                <table class="table table-bordered">
                    <tr>
                        <td>Total Belanja</td>
                        <td>Rp. <?php echo number_format($total) ?> </td>
                    </tr>

                    <tr>
                        <td>Uang Yang Dibayar</td>
                        <td><input type="number" name="jumlah_uang" class="form-control mt-4" placeholder="Jumlah Uang" min="<?php echo $total; ?>" required></td>
                    </tr>
                </table>

                <div class="mb-3">
                <input type="submit" name="bayar" class="btn btn-primary">
                
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

