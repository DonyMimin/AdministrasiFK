<?php
require 'function.php';

$code = $_GET['code'];
echo json_encode($code);
if(isset($code)){
    // $result = mysqli_query($db, "SELECT * FROM akunmahasiswa WHERE id = '$code'");
    // $result = mysqli_fetch_assoc($result);

    $result = mysqli_query($db, "UPDATE akunmahasiswa SET is_verif = 1 WHERE email = '".$code."'");
    echo '
        <script>
            alert("Verifikasi Berhasil!");
        </script>
    ';
}

?>