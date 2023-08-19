<?php
session_start();
require 'function.php';

//cookie
if( isset($_COOKIE['hidden1']) && isset($_COOKIE['key']) ){
  $id  = $_COOKIE['hidden1'];
  $key = $_COOKIE['key'];

  //ambil data id
  $result = mysqli_query($db, "SELECT email FROM akunadmin WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

  //validasi cookie & email
  if ($key === hash('sha256', $row['email'])){
    $_SESSION['login'] == true;
    
  }
}

//check already login/not
if ( isset($_SESSION["login"]) ){
  header("Location: Homepage.php");
  exit;
}

//block this index path
if ( !isset($_SESSION["login"]) ){
  header("Location: ../Index.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> -->
  <link rel="stylesheet" type="text/css" href="registerlogin.css">
</head>
<body>
  <div class="center-box">
    <div class="container1" >
      <form id="myForm" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <h4 class="my-2" id="my-element">Login</h4>
          <div class="row">
            <label  for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo
             (isset($_POST['email']) ? 
              $_POST['email'] : ''); ?>" placeholder="Masukkan email mu">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo (isset($_POST['password']) ? 
              $_POST['password'] : ''); ?>" placeholder="Masukkan password" >
          </div>
        </div>
        <div class="form-group form-check">
          <div class="row">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember" >
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
          </div>
        </div>
        <div class="center">
          <a href="Register.php">Don't have an account?</a>    
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="submit" href="Homepage.php">Submit</button>
      </form>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="js/Notification.js"></script>
</html>

<?php

  if(isset($_POST["submit"])){
    validationFormLogin($_POST);
    if(isset($_SESSION["errMessage"])){
      echo "
        <script>
          showSwal('error','".$_SESSION["errMessage"]."','Gagal')
        </script>
      ";
    } 
    else{
      login($_POST);
      if(isset($_SESSION["errMessage"])){
        echo "
          <script>
            showSwal('error','".$_SESSION["errMessage"]."','Gagal')
          </script>
        ";
      } else {
        echo "
          <script>
            showSwal('success','".$_SESSION["successMessage"]."','Berhasil');
            setTimeout(move, 3000)
            function move(){
              document.location.href = 'Homepage.php';
            }
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