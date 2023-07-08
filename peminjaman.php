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
            <h2> Peminjaman Buku </h2>
            <div class="col-md-4">
            
            <a class="btn btn-success mb-3" href="index.php?p=peminjaman&page=input" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Tambah Peminjaman</a>
        
            </div>
                <table class="table table-bordered">
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>ID Peminjaman</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Petugas</th>
                        <th>Aksi </th>
                    </tr>
                    <?php
                    include 'koneksi.php';

                    $ambil = mysqli_query($db, "SELECT * FROM peminjaman INNER JOIN 
                        petugas ON petugas.id_petugas=peminjaman.id_petugas
                        INNER JOIN anggota ON anggota.id_anggota=peminjaman.id_anggota
                        ORDER BY tanggal_peminjaman DESC");

                    $no = 1;
                    while ($data = mysqli_fetch_array($ambil)) {
                        //hitung jumlah
                        $id_peminjaman = $data['id_peminjaman'];
                        ?>
                        <tr>
                            <td> <?php echo $no ?> </td>
                            <td> <?php echo $data['id_peminjaman'] ?> </td>
                            <td> <?php echo $data['nama_anggota'] ?> </td>
                            <td> <?php echo $data['tanggal_peminjaman'] ?> </td>
                            <td> <?php echo $data['tanggal_pengembalian'] ?> </td>
                            <td> <?php echo $data['nama_petugas'] ?> </td>
                            <td>
                                <a href="index.php?p=detail&page=list&id_peminjaman=<?= $data['id_peminjaman'] ?>" class="btn btn-primary">Detail</a>
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
                include 'koneksi.php';
                $ymd = date('Ymd');
                $sql = mysqli_query($db,"SELECT MAX(id_peminjaman) FROM peminjaman WHERE tanggal_peminjaman = '$ymd'");
                $id = json_encode($sql);
                if ($id) {
                    $format = '%03d';
                    $pisah = substr($id, 9, 3);
                    $tambah = intval($id) + 1;
                    $last = sprintf($format,$tambah);
                    $newId = 'J'.$ymd.$last;
                }else {
                    $newId = 'J'.$ymd.'001';
                }
            ?>
            <h2>Form Input Peminjaman</h2>
            <div class="row">
                <form action="proses_peminjaman.php?aksi=input_pem" method="post">
                   <div class="d-flex gap-2">

                       <div class="">
                           <label class="form-label">ID Peminjaman</label>
                        <input type="text" class="form-control" value="<?= $newId ?>" name="id_peminjaman" readonly>
                    </div>
                    
                    <div class="">
                        <label class="form-label">ID Petugas</label>
                        <input type="text" class="form-control"  name="id_petugas" value="<?=$_SESSION['id_login'] ?>" readonly>
                    </div>

                    <div class="">
                        <label class="form-label">ID Anggota</label>
                        <input type="text" class="form-control"  name="id_anggota" required>
                    </div>
                    
                    <div class="">
                        <label class="form-label">Tanggal Peminjaman</label>
                        <input class="form-control" type="date" value="<?= date("Y-m-d")?>" name="tgl_pinjam" readonly >
                    </div>
                    <?php
                        $today = strtotime(date("Y-m-d")); // Mendapatkan timestamp hari ini
                        $twoWeeksLater = strtotime("+2 weeks", $today); // Mendapatkan timestamp 2 minggu dari hari ini
                        
                        // Cek jika tanggal 2 minggu kemudian adalah hari Minggu
                        if (date("l", $twoWeeksLater) === "Sunday") {
                            $twoWeeksLater = strtotime("+1 day", $twoWeeksLater); // Jika hari Minggu, tambahkan 1 hari
                        }
                        
                        $desiredDate = date("Y-m-d", $twoWeeksLater); // Mendapatkan tanggal dalam format yang diinginkan
                        
                        ?>

                    <div class="">
                        <label class="form-label">Tanggal Pengembalian</label>
                        <input class="form-control" type="date" name="tgl_kembali" value="<?= $desiredDate?>" readonly>
                    </div>
                    
                </div>
                
                <div class="col-md-7 mt-2">
                    <script>
                        function submitForm() {
                            document.getElementById("searchForm").submit();
                        }
                    </script>
                        <form action="" method="post" id="searchForm">
                            <select class="form-select">
                                <option><input type="text" class="form-control" name="search" onchange="submitForm()"></option>
                                <?php
                                    
                                    if (isset($_POST['seacrh'])) {
                                        $search = $_POST['search'];
                                        $sql = mysqli_query($db,"SELECT * FROM buku WHERE judul like %$search% 
                                        OR pengarang like %$search% OR penerbit like %$search% 
                                        OR tahun_terbit like %$search%");

                                        if ($sql) {
                                            foreach($sql as $row){
                                                $option = $row['judul']." | ".$row['pengarang']." | ".$row['penerbit']." | ".$row['tahun_terbit'];
                                               echo "<option value=".$row['id_buku'].">".$option."</option>";
                                            }
                                        }
                                    }
                                ?>
                                
                            </select>
                        </form>
                </div>

                <table class="table table-bordered mt-2">
                <tr class="table-secondary">
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Rak</th>
                
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
                        
                    </tr>
                <?php
                    $no++;
                    }
                ?>
            </table>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
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

