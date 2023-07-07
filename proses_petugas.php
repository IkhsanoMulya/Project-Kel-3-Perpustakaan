<?php
    include 'koneksi.php';
    if($_GET['aksi']=="input_user"){
        if (isset($_POST['submit'])) {
            $id = $_POST['id_petugas'];
            $username = $_POST['username'];
            $nama = $_POST['nama_petugas'];
            $alamat = $_POST['alamat'];
            $no = $_POST['no_telepon'];
            $password=md5($_POST['password']);
            $confirm_password = md5($_POST['confirm_password']);


            if($password == $confirm_password){ 
                // echo $id;
               
                //query
                $sql = mysqli_query($db, "INSERT INTO petugas (id_petugas,nama_petugas,alamat,no_telepon,username,password,level)
                                        VALUES ('$id','$nama','$alamat','$no','$username','$password','staff')
                                   ");
                if ($sql) {
                    echo "
                    <script>
                        window.location = 'index.php?p=petugas&msg=ok';
                    </script>";
                } else {
                    echo "
                    <script>
                        alert('data gagal  disimpan !');
                    </script>";
                }
                
            }
            elseif($password != $confirm_password){
                    echo "
                    <script>
                        alert('Password tidak sama dengan Confirm Password!');
                        document.location.href = 'index.php?p=petugas&page=input';
                        </script>";
                } 
        }
    }

    elseif($_GET['aksi'] == 'edit_user'){
        include 'koneksi.php';
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $nama = $_POST['nama_petugas'];
            $alamat = $_POST['alamat'];
            $no = $_POST['no_telepon'];
            $password=md5($_POST['password']);
            $confirm_password = md5($_POST['confirm_password']);
            

            if($password == $confirm_password){
                //query
                $sql = mysqli_query($db, "UPDATE  petugas  SET
                username = '$username', 
                password = '$password',
                nama_petugas = '$nama',
                alamat = '$alamat',
                no_telepon = '$no'
                WHERE id_petugas = '$_POST[id_petugas]'");

                if ($sql) {
                    echo "
                    <script>
                        window.location = 'index.php?p=petugas';
                    </script>";
                } else {
                    echo "
                    <script>
                        alert('Data Gagal Diubah!');
                    </script>";
                    }

            }elseif($password != $confirm_password){
                echo "
                <script>
                    alert('Password tidak sama dengan Confirm Password!');
                    document.location.href = 'index.php?p=petugas&page=edit&id_edit=$_POST[id]';
                </script>";
            }else{
                //query
                $sql = mysqli_query($db, "UPDATE  petugas  SET
                username = '$username', 
                WHERE id = '$_POST[id]'");
            }
        }
    }

    elseif($_GET['aksi'] == 'hapus_user'){
        $hapus = mysqli_query($db, "DELETE FROM petugas where id = '$_GET[id_hapus]'");

        if($hapus){
            echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=petugas';
            </script>";
        }else {
            echo "
                <script>
                    alert('data gagal  dihapus !');
                </script>";
        }
    }
?>
