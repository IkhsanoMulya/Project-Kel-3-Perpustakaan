
<?php
    include 'koneksi.php';
if ($_GET['aksi'] == 'input_detail') {
    if (isset($_POST['submit'] )) {
        $idPinjam = $_POST['pinjam'];
        $idBuku = $_POST['buku'];
        if ($_POST['buku'] == null) {
            echo "<script> 
            window.location = 'index.php?p=peminjaman&page=input';
            </script>";
        }

        $query = mysqli_query($db,"SELECT id_buku from detail_peminjaman WHERE id_buku = '$idBuku' AND id_peminjaman = '$idPinjam'");
        $sudahIn = mysqli_num_rows($query);

        if ($sudahIn == 0) {
            $sql = mysqli_query($db, "INSERT INTO detail_peminjaman(id_peminjaman,id_buku) 
            VALUES ('$idPinjam','$idBuku')");
            echo "<script> 
             window.location = 'index.php?p=peminjaman&page=input';
             </script>";
        } else if($sudahIn > 0){
            echo "<script> 
             window.location = 'index.php?p=peminjaman&page=input&msg=no';
             </script>";
        }
    }else if(isset($_POST['batal'])){
        $idPinjam = $_POST['pinjam'];
        $sql = mysqli_query($db, "DELETE FROM detail_peminjaman WHERE id_peminjaman = '$idPinjam'");

        if ($sql) {
            echo "<script> 
             window.location = 'index.php?p=peminjaman&page=list';
             </script>";
        } else {
            echo $db->error;
        }
    }

}elseif ($_GET['aksi'] == 'hapus_detail') {
    $id = $_GET['id_hapus'];
    $Pin = $_GET['id_p'];
    $hapus = mysqli_query($db, "DELETE FROM detail_peminjaman WHERE id_buku = '$id' AND id_peminjaman = '$Pin' ");
    if ($hapus) {
        echo "<script>
            window.location = 'index.php?p=peminjaman&page=input';
        </script>";
    }else{
        echo "
            <script>
                alert('Data Gagal Dihapus');
                </script>";
    }
  
}

?>