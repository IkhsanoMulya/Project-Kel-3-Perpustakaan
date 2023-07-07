<?php
    // CREATE
    include 'koneksi.php';
if ($_GET['aksi'] == 'input_rak') {
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];

        $sql = mysqli_query($db, "INSERT INTO rak(nama_rak) VALUES ('$nama')");

        if ($sql) {
            echo "<script> 
             window.location = 'index.php?p=rak&msg=ok';
             </script>";
        } else {
            echo $db->error;
        }
    }
}

// UPDATE
elseif ($_GET['aksi'] == 'edit_rak') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];

        $sql = mysqli_query($db, "UPDATE rak SET nama_rak='$nama' WHERE id_rak='$id'");

        if ($sql) {
            echo "<script>window.location='index.php?p=rak&msg=ok'</script>";
        } else {
            echo $db->error;
        }
    }
}

// DELETE
elseif ($_GET['aksi'] == 'hapus_rak') {
    $id = $_GET['id_hapus'];
    $child = mysqli_query($db,"SELECT id_rak FROM buku WHERE id_rak ='$id'");
    $bisa = mysqli_num_rows($child);
    
    if ($bisa == 0 ) {
        $hapus = mysqli_query($db, "DELETE FROM rak WHERE id_rak='$id'");
        echo "<script>
            alert('Data Berhasil Dihapus !');
            window.location = 'index.php?p=rak';
            </script>";
    } else if($bisa > 0){
        echo "
            <script>
                alert('Masih Ada Buku di Rak Ini!');
                window.location = 'index.php?p=rak';
            </script>";
    }else{
        echo "
            <script>
                alert('Data Gagal Dihapus');
                window.location = 'index.php?p=rak';
            </script>";
    }
}

?>