<?php
    include 'koneksi.php';
    if($_GET['aksi']=="input_prd"){
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            

            //query
            $sql = mysqli_query($db, "INSERT INTO prodi (nama_prodi)
                                    VALUES ('$nama')
                                ");
            if ($sql) {
                echo "
                <script>
                    window.location = 'index.php?p=prodi&msg=ok';
                </script>";
            } else {
                echo "
                <script>
                    alert('data gagal  disimpan !');
                </script>";
            }
        }
    }

    elseif($_GET['aksi'] == 'edit_prodi'){
        include 'koneksi.php';
        if (isset($_POST['submit'])) {

            //query
            $sql = mysqli_query($db, "UPDATE  prodi  SET
            nama_prodi = '$_POST[nama]'
            WHERE id_prodi = '$_POST[id]'");

        if ($sql) {
            echo "
            <script>
                window.location = 'index.php?p=prodi';
            </script>";
        } else {
            echo "
            <script>
                alert('Data Gagal Diubah!');
            </script>";
            }
        }
    }

    elseif($_GET['aksi'] == 'hapus_prd'){
        $id = $_GET['id_hapus'];
        $child = mysqli_query($db,"SELECT id_prodi FROM anggota WHERE id_prodi ='$id'");
        $bisa = mysqli_num_rows($child);
        
        if ($bisa == 0 ) {
            $hapus = mysqli_query($db, "DELETE FROM prodi WHERE id_prodi='$id'");
            echo "<script>
                alert('Data Berhasil Dihapus !');
                window.location = 'index.php?p=prodi';
                </script>";
        } else if($bisa > 0){
            echo "
                <script>
                    alert('Masih Ada Anggota di Prodi Ini!');
                    window.location = 'index.php?p=prodi';
                </script>";
        }else{
            echo "
                <script>
                    alert('Data Gagal Dihapus');
                    window.location = 'index.php?p=prodi';
                </script>";
        }
    }
?>