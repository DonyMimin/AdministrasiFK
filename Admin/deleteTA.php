<?php
session_start();

if ( !isset($_SESSION["login"]) ){
  header("Location: Index.php");
  exit;
}

require 'function.php';

$id = $_GET["id"];

if( deleteTA($id) > 0){
    echo "<script>
        alert('Data telah dihapus');
        document.location.href = 'TA.php'
        </script>
    ";
  } else{
    echo "<script>
        alert('Data gagal dihapus');
        document.location.href = 'TA.php'
        </script>
    ";
  }
?>