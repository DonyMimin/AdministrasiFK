<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//composer
// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';  

if ( isset($_SESSION["login"]) ){
  header("Location: Homepage.php");
  exit;
}

require 'function.php';
?>


<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> -->
  <link rel="stylesheet" type="text/css" href="registerlogin.css">
</head>
<body>
<div class="center-box">
    <div class="container1" >
      <form id="myForm" action="" method="post">
        <div class="form-group">
        <h4 class="my-2" id="my-element">REGISTER</h4>
          <div class="row">
            <label for="exampleInputPassword1">Username</label>
            <input type="text" class="form-control" id="usernameInput" placeholder="Masukkan Username" name="username" value="<?php echo (isset($_POST['username']) ? 
              $_POST['username'] : ''); ?>" autocomplete="off" >
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <label  for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo (isset($_POST['email']) ? 
              $_POST['email'] : ''); ?>" placeholder="Masukkan email mu" >
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
        <div class="form-group">
          <div class="row">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="confirmpassword" value="<?php echo (isset($_POST['confirmpassword']) ? 
              $_POST['confirmpassword'] : ''); ?>" placeholder="Masukkan password yang sama seperti sebelumnya" >
          </div>
        </div>
        <div class="center">
          <a href="Index.php">Already have an account?</a>    
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="submit" autocomplete="false">Submit</button>
      </form>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="js/Notification.js"></script>
</html>

<?php
  if(isset($_POST["submit"])){
    validationFormRegister($_POST);
    if(isset($_SESSION["errMessage"])){
      echo "
        <script>
          showSwal('error','".$_SESSION["errMessage"]."','Gagal')
        </script>
      ";
    } 
    else{
      echo json_encode($_POST);
      register($_POST);
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
            document.location.href = 'Index.php';
          }
          
        </script>
        ";

        require 'vendor/autoload.php';
        // require 'PHPMailer\PHPMailerAutoload.php';
        $email = $_SESSION['email'];
        $username = $_SESSION['username'];
        $code = $_SESSION['code'];
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'keren.mantapcoi@gmail.com';                     //SMTP username
        $mail->Password   = 'jmwnmnwrogjqfaup';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('keren.mantapcoi@gmail.com', 'Universitas Tarumanagara');
        $mail->addAddress($email);                              // Name is optional
        $mail->Subject = 'Aktivasi Akun | Universitas Tarumanagara';


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->AddEmbeddedImage('Assets/Logo-Untar-new.png', 'logo_untar');
        $mail->Body = '
        <center><img style="max-width:10%;" src="cid:logo_untar">
        <h3>Universitas Tarumanagara</h3>
        <p>Hi, ' . $username . ', anda baru saja mendaftarkan akun FK UNTAR. Sebelum anda mendapatkan izin akses, anda harus mengaktivasi akun anda terlebih dahulu</p>
        <p>Silakan Click verifikasi dibawah ini</p>
        </center>
        <a href="http://localhost/AdministrasiFK/verif.php?code='.$code.'">Verifikasi</a>';
    

        if($mail->send()){
            echo '
                    <script>
                        alert("Email Aktivasi Telah Dikirim Ke Email Anda. Silahkan Cek Email Anda");
                        window.location = "Index.php";
                    </script>
                ';
        }else{
            echo "Gagal";
        }

          
      }
    }
  }

  $_SESSION["errMessage"] = '';
  $_SESSION["successMessage"] = '';
  unset($_SESSION["errMessage"]);
  unset($_SESSION["successMessage"]);
?>