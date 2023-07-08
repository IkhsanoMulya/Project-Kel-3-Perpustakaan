
<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $nama_database = "scientia";

    $db = new mysqli($server, $user, $password);
    
     $create_db_query = "CREATE DATABASE IF NOT EXISTS $nama_database";
     mysqli_query($db, $create_db_query);
    
    mysqli_select_db($db, $nama_database);
       
    $create_prodi = "CREATE TABLE IF NOT EXISTS prodi (
    id_prodi INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama_prodi VARCHAR(50) NOT NULL);";
    mysqli_query($db, $create_prodi);

    
    $create_rak = "CREATE TABLE IF NOT EXISTS rak (
        id_rak INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nama_rak VARCHAR(50) NOT NULL
    );";
    mysqli_query($db, $create_rak);

    
    $create_anggota = "CREATE TABLE IF NOT EXISTS anggota (
        id_anggota CHAR(10) NOT NULL PRIMARY KEY,
        nama_anggota VARCHAR(50) NOT NULL,
        alamat VARCHAR(100) NOT NULL,
        tanggal_lahir DATE NOT NULL,
        no_telepon VARCHAR(20) NOT NULL,
        id_prodi INT,
        FOREIGN KEY (id_prodi) REFERENCES prodi(id_prodi)
    );";
    mysqli_query($db, $create_anggota);

    
    $create_buku = "CREATE TABLE IF NOT EXISTS buku (
        id_buku CHAR(13) NOT NULL PRIMARY KEY,
        judul VARCHAR(100) NOT NULL,
        pengarang VARCHAR(50) NOT NULL,
        penerbit VARCHAR(50) NOT NULL,
        tahun_terbit INT NOT NULL,
        id_rak INT,
        harga INT,
        stok INT,
        FOREIGN KEY (id_rak) REFERENCES rak(id_rak)
    );";
    mysqli_query($db, $create_buku);

    $create_petugas = "CREATE TABLE IF NOT EXISTS petugas (
        id_petugas CHAR(5) NOT NULL PRIMARY KEY,
        nama_petugas VARCHAR(50) NOT NULL,
        alamat VARCHAR(100) NOT NULL,
        no_telepon VARCHAR(20) NOT NULL,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        level VARCHAR(10) NOT NULL
    );";
    mysqli_query($db, $create_petugas);
    
    
    $create_peminjaman = "CREATE TABLE IF NOT EXISTS peminjaman (
        id_peminjaman CHAR(12) NOT NULL PRIMARY KEY,
        id_anggota CHAR(10) NOT NULL,
        tanggal_peminjaman DATE NOT NULL,
        tanggal_pengembalian DATE NOT NULL,
        id_petugas CHAR(5) NOT NULL,
        status BOOLEAN NOT NULL,
        FOREIGN KEY (id_petugas) REFERENCES petugas(id_petugas),
        FOREIGN KEY (id_anggota) REFERENCES anggota(id_anggota)
    );";
    mysqli_query($db, $create_peminjaman);
    
    $create_pengembalian = "CREATE TABLE IF NOT EXISTS pengembalian (
        id_pengembalian CHAR(12) NOT NULL PRIMARY KEY,
        id_peminjaman CHAR(12) NOT NULL,
        tanggal_pengembalian DATE NOT NULL,
        denda INT NOT NULL,
        id_petugas CHAR(5) NOT NULL,
        FOREIGN KEY (id_petugas) REFERENCES petugas(id_petugas),
        FOREIGN KEY (id_peminjaman) REFERENCES peminjaman(id_peminjaman)    
    );";
    mysqli_query($db, $create_pengembalian);
    
   
    $create_detail = "CREATE TABLE IF NOT EXISTS detail_peminjaman (
        id_peminjaman CHAR(12) NOT NULL,
        id_buku CHAR(13) NOT NULL,
        PRIMARY KEY (id_peminjaman, id_buku)
    );";
    mysqli_query($db, $create_detail);
    
    $create_absensi = "CREATE TABLE IF NOT EXISTS absensi (
        id_absen INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        id_anggota CHAR(10) NOT NULL,
        tanggal DATE NOT NULL,
        waktu TIME NOT NULL,
        FOREIGN KEY (id_anggota) REFERENCES anggota(id_anggota)
    );";
    mysqli_query($db, $create_absensi);
       
        
        $exists_user = "SELECT * from petugas";
        $result = mysqli_query($db, $exists_user);
        $rowcount = mysqli_num_rows( $result );
        if($rowcount == 0 ){
            $input_user_admin = ("INSERT INTO petugas(id_petugas,nama_petugas,username,password,level)
                            VALUES ('P0000','admin','admin',MD5('password'),'admin')");
        mysqli_query($db, $input_user_admin);
        }
        
   
?>
