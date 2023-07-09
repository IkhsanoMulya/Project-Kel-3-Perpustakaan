<?php
$page=isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page){
    case 'list' :
?>

<div class="container">
        <div class="row mt-2">
        
        <h2> Detail Pengembalian : <?= $_GET['id_pengembalian']?> </h2>
       
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
                    $peminjaman = mysqli_query($db,"SELECT id_peminjaman FROM pengembalian
                    WHERE id_pengembalian = '$_GET[id_pengembalian]'");
                    $id = mysqli_fetch_assoc($peminjaman);
                    $ambil = mysqli_query($db,"SELECT * FROM detail_peminjaman d
                    join buku b on(d.id_buku = b.id_buku)
                    join rak r on(r.id_rak = b.id_rak)
                    WHERE id_peminjaman = '$id[id_peminjaman]'");
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