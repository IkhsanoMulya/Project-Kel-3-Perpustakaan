// CREATE
<?php
    include 'koneksi.php';
if ($_GET['aksi'] == 'input_buku') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id_buku'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $rak = $_POST['rak'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        $sql = mysqli_query($db, "INSERT INTO buku(id_buku, judul, pengarang, penerbit, tahun_terbit, id_rak,harga,stok) 
        VALUES ('$id', '$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$rak','$harga','$stok')");

        if ($sql) {
            echo "<script> 
             window.location = 'index.php?p=buku&msg=ok';
             </script>";
        } else {
            echo $db->error;
        }
    }
}

// UPDATE
elseif ($_GET['aksi'] == 'edit_buku') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id_buku'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $rak = $_POST['rak'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        $sql = mysqli_query($db, "UPDATE buku SET judul='$judul', pengarang='$pengarang', penerbit='$penerbit', 
        tahun_terbit='$tahun_terbit', id_rak='$rak' WHERE id_buku='$id'");

        if ($sql) {
            echo "<script>window.location='index.php?p=buku&msg=ok'</script>";
        } else {
            echo $db->error;
        }
    }
}

// DELETE
elseif ($_GET['aksi'] == 'hapus_buku') {
    $id = $_GET['id_hapus'];
    $hapus = mysqli_query($db, "DELETE FROM buku WHERE id_buku='$id'");

    if ($hapus) {
        echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=buku';
            </script>";
    } else {
        echo 'Gagal menghapus data';
    }
}

?>