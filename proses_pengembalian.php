<?php
    // CREATE
    include 'koneksi.php';
if ($_GET['aksi'] == 'input_peng') {
    if (isset($_POST['submit'])) {
        $idK = $_POST['id_pengembalian'];
        $idP = $_POST['id_peminjaman'];
        $id_petugas = $_POST['id_petugas'];
        $HR = isset($_POST['bayar']) ? $_POST['bayar'] : '';
        $query = mysqli_query($db,"SELECT tanggal_pengembalian FROM peminjaman WHERE id_peminjaman = '$idP'");
        $tanggalHarusnya = mysqli_fetch_assoc($query);  
        
        $kembali =$tanggalHarusnya['tanggal_pengembalian'];
        $tanggal_pengembalian = $_POST['tgl_kembali'];
        $formatDate1 = new DateTime($kembali);
        $formatDate2 = new DateTime($tanggal_pengembalian);

       

        $cekBuku = mysqli_query($db,"SELECT id_buku FROM detail_peminjaman WHERE id_peminjaman = '$idP'");
        $sudahBuku = mysqli_num_rows($cekBuku);

        $dendaHarian = 1000*$sudahBuku;

        $hilang_rusak = 0;
        if (isset($_POST['bayar'])) {
           
            foreach ($HR as $id) {
                $harga = mysqli_query($db,"SELECT harga FROM buku WHERE id_buku = '$id'");
                $nominal = mysqli_fetch_assoc($harga);
                $hilang_rusak = $hilang_rusak + $nominal['harga'];
            }
        }


        if ($formatDate2 > $formatDate1) {
            $selisih = $formatDate1->diff($formatDate2);
            $jumlahHari = $selisih->format("%a");
            $denda = $dendaHarian*$jumlahHari;
        }else{
            $denda=0;
        }

        
        $total = $hilang_rusak+$denda;
        
        $sql = mysqli_query($db, "INSERT INTO pengembalian(id_pengembalian,id_peminjaman,id_petugas,tanggal_pengembalian,denda) 
        VALUES ('$idK', '$idP', '$id_petugas','$tanggal_pengembalian','$total')");

        if ($sql) {
           mysqli_query($db,"UPDATE peminjaman SET status = 0 WHERE id_peminjaman = '$idP'");
           if (isset($_POST['bayar'])) {
               while ( $idBuku = mysqli_fetch_assoc($cekBuku)) {
                    if (in_array($idBuku['id_buku'], $HR)) {
                        mysqli_query($db,"UPDATE detail_peminjaman SET hilang_rusak = 1 WHERE id_buku = '$idBuku[id_buku]' AND id_peminjaman = '$idP'");
                    }else{
                        $harga = mysqli_query($db,"UPDATE buku SET stok = stok+1 WHERE id_buku = '$idBuku[id_buku]'");
                    }
                }
           }else{
                while ( $idBuku = mysqli_fetch_assoc($cekBuku)) {
                    $harga = mysqli_query($db,"UPDATE buku SET stok = stok+1 WHERE id_buku = '$idBuku[id_buku]'");
                }
           }
           

            echo "<script> 
             window.location = 'index.php?p=pengembalian&msg=yes';
             </script>";
        } else {
            echo "<script> 
             window.location = 'index.php?p=pengembalian&msg=no';
             </script>";
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
            echo "<script>window.location='index.php?p=peminjaman&msg=yes'</script>";
        } else {
            echo "<script>window.location='index.php?p=peminjaman&msg=no'</script>";
        }
    }
}

// DELETE
elseif ($_GET['aksi'] == 'hapus_pem') {
    $id = $_GET['id_hapus'];
    $hapus = mysqli_query($db, "DELETE FROM peminjaman WHERE id='$id'");

    if ($hapus) {
        echo "<script>
            document.location.href = 'index.php?p=peminjaman&msg=del';
            </script>";
    } else {
        echo "<script>
        document.location.href = 'index.php?p=peminjaman&msg=delno';
        </script>";
    }
}

?>