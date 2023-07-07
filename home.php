<head>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body onload="updateClock()">
<div class="container">
  <div class="row">
    <h2 class="text-center mb-4">Selamat Membaca</h2>
    <div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="card text-white bg-danger mb-3 shadow rounded">
        <div class="card-body">
          <?php
            include 'koneksi.php';
            $tanggalNow = date('Ymd');
            $pengunjung = 'SELECT id_anggota FROM absensi WHERE tanggal = '.$tanggalNow;
            $query = mysqli_query($db,$pengunjung);
            $jumlahPengunjung = mysqli_num_rows($query);
            
            $jumlah = 'SELECT id_peminjaman FROM peminjaman WHERE tanggal_peminjaman = '.$tanggalNow;
            $peminjam = mysqli_query($db,$jumlah);
            $jumlahPinjam = mysqli_num_rows($peminjam);
          ?>
          <h6 class="card-title">Pengunjung Hari ini</h6>
          <h2 class="card-text text-center min-height-200"><?= $jumlahPengunjung?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-dark bg-warning mb-3 shadow rounded">
        <div class="card-body ">
          <h6 class="card-title">Peminjaman Hari Ini</h6>
          <h2 class="card-text text-center min-height-200"><?= $jumlahPinjam?></h2>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    function updateClock() {
      var currentTime = new Date();
      var hours = currentTime.getHours();
      var minutes = currentTime.getMinutes();
      var seconds = currentTime.getSeconds();

      // Menambahkan nol di depan jam, menit, dan detik jika angka < 10
      hours = (hours < 10 ? "0" : "") + hours;
      minutes = (minutes < 10 ? "0" : "") + minutes;
      seconds = (seconds < 10 ? "0" : "") + seconds;

      var timeString = hours + ":" + minutes + ":" + seconds;

      document.getElementById("clock").innerHTML = timeString;
      setTimeout(updateClock, 1000); // Mengupdate setiap detik (1000ms)
    }
  </script>
    <div class="col-md-4">
      <div class="card text-white bg-success mb-3 shadow rounded">
        <div class="card-body">
          <h6 class="card-title"><?= date(' D, d M Y')?></h6>
          <h2 class="card-text text-center min-height-200" id="clock"></h2>
        </div>
      </div>
    </div>
    <?php
            $pesan=isset($_GET['msg']) ? $_GET['msg'] : '';
            if ($pesan =='yes'){
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Absen Tersimpan!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            }else if($pesan == 'no'){
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Absen Gagal!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
          }
        ?>
    
    <div class="col-md-5">
        <form action="" method="post">

            <div class="mb-3">
              <label class="form-label" for="absen">Absensi</label>
              <input type="text" class="form-control" name="absen" pattern="[0-9]*" maxlength="10" required>
            </div>

            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            <input type="reset" class="btn btn-secondary" name="reset" value="Reset">
        </form>

        <?php
          if (isset($_POST['submit'])) {
              $anggota = $_POST['absen'];
              $absen = mysqli_query($db,"INSERT INTO absensi(id_anggota,tanggal,waktu) VALUES ('$anggota',DATE(NOW()),NOW());");

              if ($absen) {
                echo "<script>
                window.location = 'index.php?p=home&msg=yes';
                </script>";
              }else{
                echo "<script>
                  window.location = 'index.php?p=home&msg=no';
                  </script>";
              }
          }
        ?>
    </div>
    
  </div>
</div>

      
  </div>
</div>
</body>
