<?php

session_start();

if ( !isset($_SESSION["login"]) ){
  header("Location: Index.php");
  exit;
}

require 'function.php';
$perpanjanganTA = query("SELECT * FROM perpanjanganta ORDER BY nama");

//search
if(isset($_POST["search"])){
  $perpanjanganTA = searchPTA($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Perpanjangan TA</title>
  <script type="text/javascript" src = js/jquery-3.7.0.js></script>
  <script type="text/javascript" src = js/scriptPTA.js></script>
  <link rel="stylesheet" type="text/css" href="TA.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
  <!-- navbar -->
  <nav class="navbar sticky-top nav-tabs  navbar-expand-lg navbar-dark " style="background-color: #cc9d8fe7;">
    <a class="navbar-brand" href="Homepage.php">
      <img src="Assets/Logo-Untar-new.png" width="220" height="60" class="d-inline-block align-top" alt="">
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link h4 text-dark" href="tambahPTA.php">Tambah Data <span class="sr-only">(current)</span></a>
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
    </div>
  </nav>
  <br>

  <div class="container">
    <h1>Data Permohonan Perpanjangan Waktu Penyelesaian TA</h1>
    <style>
      #loader{
        display: none;
      }
    </style>
      <br><br>
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link active" href="tambahPTA.php">Tambah data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="TA.php">Ke data Tugas Akhir</a>
      </li>
      <a href="export-excel-PTA.php" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i>Excel</a>
      <li class="nav-item">
        <a class="nav-link" href=#></a>
      </li>
      <form class="form-inline my-2 my-lg-0" action="" method="post">
        <input class="form-control mr-sm-3" type="search" placeholder="Masukkan keyword yang ingin dicari" aria-label="Search"
        name="keyword" autocomplete="off" size="20" id="keyword" autofocus>
        <button class="btn btn-outline-success my-2 my-sm-0  " type="submit" name="search" id="tombol-cari" >Cari</button>
        <div class="spinner-border text-secondary" id="loader" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </form>
      
    </ul>
  </div>
  <br><br>
  <div id="container">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Aksi</th>
          <th scope="col">Nama</th>
          <th scope="col">nim</th>
          <th scope="col">nomor_hp</th>
          <th scope="col">email</th>
          <th scope="col">judul_TA</th>
          <th scope="col">Nama_Pembimbing</th>
          <th scope="col">KSM</th>
          <th scope="col">logbook</th>
          <th scope="col">Formulir perpanjangan waktu</th>
        </tr>
      </thead>
      <tbody class="content_table">
        <?php $i = 1 ?>
        <?php foreach($perpanjanganTA as $row) : ?>
          <?php
            $logbookName = $row["logbook"];
            $formulirName = $row["formulir_perpanjangan"];
            //============================================
            $logbookLink = "../Data/" . $logbookName;
            $formulirLink = "../Data/" . $formulirName;
          ?>
          <tr>
            <th scope="row"><?= $i; ?></th>
            <td>
              <a href="editPTA.php?id=<?= $row["id"] ?>">ubah</a>
              <a href="deletePTA.php?id=<?= $row["id"] ?>" onclick="
              return confirm('Anda yakin ingin menghapus?')">hapus</a>
            </td>
            <td><?= $row["nama"] ?></td>
            <td><?= $row["nim"] ?></td>
            <td><?= $row["nomor_hp"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["judul_ta"] ?></td>
            <td><?= $row["nama_pembimbing"] ?></td>
            <td><img src="../Data/<?= $row["ksm"] ?>" width="100" ></td>
            <td><a href="<?= $logbookLink ?>"><?= $logbookName ?></a> </td>
            <td><a href="<?= $formulirLink ?>"><?= $formulirName ?></a> </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
</div>

</body>
</html>
