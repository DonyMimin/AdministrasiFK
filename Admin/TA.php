<?php
session_start();

if ( !isset($_SESSION["login"]) ){
  header("Location: Index.php");
  exit;
}

require 'function.php';
$TA = query("SELECT * FROM ujianta ORDER BY nama");

//search
if(isset($_POST["search"])){
    $TA = searchTA($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Ujian TA</title>
  <style>
      #loader{
        display: none;
      }
  </style>
  <script type="text/javascript" src = js/jquery-3.7.0.js></script>
  <script type="text/javascript" src = js/scriptTA.js></script>
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
          <a class="nav-link h4 text-dark" href="tambahTA.php">Tambah Data <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link h4 text-dark" href="PerpanjanganTA.php">Ke Data Perpanjangan TA</a>
        </li>
      </ul>

      <ul class="nav justify-content-end" >
        <li class="nav-item">
          <a class="nav-link h4 disabled" href="#">Data Ujian TA</a>
        </li>
      </ul>
    </div>
  </nav>
  <br>
    <div class="container">
    <h1>Data Ujian TA</h1>
    <br><br>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="tambahTA.php">Tambah data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="PerpanjanganTA.php">Ke Data Permohonan Perpanjangan Tugas Akhir</a>
            </li>
            <a href="export-excel-TA.php" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i>Excel</a>
            <li class="nav-item">
              <a class="nav-link" href=#></a>
            </li>
            <form class="form-inline my-2 my-lg-0" action="" method="post">
              <input class="form-control mr-sm-3" type="search" placeholder="Masukkan keyword yang ingin dicari" aria-label="Search"
              name="keyword" autocomplete="off" size="20" id="keyword" autofocus>
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search" id="tombol-cari" >Cari</button>
            
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
        <th scope="col">Lembar persetujuan</th>
        <th scope="col">Lembar keterangan</th>
        <th scope="col">Naskah TA</th>
        <th scope="col">Artikel Publikasi</th>
        <th scope="col">Laman OJS</th>
        <th scope="col">Nama Jurnal</th>
        <th scope="col">Tahun Jurnal</th>
        <th scope="col">Volume Jurnal</th>
        <th scope="col">Nomor Jurnal</th>
        <th scope="col">Halaman Jurnal</th>
        <th scope="col">URL artikel</th>
        </tr>
    </thead>
    <tbody class="content_table">
        <?php $i = 1 ?>
        <?php foreach($TA as $row) : ?>
        <?php
          $logbookName = $row["logbook"];
          $lembar_persetujuanName = $row["lembar_persetujuan"];
          $lembar_keteranganName = $row["lembar_keterangan"];
          $naskah_taName = $row["naskah_ta"];
          $artikel_publikasiName = $row["artikel_publikasi"];
          //============================================================
          $logbookLink = "../Data/" . $logbookName;
          $lembar_persetujuanLink = "../Data/" . $lembar_persetujuanName;
          $lembar_keteranganLink = "../Data/" . $lembar_keteranganName;
          $naskah_taLink = "../Data/" . $naskah_taName;
          $artikel_publikasiLink = "../Data/" . $artikel_publikasiName;
        ?>
        <tr>
        <th scope="row"><?= $i; ?></th>
        <td>
            <a href="editTA.php?id=<?= $row["id"] ?>">ubah</a>
            <a href="deleteTA.php?id=<?= $row["id"]; ?>" onclick="
            return confirm('Anda yakin ingin menghapus?')" >hapus</a>
        </td>
        <td><?= $row["nama"] ?></td>
        <td><?= $row["nim"] ?></td>
        <td><?= $row["nomor_hp"] ?></td>
        <td><?= $row["email"] ?></td>
        <td><?= $row["judul_ta"] ?></td>
        <td><?= $row["nama_pembimbing"] ?></td>
        <td><img src="../Data/<?= $row["ksm"] ?>" width="100" ></td>
        <td><a href="<?= $logbookLink ?>"><?= $logbookName ?></td>
        <td><a href="<?= $lembar_persetujuanLink ?>"><?= $lembar_persetujuanName ?></td>
        <td><a href="<?= $lembar_keteranganLink ?>"><?= $lembar_keteranganName ?></td>
        <td><a href="<?= $naskah_taLink ?>"><?= $naskah_taName ?></td>
        <td><a href="<?= $artikel_publikasiLink ?>"><?= $artikel_publikasiName ?></td>
        <td><img src="../Data/<?= $row["laman_ojs"] ?>" width="100"></td>
        
        <td><?= $row["nama_jurnal"] ?></td>
        <td><?= $row["tahun"] ?></td>
        <td><?= $row["volume"] ?></td>
        <td><?= $row["nomor_jurnal"] ?></td>
        <td><?= $row["halaman"] ?></td>
        <td><?= $row["url_artikel"] ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>
</div>
</body>
</html>