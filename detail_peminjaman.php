<?php
$page=isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page){
    case 'list' :
?>

<div class="container">
        <div class="row mt-2">
        
        <h2> Detail Peminjaman : <?= $_GET['id_peminjaman']?> </h2>
       
            <table class="table table-bordered">
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
                    $ambil = mysqli_query($db,"SELECT * FROM detail_peminjaman d
                    join buku b on(d.id_buku = b.id_buku)
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
                        <td> <?php echo $data['nama_rak'] ?> </td>
                    </tr>
                <?php
                    $no++;
                    }
                ?>
            </table>
        </div>
    </div>
<?php
}
?>