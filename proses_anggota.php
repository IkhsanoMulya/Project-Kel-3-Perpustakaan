<?php
// CREATE
include 'koneksi.php';
if ($_GET['aksi'] == 'input_ang') {
    
    if (isset($_POST['submit'])) {
        $id = $_POST['id_anggota'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $no_telepon = $_POST['no_telepon'];
        $id_prodi = $_POST['id_prodi'];

        $sql = mysqli_query($db, "INSERT INTO anggota(id_anggota, nama_anggota, alamat, tanggal_lahir, no_telepon, id_prodi) 
        VALUES ('$id', '$nama', '$alamat', '$tanggal_lahir', '$no_telepon', '$id_prodi')");

        if ($sql) {
            echo "<script> 
             window.location = 'index.php?p=anggota&msg=yes';
             </script>";
        } else {
            echo "
                <script>
                window.location = 'index.php?p=anggota&msg=no';
                </script>";
        }
    }
}

// UPDATE
elseif ($_GET['aksi'] == 'edit_ang') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id_anggota'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $no_telepon = $_POST['no_telepon'];
        $id_prodi = $_POST['id_prodi'];

        $sql = mysqli_query($db, "UPDATE anggota SET nama_anggota='$nama', alamat='$alamat', tanggal_lahir='$tanggal_lahir', 
        no_telepon='$no_telepon', id_prodi='$id_prodi' WHERE id_anggota='$id'");

        if ($sql) {
            echo "<script>window.location='index.php?p=anggota&msg=yes'</script>";
        } else {
            echo "
                    <script>
                    window.location = 'index.php?p=anggota&msg=no';
                    </script>";
        }
    }
}

// DELETE
elseif ($_GET['aksi'] == 'hapus_ang') {
    $id = $_GET['id_hapus'];
    $child = mysqli_query($db,"SELECT id_anggota FROM peminjaman WHERE id_anggota ='$id'");
    $bisa = mysqli_num_rows($child);
    
    if ($bisa == 0 ) {
        $hapus = mysqli_query($db, "DELETE FROM anggota WHERE id_anggota='$id'");
        echo "<script>
            window.location = 'index.php?p=anggota&msg=del';
            </script>";
    } else if($bisa > 0){
        echo "
            <script>
                window.location = 'index.php?p=anggota&msg=aktif';
            </script>";
    }else{
        echo "
            <script>
                window.location = 'index.php?p=anggota&msg=delno';
            </script>";
    }
}

?>