<?php

session_start();

if (!isset($_SESSION['user']) && !isset($_SESSION['id_login'])) {
    header('location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Scientia</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body style="background-image: url('./img/Artboard.png'); background-size: cover;">
<header class=" navbar navbar-dark sticky-top flex-md-nowrap p-0 ">
  <div  class="text-bg-dark navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-8 ">
    <a href="index.php?p=home " class="text-decoration-none text-light">  
    <img src="./img/LOGO.png" alt="logo" width="50">
      SCIENTIA
    </a>
  </div>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</header>

<div class="container-fluid ">
  <div class="row ">
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse shadow rounded">
  <div class="position-sticky pt-3 sidebar-sticky text-bg-dark position-sticky pt-3 sidebar-sticky text-bg-dark d-flex justify-content-center">
    <ul class="nav flex-column mt-2 ">
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['p']) && $_GET['p'] === 'home'){ echo 'active'; }else if((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'input'){ echo 'disabled';}; ?> " aria-current="page" href="index.php?p=home">
          <span data-feather="home"></span>
          Home
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if ((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'list'){ echo 'active'; }else if((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'input'){ echo 'active disabled';}; ?> " href="index.php?p=peminjaman&page=list">
          <span data-feather="arrow-down-circle"></span>
          Peminjaman
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['p']) && $_GET['p'] === 'pengembalian' || $_GET['p'] === 'kembali'){ echo 'active'; }else if((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'input'){ echo 'disabled';}; ?> " href="index.php?p=pengembalian">
          <span data-feather="arrow-up-circle"></span>
          Pengembalian
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['p']) && $_GET['p'] === 'buku'){ echo 'active'; }else if((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'input'){ echo 'disabled';}; ?> " href="index.php?p=buku">
          <span data-feather="book"></span>
          Buku
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['p']) && $_GET['p'] === 'anggota'){ echo 'active'; }else if((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'input'){ echo 'disabled';}; ?> " href="index.php?p=anggota">
          <span data-feather="users"></span>
          Anggota
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['p']) && $_GET['p'] === 'absensi'){ echo 'active'; }else if((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'input'){ echo 'disabled';}; ?> " href="index.php?p=absensi">
          <span data-feather="bookmark"></span>
          Absensi
        </a>
      </li>
      <?php
        if ($_SESSION['level'] == 'admin') {
  
      ?>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['p']) && $_GET['p'] === 'prodi'){ echo 'active'; }else if((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'input'){ echo 'disabled';}; ?> " href="index.php?p=prodi">
          <span data-feather="hexagon"></span>
          Prodi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['p']) && $_GET['p'] === 'petugas'){ echo 'active'; }else if((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'input'){ echo 'disabled';}; ?> " href="index.php?p=petugas">
          <span data-feather="user"></span>
          Petugas
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if (isset($_GET['p']) && $_GET['p'] === 'rak'){ echo 'active'; }else if((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'input'){ echo 'disabled';}; ?> " href="index.php?p=rak">
          <span data-feather="columns"></span>
          Rak
        </a>
      </li>

      <?php
        }
      ?>
      
      <li class="fixed-bottom d-flex align-items-center ms-5 mb-3">
        <a class="nav-link px-3 text-bg-dark <?php if (isset($_GET['p']) && $_GET['p'] === 'logout'){ echo 'active'; }else if((isset($_GET['p']) && $_GET['p'] === 'peminjaman') && isset($_GET['page']) && $_GET['page'] === 'input'){ echo 'disabled';}; ?>" href="logout.php">
          <span data-feather="log-out"></span>
          Sign Out
        </a>
      </li>
    </ul>
  </div>
  
</nav>
    
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" >
      

      <?php
          include 'koneksi.php';
          $p=isset($_GET['p']) ?$_GET['p'] : 'home';
          if($p=='home') include'home.php';
          if ($p=='anggota') include'anggota.php';
          if ($p=='peminjaman') include'peminjaman.php';
          if ($p=='pengembalian') include'pengembalian.php';
          if ($p=='absensi') include'absensi.php';
          if ($p=='detail') include'detail_peminjaman.php';
          if ($p=='kembali') include'detail_pengembalian.php';
          
          if ($p=='petugas') include'petugas.php';
          if ($p=='prodi') include'prodi.php';
          if ($p=='rak') include'rak.php';
          if ($p=='buku') include'buku.php';
         
        ?>
    </main>
  </div>
</div>
<script src="js/bootstrap.bundle.min.js"> </script>
<script src="js/feather.min.js"> </script>
<script>
  feather.replace({ 'aria-hidden': 'true' })
</script>
</body>
</html>