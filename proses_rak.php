<?php
    // CREATE
    include 'koneksi.php';
if ($_GET['aksi'] == 'input_rak') {
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];

        $sql = mysqli_query($db, "INSERT INTO rak(nama_rak) VALUES ('$nama')");

        if ($sql) {
            echo "<script> 
             window.location = 'index.php?p=rak&msg=yes';
             </script>";
        } else {
            echo "<script> 
             window.location = 'index.php?p=rak&msg=no';
             </script>";
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
            echo "<script>window.location='index.php?p=rak&msg=yes'</script>";
        } else {
            echo "<script> 
            window.location = 'index.php?p=rak&msg=no';
            </script>";
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
            window.location = 'index.php?p=rak&msg=del';
            </script>";
    } else if($bisa > 0){
        echo "
            <script>
                window.location = 'index.php?p=rak&msg=aktif';
            </script>";
    }else{
        echo "
            <script>
                window.location = 'index.php?p=rak&msg=delno';
            </script>";
    }
}

?>