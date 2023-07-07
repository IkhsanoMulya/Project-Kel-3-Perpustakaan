<?php
$page=isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page){
    case 'list' :
?>

<div class="container">
        <div class="row mt-2">
        
        <h2> Absensi </h2>
       
            <table class="table table-bordered">
                <tr class="table-secondary">
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                </tr>
                <?php
                    include 'koneksi.php';
                    $ambil = mysqli_query($db,"SELECT * FROM absensi join anggota on(absensi.id_anggota = anggota.id_anggota) ORDER BY waktu");
                    $no = 1;
                    while($data = mysqli_fetch_array($ambil)){
                ?>
                    <tr>
                        <td> <?php echo $no ?> </td>
                        <td> <?php echo $data['nama_anggota'] ?> </td>
                        <td> <?php echo $data['tanggal'] ?> </td>
                        <td> <?php echo $data['waktu'] ?> </td>
                        
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