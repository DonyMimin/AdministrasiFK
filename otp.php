<?php

require 'function.php';

//ambil email dan username
////////

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//composer
// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

session_start();

// if ( !isset($_SESSION["login"]) ){
//   header("Location: Index.php");
//   exit;
// }

$email = $_GET['email'];
$cekUser = "SELECT email FROM mahasiswa WHERE email = '$email'";
$cekUserQuery = mysqli_query($db,$cekUser);
    if(mysqli_num_rows($cekUserQuery) == 1) {
        //Load Composer's autoloader
        require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.untar.ac.id';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'keren.mantapcoi@gmail.com';                     //SMTP username
        $mail->Password   = 'jmwnmnwrogjqfaup';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('keren.mantapcoi@gmail.com', 'Universitas Tarumanagara');
        $mail->addAddress($email);                              // Name is optional
        $mail->Subject = 'Aktivasi Akun | Universitas Tarumanagara';


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->AddEmbeddedImage('Assets/Logo-Untar-new.png', 'logo_untar');
                $mail->Body    = '
                <center><img style="max-width:10%;" src="cid:logo_untar">
                <h3>Universitas Tarumanagara</h3>
                <p>Hi, '.$username.', anda baru saja mendaftarkan akun FK UNTAR. Sebelum anda mendapatkan izin akses, anda harus mengaktivasi akun anda terlebih dahulu</p>
                <p>Silakan Masukkan Code OTP ini</p>
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
?>