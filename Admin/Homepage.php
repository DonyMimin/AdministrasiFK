<?php
//Made by : Dony (535210081) Teknik Informatika

session_start();

if ( !isset($_SESSION["login"]) ){
  header("Location: Index.php");
  exit;
}

// if (isset($_SESSION["username"])) {
//     echo "Username is set: " . $_SESSION["username"];
// } else {
//     echo "Username is not set!";
// }

require 'function.php';

//ambil username
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <style>
    .linklink{
      color: black;
      text-decoration: none;
    }
  </style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="Homepage.css">
  <link rel="stylesheet" type="text/css" href="boxcontainer1.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
<div class="animate__animated animate__backInDown">
  <nav class="navbar navbar-light navbar-expand-lg navbar-light " style="background-color: #cc9d8fe7;">
    <a class="navbar-brand" href="Homepage.php">
      <img src="Assets/Logo-Untar-new.png" width="220" height="60" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link h4" href="#">Dashboard<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle h4" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            Akun
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="logout.php">Log out</a>
            <a class="dropdown-item disabled" href="#">Akun</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle h4" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            Data
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="PerpanjanganTA.php">Pendaftaran Perpanjangan Waktu TA</a>
            <a class="dropdown-item" href="TA.php">Pendaftaran Ujian TA</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item disabled" href="#">Data TA</a>
          </div>
        </li>
      </ul>
      <ul class="nav justify-content-end" >
        <li class="nav-item">
          <b><?php if (isset($username)) {
                  echo "<h1>Welcome, $username!</h1>";
              } else {
                  echo "<h1>Welcome to the Homepage!</h1>";
              } ?>
          </b>
        </li>
      </ul>
    </div>
  </nav>

  <div class="Title-box">Content</div>

  <div class="row-original">
    <div class="left-box code" data-aos="fade-left" data-aos-duration="1500">
      <a class="linklink" href="TA.php">
        <div class="row-1 h2">
            Data Pendaftaran Ujian Tugas Akhir
        </div>
        <div class="row-1 h5">
            Data Pendaftaran Form Mahasiswa Ujian Tugas Akhir
        </div>
      </a>
    </div>
    <div class="right-box code" data-aos="fade-right" data-aos-duration="1500">
      <a class="linklink" href="PerpanjanganTA.php">
        <div class="row-1 h2">
            Data Perpanjangan Tugas Ujian Akhir
        </div>
        <div class="row-1 h5">
            Data Pendaftaran Perpanjangan Form Mahasiswa Ujian Tugas Akhir
        </div>
      </a>
    </div>
  </div>

  <footer data-aos="fade-down" data-aos-duration="1000">
    <p class="title">UNTAR FAKULTAS KEDOKTERAN</p>
    <a href="#">Bantuan</a>
    <a href="#">Tentang Kami</a>
    <hr>
    <p class="copyright">copyright &copy 2023 UNTAR</p>
  </footer>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
  </script>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script type="javascript" src="dist/js/bootstrap.js"></script>
</html>