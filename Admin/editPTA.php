<?php
  session_start();

  if ( !isset($_SESSION["login"]) ){
    header("Location: Index.php");
    exit;
  }

  require 'function.php';

  //ambil data id
  $id = $_GET["id"];

  $data = query("SELECT*FROM perpanjanganta WHERE id = $id")[0];
  //var_dump($data['nama']);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Perpanjangan TA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styleTA.css">
</head>
<body>
  <!-- navbar -->
  <nav class="navbar sticky-top nav-tabs  navbar-expand-lg navbar-dark " style="background-color: #cc9d8fe7;">
    <a class="navbar-brand" href="Homepage.php">
      <img src="Assets/Logo-Untar-new.png" width="220" height="60" class="d-inline-block align-top" alt="">
    </a>

    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link h4 text-dark" href="PerpanjanganTA.php">Kembali <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link h4 text-dark" href="TA.php">Ke Data Tugas Akhir</a>
      </li>
    </ul>

    <ul class="nav justify-content-end" >
      <li class="nav-item">
        <a class="nav-link h4 disabled" href="#">Data Perpanjangan Ujian TA</a>
      </li>
    </ul>
  </nav>
  <br>
  <header>
    <img src="Assets/Untar_logo_gif.gif" alt="Header Image" class="headerimg">
  </header>
  <div class="alert alert-warning" role="alert">
    Data yang dimasukkan akan mempengaruhi data asli / ter-edit!
  </div>
  <div class="center-box1">
    <div class="container1">
      <h1>Permohonan Perpanjangan Waktu Penyelesaian TA</h1>
      <!-- <h4>Semester Genap 2022/2023</h4> -->
    </div>
    <?php
      $logbookName = $data["logbook"];
      $formulirName = $data["formulir_perpanjangan"];
      //=============================================
      $logbookLink = "../Data/" . $logbookName;
      $formulirLink = "../Data/" . $formulirName;
    ?>
    <div class="center-box">
    <form id="myForm" action="" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="id" value="<?= $data["id"];?>" >
    <input type="hidden" name="ksmLama" value="<?= $data["ksm"];?>" >
    <input type="hidden" name="logbookLama" value="<?= $data["logbook"];?>" >
    <input type="hidden" name="formulir_perpanjanganLama" value="<?= $data["formulir_perpanjangan"];?>" >
      <br>
      <div class="container">
            <div class="form-group">
              <label for="formGroupExampleInput">Nama Mahasiswa - lengkap, sesuai KSM</label>
              <input type="text" class="form-control" id="formGroupExampleInput" name="nama" value="<?= $data["nama"];?>" placeholder="Masukkan Nama Lengkap KSM mu" required>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">NIM - lengkap, sesuai KSM</label>
              <input type="text" class="form-control" id="formGroupExampleInput2" name="nim" value="<?= $data["nim"]; ?>" placeholder="Masukkan NIM Lengkap KSM mu" required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="formGroupExampleInput">Nomor Handphone Aktif</label>
              <input type="text" class="form-control" id="formGroupExampleInput" name="nomor_hp" value="<?= $data["nomor_hp"]; ?>" placeholder="Masukkan Nomor HP mu" required>
            </div>
      </div>
      <br>
      <div class="container">
        <div class="form-group">
          <label for="exampleInputEmail1">Email - @stu.untar.ac.id</label>
          <input type="email" class="form-control" id="Email" name="email" value="<?= $data["email"]; ?>" placeholder="Masukkan email UNTAR mu" aria-describedby="emailHelp">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="formGroupExampleInput">Judul Tugas Akhir</label>
              <input type="text" class="form-control" id="Akhir" name="judul_ta" value="<?= $data["judul_ta"]; ?>" placeholder="Masukkan Judul Tugas Akhir mu" required>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Nama Pembimbing - nama, tanpa gelar</label>
              <input type="text" class="form-control" id="formGroupExampleInput2" name="nama_pembimbing" value="<?= $data["nama_pembimbing"]; ?>" placeholder="Masukkan Nama Pembimbing tanpa gelar" required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="exampleFormControlFile1">Silahkan Unggah KSM (format .jpg)</label>      
              <input type="file" class="form-control-file" name="ksm" id="exampleFormControlFile1">
              <h1>File sebelumnya :</h1>
              <img src="../Data/<?= $data["ksm"]?>" alt="" width="300">
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="exampleFormControlFile1">Silakan mengunggah logbook bimbingan TA - pdf, cetak dari akun Lintar</label>
              
              <input type="file" class="form-control-file" name="logbook" id="exampleFormControlFile1">
              <h1>File sebelumnya :</h1>
              <a href="<?= $logbookLink ?>"><?= $logbookName ?></a>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="exampleFormControlFile1">Silakan mengunggah Formulir Permohonan Perpanjangan Waktu Penyelesaian TA <br>- pdf, ditandatangani mahasiswa dan Pembimbing 
              </label>         
              <input type="file" class="form-control-file" name="formulir_perpanjangan" id="exampleFormControlFile1">
              <h1>File Sebelumnya : </h1>
              <a href="<?= $formulirLink ?>"><?= $formulirName ?></a>
            </div>
      </div>
      <br>
      <button class="btn btn-primary" type="submit" name="submit">Edit Data</button>
      <br>
      <br>
      <br>
    </form>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="js/Notification.js"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>

<?php

if(isset($_POST["submit"])){
  validationFormPTA($_POST);
  if(isset($_SESSION["errMessage"])){
    echo "
      <script>
        showSwal('error','".$_SESSION["errMessage"]."','Gagal')
      </script>
    ";
  } else{
    editPTA($_POST);
    if(isset($_SESSION["errMessage"])){
      echo "
        <script>
          showSwal('error','".$_SESSION["errMessage"]."','Gagal')
        </script>
      ";
    } else {
      echo "
        <script>
          showSwal('success','".$_SESSION["successMessage"]."','Berhasil')
          // document.location.href = 'PerpanjanganTA.php'
        </script>
      ";
    }
  }
}

$_SESSION["errMessage"] = '';
$_SESSION["successMessage"] = '';
unset($_SESSION["errMessage"]);
unset($_SESSION["successMessage"]);

?> 