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
          <h6 class="card-title">Pengunjung Hari ini</h6>
          <?php
            include 'koneksi.php';
            $tanggalNow = date('Ymd');
            $jumlah = 'SELECT id_peminjaman FROM peminjaman WHERE tanggal_peminjaman = '.$tanggalNow;
            $peminjam = mysqli_query($db,$jumlah);
            $jumlahPinjam = mysqli_num_rows($peminjam);
          ?>
          <h2 class="card-text text-center min-height-200">12</h2>
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
          <h6 class="card-title"><?= date(' d M Y')?></h6>
          <h2 class="card-text text-center min-height-200" id="clock"></h2>
        </div>
      </div>
    </div>
  </div>
</div>

      
  </div>
</div>
</body>
