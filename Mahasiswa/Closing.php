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
  <title>Terima Kasih</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styleTA.css">
</head>
<body>
  <div class="center-box1">
    <div class="container1">
      <h1>Terima kasih telah mengisi</h1>
      <h4>Mohon untuk mengisi kuesioner berikut</h4>
      <a href="https://bit.ly/KuesionerUTAJul23">Kuesioner kandidat ujian Tugas Akhir</a>
    </div>
  </div>
</body>
<script src="TA.js"></script>
</html>
