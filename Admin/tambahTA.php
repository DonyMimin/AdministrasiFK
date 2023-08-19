<?php
session_start();

if ( !isset($_SESSION["login"]) ){
  header("Location: Index.php");
  exit;
}

require 'function.php';
?>


<!DOCTYPE html>
<html>
<head>
  <title>Pendaftaran Ujian Tugas Akhir</title>
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
        <a class="nav-link h4 text-dark" href="TA.php">Kembali <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link h4 text-dark" href="PerpanjanganTA.php">Ke Data Perpanjangan TA</a>
      </li>
    </ul>

    <ul class="nav justify-content-end" >
      <li class="nav-item">
        <a class="nav-link h4 disabled" href="#">Data Ujian Tugas Akhir</a>
      </li>
    </ul>
  </nav>
  <br>
  <header>
    <img src="Assets/Untar_logo_gif.gif" alt="Header Image" class="headerimg">
  </header>
  <div class="alert alert-warning" role="alert">
    Mohon untuk tidak menutup tab agar Isi yang anda masukkan tidak hilang! Harap dapat memerhatikan format pengisian!
  </div>
  <div class="center-box1">
    <div class="container1">
      <h1>Pendaftaran Ujian TA</h1>
      <!-- <h4>Semester Genap 2022/2023 30 Juni s/d 3 Juli 2023</h4> -->
    </div>
    <div class="center-box">
      <form id="myForm" action="" method="post" enctype="multipart/form-data">
      <br>
      <div class="container">
            <div class="form-group">
              <label for="formGroupExampleInput">Nama Mahasiswa - lengkap, sesuai KSM</label>
              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nama Lengkap KSM mu" name="nama" value="<?php echo (isset($_POST['nama']) ? 
              $_POST['nama'] : ''); ?>"  required>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">NIM - lengkap, sesuai KSM</label>
              <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan NIM Lengkap KSM mu" name="nim" value="<?php echo (isset($_POST['nim']) ? 
              $_POST['nim'] : ''); ?>"required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="formGroupExampleInput">Nomor Handphone Aktif</label>
              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Nomor HP mu" name="nomor_hp" value="<?php echo (isset($_POST['nomor_hp']) ? 
              $_POST['nomor_hp'] : ''); ?>" required>
            </div>
      </div>
      <br>
      <div class="container">
        <div class="form-group">
          <label for="exampleInputEmail1">Email - @stu.untar.ac.id</label>
          <input type="email" class="form-control" id="Email" placeholder="Masukkan email UNTAR mu" aria-describedby="emailHelp" name="email" value="<?php echo (isset($_POST['email']) ? 
              $_POST['email'] : ''); ?>" required>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="formGroupExampleInput">Judul Tugas Akhir</label>
              <input type="text" class="form-control" id="Akhir" placeholder="Masukkan Judul Tugas Akhir mu" name="judul_ta" value="<?php echo (isset($_POST['judul_ta']) ? 
              $_POST['judul_ta'] : ''); ?>" required>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Nama Pembimbing - nama, tanpa gelar</label>
              <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Nama Pembimbing tanpa gelar" name="nama_pembimbing" value="<?php echo (isset($_POST['nama_pembimbing']) ? 
              $_POST['nama_pembimbing'] : ''); ?>" required>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Judul Artikel Publikasi</label>
              <input type="text" class="form-control" id="Publikasi" placeholder="Masukkan Judul Artikel Publikasi mu" name="judul_artikel" value="<?php echo (isset($_POST['judul_artikel']) ? 
              $_POST['judul_artikel'] : ''); ?>" required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="exampleFormControlFile1">Silahkan Unggah KSM (format .jpg)</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="ksm" required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="exampleFormControlFile1">Silakan mengunggah logbook bimbingan TA - pdf, cetak dari akun Lintar
              </label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="logbook"  required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="exampleFormControlFile1">Silakan mengunggah lembar persetujuan ujian TA - pdf, ditandatangani pembimbing
              </label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="lembar_persetujuan" required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="exampleFormControlFile1">Silakan mengunggah lembar keterangan publikasi TA - pdf, ditandatangani pembimbing
              </label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="lembar_keterangan" required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="exampleFormControlFile1">Silakan mengunggah naskah TA - docx, halaman depan dan Bab 1-6, nama file NIM_Judul TA
              </label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="naskah_ta" required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="exampleFormControlFile1">Silakan mengunggah artikel publikasi  
                - pdf, nama file NIM_Judul Artikel
              </label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="artikel_publikasi" required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="exampleFormControlFile1">Silakan mengunggah screenshoot tampilan laman OJS atau bukti pengajuan naskah ke OJS <br />- jpg (format .jpg)
              </label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="laman_ojs" required>
            </div>
      </div>
      <br>
      <div class="container">
            <div class="form-group">
              <label for="formGroupExampleInput">Artikel tersebut dipublikasikan dalam jurnal ilmiah <br />- nama jurnal, tahun, volume, nomor, halaman (apabila belum terbit, sebutkan nama jurnal saja)</label>
              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nama Jurnal" name="nama_jurnal" value="<?php echo (isset($_POST['nama_jurnal']) ? 
              $_POST['nama_jurnal'] : ''); ?>" required>
              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Tahun Sekarang" name="tahun" value="<?php echo (isset($_POST['tahun']) ? 
              $_POST['tahun'] : ''); ?>" >
              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Volume" name="volume" value="<?php echo (isset($_POST['volume']) ? 
              $_POST['volume'] : ''); ?>">
              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nomor" name="nomor_jurnal" value="<?php echo (isset($_POST['nomor_jurnal']) ? 
              $_POST['nomor_jurnal'] : ''); ?>">
              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Halaman" name="halaman" value="<?php echo (isset($_POST['halaman']) ? 
              $_POST['halaman'] : ''); ?>">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Url artikel publikasi -  alamat yang langsung mengarah ke laman artikel, <br />bukan ke situs jurnal  (apabila belum terbit, tuliskan tanda '-')
              </label>
              <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan URL/Link yang langsung mengarahkan ke artikelmu" name="url_artikel" value="<?php echo (isset($_POST['url_artikel']) ? 
              $_POST['url_artikel'] : ''); ?>">
            </div>
      </div>
      <br>
      <div class="container">
        <div>
          <label for="formGroupExampleInput">Dengan mengisi formulir ini saya memahami aturan Ujian 
            TA yang berlaku di FK Untar. <br> Apabila terbukti ada pelanggaran kejujuran atau integritas akademik, 
            <br>saya bersedia menerima sanksi berupa pembatalan ujian TA beserta konsekuensinya.
          </label>
          </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
          <label class="form-check-label" for="defaultCheck1">
            Merupakan hasil karya saya yang telah disetujui Pembimbing
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
          <label class="form-check-label" for="defaultCheck1">
            Siap dinilai dan diberikan catatan perbaikan oleh Penguji
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
          <label class="form-check-label" for="defaultCheck1">
            Akan diperbaiki sesuai masukan Penguji
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
          <label class="form-check-label" for="defaultCheck1">
            Naskah TA yang telah diperbaiki akan diunggah sebelum batas waktu yang ditetapkan
          </label>
        </div>
      </div>
      <br>
      <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
      <br>
      <br>
      <br>
    </form>
  </div>
  </div>
</body>
<!-- <script src="TA.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="js/Notification.js"></script>
</html>

<?php

if(isset($_POST["submit"])){
  validationFormTA($_POST);
  if(isset($_SESSION["errMessage"])){
    echo "
      <script>
        showSwal('error','".$_SESSION["errMessage"]."','Gagal')
      </script>
    ";
  } else{
    tambahTA($_POST);
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
          // document.location.href = 'TA.php'
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
