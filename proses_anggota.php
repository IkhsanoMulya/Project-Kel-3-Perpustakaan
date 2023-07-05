<?php
// CREATE
if ($_GET['aksi'] == 'input_ang') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $no_telepon = $_POST['no_telepon'];
        $id_prodi = $_POST['id_prodi'];

        $sql = mysqli_query($db, "INSERT INTO anggota(id, nama, alamat, tanggal_lahir, no_telepon, id_prodi) 
        VALUES ('$id', '$nama', '$alamat', '$tanggal_lahir', '$no_telepon', '$id_prodi')");

        if ($sql) {
            echo "<script> 
             window.location = 'index.php?p=anggota&msg=ok';
             </script>";
        } else {
            echo "
                <script>
                    alert('data gagal  disimpan !');
                </script>";
        }
    }
}

// UPDATE
elseif ($_GET['aksi'] == 'edit_ang') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $no_telepon = $_POST['no_telepon'];
        $id_prodi = $_POST['id_prodi'];

        $sql = mysqli_query($db, "UPDATE anggota SET nama='$nama', alamat='$alamat', tanggal_lahir='$tanggal_lahir', 
        no_telepon='$no_telepon', id_prodi='$id_prodi' WHERE id='$id'");

        if ($sql) {
            echo "<script>window.location='index.php?p=anggota&msg=ok'</script>";
        } else {
            echo "
                    <script>
                        alert('data gagal  disimpan !');
                    </script>";
        }
    }
}

// DELETE
elseif ($_GET['aksi'] == 'hapus_ang') {
    $id = $_GET['id_hapus'];
    $hapus = mysqli_query($db, "DELETE FROM anggota WHERE id='$id'");

    if ($hapus) {
        echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=anggota';
            </script>";
    } else {
        echo "
            <script>
                alert('data gagal  dihapus !');
            </script>";
    }
}

?>