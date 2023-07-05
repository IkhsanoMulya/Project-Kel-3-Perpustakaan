<?php
    include 'koneksi.php';
    if($_GET['p']=="input_prd"){
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

    elseif($_GET['p'] == 'edit_prodi'){
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

    elseif($_GET['p'] == 'hapus_prd'){
        $hapus = mysqli_query($db, "DELETE FROM prodi where id_prodi = '$_GET[id_hapus]'");

        if($hapus){
            echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=prodi';
            </script>";
        }
    }
?>