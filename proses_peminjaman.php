<?php
    // CREATE
    include 'koneksi.php';
if ($_GET['aksi'] == 'input_pem') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id_peminjaman'];
        $id_anggota = $_POST['id_anggota'];
        $id_petugas = $_POST['id_petugas'];
        $tanggal_peminjaman = $_POST['tgl_pinjam'];
        $tanggal_pengembalian = $_POST['tgl_kembali'];

        $sql = mysqli_query($db, "INSERT INTO peminjaman(id_peminjaman, id_anggota, id_petugas, tanggal_peminjaman, tanggal_pengembalian) 
        VALUES ('$id', '$id_anggota', '$id_petugas', '$tanggal_peminjaman', '$tanggal_pengembalian')");

        if ($sql) {
            echo "<script> 
             window.location = 'index.php?p=peminjaman&msg=ok';
             </script>";
        } else {
            echo $db->error;
        }
    }
}

// UPDATE
elseif ($_GET['aksi'] == 'edit_pem') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $id_anggota = $_POST['id_anggota'];
        $id_petugas = $_POST['id_petugas'];
        $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];

        $sql = mysqli_query($db, "UPDATE peminjaman SET id_anggota='$id_anggota', id_petugas='$id_petugas', 
        tanggal_peminjaman='$tanggal_peminjaman', tanggal_pengembalian='$tanggal_pengembalian' WHERE id='$id'");

        if ($sql) {
            echo "<script>window.location='index.php?p=peminjaman&msg=ok'</script>";
        } else {
            echo $db->error;
        }
    }
}

// DELETE
elseif ($_GET['aksi'] == 'hapus_pem') {
    $id = $_GET['id_hapus'];
    $hapus = mysqli_query($db, "DELETE FROM peminjaman WHERE id='$id'");

    if ($hapus) {
        echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=peminjaman';
            </script>";
    } else {
        echo 'Gagal menghapus data';
    }
}

?>