<?php

$db = mysqli_connect("Localhost", "root", "", "administrasifk");

function query($query){
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function validationFormPTA($data){
    // echo json_encode($data);
    $defaultEmail = "@stu.untar.ac.id";
    if(!str_ends_with($data['email'], $defaultEmail)){
        $_SESSION["errMessage"] = "Email harus diakhiri dengan @stu.untar.ac.id";
    } else{
        $_SESSION["successMessage"] = "validation success";
    }
}

function validationFormTA($data){
    // echo json_encode($data);
    $defaultEmail = "@stu.untar.ac.id";
    if(!str_ends_with($data['email'], $defaultEmail)){
        $_SESSION["errMessage"] = "Email harus diakhiri dengan @stu.untar.ac.id";
    } else {
        if($data['judul_ta'] == $data['judul_artikel']){
            $_SESSION["errMessage"] = "Judul Tugas Akhir dan Judul Artikel Publikasi tidak boleh sama!";
        } else {
            $_SESSION["successMessage"] = "validation success";
        }
    } 
}

function validationFormRegister($data){
    // echo json_encode($data);
    if($data['username'] == "" || $data['email'] == "" || $data['password'] == "" || $data['confirmpassword'] == ""){
        $_SESSION["errMessage"] = "Data tidak lengkap";
    } else {
        if($data['password'] !== $data['confirmpassword']){
            $_SESSION["errMessage"] = "Password tidak sama";
        } else {
            $_SESSION["successMessage"] = "Registrasi berhasil, Halaman mu akan diahlikan beberapa saat";
        }
    } 
}

function validationFormLogin($data){
    if($data['email'] == "" || $data['password'] == ""){
        $_SESSION["errMessage"] = "Data tidak lengkap";
    }
}

function register($data){
    global $db;

    $username = stripcslashes(htmlspecialchars($data["username"]));
    $email = htmlspecialchars($data["email"]);
    $password = mysqli_real_escape_string($db , $data["password"]);

    //samarkan password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //validasi akun
    $result = mysqli_query($db, "SELECT email FROM akunadmin
            WHERE email = '$email'");

    if (mysqli_fetch_assoc($result)){
        $_SESSION["errMessage"] = "Email sudah terdaftar!";
        return false;
    }

    //query insert data
    $query = "INSERT INTO akunadmin VALUES 
            ('', '$username','$email','$password')";

    mysqli_query($db, $query);

    if(mysqli_affected_rows($db)>0){
        $_SESSION["successMessage"] = "Data Berhasil Ditambahkan, Halaman mu akan diahlikan beberapa saat";
    } else {
        $_SESSION["errMessage"] = "Data Tidak Berhasil Ditambahkan. Mohon Coba lagi";
    }

}

function login($data){
    global $db;
    // $username = $_POST['username'];
    $email = $_POST['email'];
    $password= $_POST['password'];
    // echo json_encode($_POST);

    //validasi akun
    $result = mysqli_query($db, "SELECT * FROM akunadmin WHERE email = '$email'");

    //validation account
    echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) === 1){
        $account = mysqli_fetch_assoc($result);
        if (password_verify($password, $account['password'])){
            //must be login first
            $_SESSION["login"] = true;
            $_SESSION['username'] = $account['username'];

            //remember me (cookies)
            if (isset($_POST['remember'])){
                setcookie('hidden1', $account['id'], time()+108000);
                setcookie('key', hash('sha256', $account['email'],time()+108000));
            }

            $_SESSION["successMessage"] = "Login Berhasil, Halaman akan diahlikan beberapa saat";
        } else {
            $_SESSION["errMessage"] = "Email atau password salah!";
        }
    } else {
        $_SESSION["errMessage"] = "Email atau password salah!";
    }
    
    // echo json_encode($data);
} 

function tambahPTA($data){
    global $db;
    // $_POST["ksm"] = $_FILES["ksm"];
    $_POST["logbook"] = $_FILES["logbook"];
    $_POST["formulir_perpanjangan"] = $_FILES["formulir_perpanjangan"];

    $nama = htmlspecialchars($_POST["nama"]);
    $nim = htmlspecialchars($_POST["nim"]);
    $nomor_hp = htmlspecialchars($_POST["nomor_hp"]);
    $email = htmlspecialchars($_POST["email"]);
    $judul_ta = htmlspecialchars($_POST["judul_ta"]);
    $nama_pembimbing = htmlspecialchars($_POST["nama_pembimbing"]);
    // $ksm = htmlspecialchars($_POST["ksm"]);
    // $logbook = htmlspecialchars($_POST["logbook"]);
    // $formulir_perpanjangan = htmlspecialchars($_POST["formulir_perpanjangan"]);


    //upload
    $ksm = uploadimage('ksm');
    if( !$ksm ){
        return $_SESSION["errMessage"]="Data gagal dimasukkan pada ksm";
    } else {
        $logbook = uploadpdf('logbook');
        if (!$logbook) {
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada logbook";
        } else {
            $formulir_perpanjangan = uploadpdf('formulir_perpanjangan');
            if (!$formulir_perpanjangan){
                return $_SESSION["errMessage"]="Data gagal dimasukkan pada formulir_perpanjangan";
            }
        }
    }
    
    
    //query insert data
    $query = "INSERT INTO perpanjanganta VALUES 
    ('', '$nama','$nim','$nomor_hp','$email','$judul_ta',
    '$nama_pembimbing', '$ksm','$logbook', '$formulir_perpanjangan' )
    ";

    mysqli_query($db, $query);

    if(mysqli_affected_rows($db)>0){
        $_SESSION["successMessage"] = "Data Berhasil Ditambahkan";
    } else {
        $_SESSION["errMessage"] = "Data Tidak Berhasil Ditambahkan. Mohon Coba lagi";
    }
}

function tambahTA($data){
    global $db;

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $nomor_hp = $_POST['nomor_hp'];
    $email = $_POST['email'];
    $judul_ta = $_POST['judul_ta'];
    $nama_pembimbing = $_POST['nama_pembimbing'];
    $judul_artikel = $_POST['judul_artikel'];

    // $ksm = $_POST['ksm'];
    // $logbook = $_POST['logbook'];
    // $lembar_persetujuan = $_POST['lembar_persetujuan'];
    // $lembar_keterangan = $_POST['lembar_keterangan'];
    // $naskah_ta = $_POST['naskah_ta'];
    // $artikel_publikasi = $_POST['artikel_publikasi'];
    // $laman_ojs = $_POST['laman_ojs'];

    $nama_jurnal = $_POST['nama_jurnal'];
    $tahun = $_POST['tahun'];
    $volume = $_POST['volume'];
    $nomor_jurnal = $_POST['nomor_jurnal'];
    $halaman = $_POST['halaman'];
    $url_artikel = $_POST['url_artikel'];
    
    //upload
    
    $ksm = uploadimage('ksm');
    if( !$ksm  ){
        return $_SESSION["errMessage"]="Data gagal dimasukkan pada ksm";
    } else {
        $logbook = uploadpdf('logbook');
        if (!$logbook) {
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada logbook";
        } else {
            $lembar_persetujuan = uploadpdf('lembar_persetujuan');
            if (!$lembar_persetujuan){
                return $_SESSION["errMessage"]="Data gagal dimasukkan pada lembar_persetujuan";
            } else {
                $lembar_keterangan = uploadpdf('lembar_keterangan');
                if (!$lembar_keterangan){
                    return $_SESSION["errMessage"]="Data gagal dimasukkan pada lembar_keterangan";
                } else {
                    $naskah_ta = uploaddocx('naskah_ta');
                    if (!$naskah_ta){
                        return $_SESSION["errMessage"]="Data gagal dimasukkan pada naskah_ta";
                    } else {
                        $artikel_publikasi = uploadpdf('artikel_publikasi');
                        if (!$artikel_publikasi){
                            return $_SESSION["errMessage"]="Data gagal dimasukkan pada artikel_publikasi";
                        } else {
                            $laman_ojs = uploadimage('laman_ojs');
                            if (!$laman_ojs){
                                return $_SESSION["errMessage"]="Data gagal dimasukkan pada laman_ojs";
                            }
                        }
                    }
                }
            }
        }
    }
    
    // echo json_encode($data);
    //query insert data
    $query = "INSERT INTO ujianta VALUES 
    ('', '$nama','$nim','$nomor_hp','$email','$judul_ta',
    '$nama_pembimbing', '$judul_artikel', 
    '$ksm', '$logbook', '$lembar_persetujuan', '$lembar_keterangan', '$naskah_ta',
    '$artikel_publikasi', '$laman_ojs', '$nama_jurnal',
    '$tahun', '$volume', '$nomor_jurnal', '$halaman',
    '$url_artikel')
    ";

    mysqli_query($db, $query);

    if(mysqli_affected_rows($db)>0){
        $_SESSION["successMessage"] = "Data Berhasil Ditambahkan";
    } else {
        $_SESSION["errMessage"] = "Data Tidak Berhasil Ditambahkan. Mohon Coba lagi";
    }
}

function deletePTA ($id){
    global $db;
    mysqli_query($db, "DELETE FROM perpanjanganta WHERE id = $id");

    return mysqli_affected_rows($db);
};

function deleteTA ($id){
    global $db;
    mysqli_query($db, "DELETE FROM ujianta WHERE id = $id");

    return mysqli_affected_rows($db);
};


//edit
function editPTA($data){
    global $db;

    $id = $data["id"];

    $nama = htmlspecialchars($_POST["nama"]);
    $nim = htmlspecialchars($_POST["nim"]);
    $nomor_hp = htmlspecialchars($_POST["nomor_hp"]);
    $email = htmlspecialchars($_POST["email"]);
    $judul_ta = htmlspecialchars($_POST["judul_ta"]);
    $nama_pembimbing = htmlspecialchars($_POST["nama_pembimbing"]);
    // $ksmLama =  htmlspecialchars($_POST["ksmLama"]);
    // $logbookLama =  htmlspecialchars($_POST["logbookLama"]);
    // $formulir_perpanjanganLama =  htmlspecialchars($_POST["logbookLama"]);
    // $ksm =  htmlspecialchars($_POST["ksm"]);
    // $logbook =  htmlspecialchars($_POST["logbook"]);
    // $formulir_perpanjangan =  htmlspecialchars($_POST["logbook"]);

    // $ksm = validationedit('ksm', 'ksmLama');
    // $logbook = validationedit('logbook', 'logbookLama');
    // $formulir_perpanjangan = validationedit('formulir_perpanjangan', 'formulir_perpanjanganLama');
    $ksm = 'ksm';
    $logbook = 'logbook';
    $formulir_perpanjangan = 'formulir_perpanjangan';

    //upload
    // echo json_encode($data);
    // $ksm = validationedit($ksm, 'ksmLama');
    // $logbook = validationedit($logbook, 'logbookLama');
    // $formulir_perpanjangan = validationedit($formulir_perpanjangan, 'formulir_perpanjanganLama');

    if( validationedit('ksm') ){
        $ksm = uploadimage('ksm');
        if(!$ksm){
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada ksm";
        }
    } else {
        $ksm = $data['ksmLama'];
    }
    if(validationedit('logbook')){
        $logbook = uploadpdf('logbook');
        if(!$logbook){
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada logbook";
        }
    } else {
        $logbook = $data['logbookLama'];
    }
    if(validationedit('formulir_perpanjangan')){
        $formulir_perpanjangan = uploadpdf('formulir_perpanjangan');
        if(!$formulir_perpanjangan){
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada formulir_perpanjangan";
        }
    } else {
        $formulir_perpanjangan = $data['formulir_perpanjanganLama'];
    }
    

    //query update data
    $query = "UPDATE perpanjanganta SET
                nama = '$nama',
                nim = '$nim',
                nomor_hp = '$nomor_hp',
                email = '$email',
                judul_ta = '$judul_ta',
                nama_pembimbing = '$nama_pembimbing',
                ksm = '$ksm',
                logbook = '$logbook',
                formulir_perpanjangan = '$formulir_perpanjangan'

                WHERE id = $id;
             ";
    echo $query;

    mysqli_query($db, $query);
    $_SESSION["successMessage"] = "Data Berhasil Diedit";
}

function editTA($data){
    global $db;

    $id = $data["id"];

    $nama = htmlspecialchars($_POST['nama']) ;
    $nim = htmlspecialchars($_POST['nim']);
    $nomor_hp = htmlspecialchars($_POST['nomor_hp']);
    $email = htmlspecialchars($_POST['email']);
    $judul_ta = htmlspecialchars($_POST['judul_ta']);
    $nama_pembimbing = htmlspecialchars($_POST['nama_pembimbing']);
    $judul_artikel = htmlspecialchars($_POST['judul_artikel']);
    $ksm = htmlspecialchars($_POST['ksm']);
    $logbook = $_POST['logbook'];
    $lembar_persetujuan = $_POST['lembar_persetujuan'];
    $lembar_keterangan = $_POST['lembar_keterangan'];
    $naskah_ta = $_POST['naskah_ta'];
    $artikel_publikasi = $_POST['artikel_publikasi'];
    $laman_ojs = $_POST['laman_ojs'];
    $nama_jurnal = htmlspecialchars($_POST['nama_jurnal']);
    $tahun = htmlspecialchars($_POST['tahun']);
    $volume = htmlspecialchars($_POST['volume']);
    $nomor_jurnal = htmlspecialchars($_POST['nomor_jurnal']);
    $halaman = htmlspecialchars($_POST['halaman']);
    $url_artikel = htmlspecialchars($_POST['url_artikel']);

    //Check function
    if( validationedit('ksm') ){
        $ksm = uploadimage('ksm');
        if(!$ksm){
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada ksm";
        }
    } else {
        $ksm = $data['ksmLama'];
    }
    if(validationedit('logbook')){
        $logbook = uploadpdf('logbook');
        if(!$logbook){
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada logbook";
        }
    } else {
        $logbook = $data['logbookLama'];
    }
    if(validationedit('lembar_persetujuan')){
        $lembar_persetujuan = uploadpdf('lembar_persetujuan');
        if(!$lembar_persetujuan){
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada lembar_persetujuan";
        }
    } else {
        $lembar_persetujuan = $data['lembar_persetujuanLama'];
    }
    if(validationedit('lembar_keterangan')){
        $lembar_keterangan = uploadpdf('lembar_keterangan');
        if(!$lembar_keterangan){
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada lembar_keterangan";
        }
    } else {
        $lembar_keterangan = $data['lembar_keteranganLama'];
    }
    if(validationedit('naskah_ta')){
        $naskah_ta = uploaddocx('naskah_ta');
        if(!$naskah_ta){
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada naskah_ta";
        }
    } else {
        $naskah_ta = $data['formulir_perpanjanganLama'];
    }
    if(validationedit('artikel_publikasi')){
        $artikel_publikasi = uploadpdf('artikel_publikasi');
        if(!$artikel_publikasi){
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada artikel_publikasi";
        }
    } else {
        $artikel_publikasi = $data['artikel_publikasiLama'];
    }
    if(validationedit('laman_ojs')){
        $laman_ojs = uploadimage('laman_ojs');
        if(!$laman_ojs){
            return $_SESSION["errMessage"]="Data gagal dimasukkan pada laman_ojs";
        }
    } else {
        $laman_ojs = $data['formulir_perpanjanganLama'];
    }
    
    $query = "UPDATE ujianta SET
        nama = '$nama',
        nim = '$nim',
        nomor_hp = '$nomor_hp',
        email = '$email',
        judul_ta = '$judul_ta',
        nama_pembimbing = '$nama_pembimbing',
        judul_artikel = '$judul_artikel',
        ksm = '$ksm',
        logbook = '$logbook',
        lembar_persetujuan = '$lembar_persetujuan',
        lembar_keterangan = '$lembar_keterangan',
        naskah_ta = '$naskah_ta',
        artikel_publikasi = '$artikel_publikasi',
        laman_ojs = '$laman_ojs',
        nama_jurnal = '$nama_jurnal',
        tahun = '$tahun',
        volume = '$volume',
        nomor_jurnal = '$nomor_jurnal',
        halaman = '$halaman',
        url_artikel = '$url_artikel'

        WHERE id = $id;
    ";

    echo $query;

    mysqli_query($db, $query);
    $_SESSION["successMessage"] = "Data Berhasil Diedit";
}

function validationedit($data){
    //if user want to change images/files
    if( $_FILES[$data]['error'] ===  0){
        return true;
    } 
    else {
        return false;
    }
}


//search
function searchTA($keyword){
    $query = "SELECT * FROM ujianta
        WHERE
        nama LIKE '%$keyword%' OR 
        nim LIKE '%$keyword%' OR
        nomor_hp LIKE '%$keyword%' OR
        email LIKE '%$keyword%'OR
        judul_ta LIKE '%$keyword%' OR
        nama_pembimbing LIKE '%$keyword%' OR
        judul_artikel LIKE '%$keyword%' OR
        nama_jurnal LIKE '%$keyword%' OR
        tahun LIKE '%$keyword%' OR
        volume LIKE '%$keyword%' OR
        nomor_jurnal LIKE '%$keyword%' OR
        halaman LIKE '%$keyword%' OR
        url_artikel LIKE '%$keyword%'

        ORDER BY nama
    ";
    return query($query);
}

function searchPTA($keyword){
    $query = "SELECT * FROM perpanjanganta
        WHERE
        nama LIKE '%$keyword%' OR 
        nim LIKE '%$keyword%' OR
        nomor_hp LIKE '%$keyword%' OR
        email LIKE '%$keyword%'OR
        judul_ta LIKE '%$keyword%' OR
        nama_pembimbing LIKE '%$keyword%' OR
        logbook LIKE '%keyword'
        ORDER BY nama
    ";
    return query($query);
}

function checkFileExists($filename){
    return file_exists('../Data/' . $filename);
}

//upload
function uploadimage($data){
    $nameFile = $_FILES[$data]['name'];
    $sizeFile = $_FILES[$data]['size'];
    $error = $_FILES[$data]['error'];
    $tmpName = $_FILES[$data]['tmp_name'];

    // cek gambar diupload/tidak
    if($error === 4){
        echo"<script>
            alert('Silahkan masukkan gambar terlebih dahulu!');
            </script>";
        return false;
    };

    // cek format
    $ekstensiFile = ['jpg', 'jpeg', 'png'];
    $formatFile = explode('.', $nameFile);
    $formatFile = strtolower(end($formatFile));

    if(!in_array($formatFile,$ekstensiFile)){
        echo"<script>
            alert('Mohon Mengupload sesuai dengan format!');
            </script>";
        return false;
    };

    //cek size gambar/file
    if ($sizeFile > 10000000){
        echo"<script>
        alert('Upload file tidak boleh lebih dari 10mb');
        </script>";
    return false;
    };

    //generate nama gambar baru

    $nameFileBaru = $nameFile;
    $i = 1;
    while (checkFileExists($nameFileBaru . '.' . $formatFile)) {
        $nameFileBaru = $nameFile . " ($i)";
        $i++;
    }
    $nameFileBaru = $nameFileBaru . '.' . $formatFile;
    // $nameFileBaru = uniqid();
    // $nameFileBaru .= '.';
    // $nameFileBaru .= $formatFile;
    // var_dump($nameFileBaru); die;

    //lolos pengecekkan
    move_uploaded_file($tmpName, '../Data/'.$nameFileBaru);

    return $nameFileBaru;

}

function uploadpdf($data){
    

    $nameFile = $_FILES[$data]['name'];
    $sizeFile = $_FILES[$data]['size'];
    $error = $_FILES[$data]['error'];
    $tmpName = $_FILES[$data]['tmp_name'];

    // cek gambar diupload/tidak
    if($error === 4){
        echo"<script>
            alert('Silahkan masukkan gambar terlebih dahulu!');
            </script>";
        return false;
    };

    // cek format
    $ekstensiFile = ['pdf'];
    $formatFile = explode('.', $nameFile);
    $formatFile = strtolower(end($formatFile));

    if(!in_array($formatFile,$ekstensiFile)){
        echo"<script>
            alert('Mohon Mengupload sesuai dengan format!');
            </script>";
        return false;
    };

    //cek size gambar/file
    if ($sizeFile > 10000000){
        echo"<script>
        alert('Upload file tidak boleh lebih dari 10mb');
        </script>";
    return false;
    };

    //generate nama gambar baru
    $nameFileBaru = $nameFile;
    $i = 1;
    while (checkFileExists($nameFileBaru . '.' . $formatFile)) {
        $nameFileBaru = $nameFile . " ($i)";
        $i++;
    }
    $nameFileBaru = $nameFileBaru . '.' . $formatFile;
    // $nameFileBaru = uniqid();
    // $nameFileBaru .= '.';
    // $nameFileBaru .= $formatFile;
    // var_dump($nameFileBaru); die;

    //lolos pengecekkan
    move_uploaded_file($tmpName, '../Data/'.$nameFileBaru);

    return $nameFileBaru;

}

function uploaddocx($data){
    

    $nameFile = $_FILES[$data]['name'];
    $sizeFile = $_FILES[$data]['size'];
    $error = $_FILES[$data]['error'];
    $tmpName = $_FILES[$data]['tmp_name'];

    // cek gambar diupload/tidak
    if($error === 4){
        echo"<script>
            alert('Silahkan masukkan gambar terlebih dahulu!');
            </script>";
        return false;
    };

    // cek format
    $ekstensiFile = ['docx'];
    $formatFile = explode('.', $nameFile);
    $formatFile = strtolower(end($formatFile));

    if(!in_array($formatFile,$ekstensiFile)){
        echo"<script>
            alert('Mohon Mengupload sesuai dengan format!');
            </script>";
        return false;
    };

    //cek size gambar/file
    if ($sizeFile > 10000000){
        echo"<script>
        alert('Upload file tidak boleh lebih dari 10mb');
        </script>";
    return false;
    };

    //generate nama gambar baru
    $nameFileBaru = $nameFile;
    $i = 1;
    while (checkFileExists($nameFileBaru . '.' . $formatFile)) {
        $nameFileBaru = $nameFile . " ($i)";
        $i++;
    }
    $nameFileBaru = $nameFileBaru . '.' . $formatFile;
    // $nameFileBaru = uniqid();
    // $nameFileBaru .= '.';
    // $nameFileBaru .= $formatFile;
    // var_dump($nameFileBaru); die;

    //lolos pengecekkan
    move_uploaded_file($tmpName, '../Data/'.$nameFileBaru);

    return $nameFileBaru;

}

function uploadall($data){
    

    $nameFile = $_FILES[$data]['name'];
    $sizeFile = $_FILES[$data]['size'];
    $error = $_FILES[$data]['error'];
    $tmpName = $_FILES[$data]['tmp_name'];

    // cek gambar diupload/tidak
    if($error === 4){
        echo"<script>
            alert('Silahkan masukkan gambar terlebih dahulu!');
            </script>";
        return false;
    };

    // cek format
    $ekstensiFile = ['pdf', 'jpg', 'png', 'jpeg', 'docx'];
    $formatFile = explode('.', $nameFile);
    $formatFile = strtolower(end($formatFile));

    if(!in_array($formatFile,$ekstensiFile)){
        echo"<script>
            alert('Mohon Mengupload sesuai dengan format!');
            </script>";
        return false;
    };

    //cek size gambar/file
    if ($sizeFile > 10000000){
        echo"<script>
        alert('Upload file tidak boleh lebih dari 10mb');
        </script>";
    return false;
    };

    //generate nama gambar baru
    $nameFileBaru = $nameFile;
    $i = 1;
    while (checkFileExists($nameFileBaru . '.' . $formatFile)) {
        $nameFileBaru = $nameFile . " ($i)";
        $i++;
    }
    $nameFileBaru = $nameFileBaru . '.' . $formatFile;
    // $nameFileBaru = uniqid();
    // $nameFileBaru .= '.';
    // $nameFileBaru .= $formatFile;
    // var_dump($nameFileBaru); die;

    //lolos pengecekkan
    move_uploaded_file($tmpName, '../Data/'.$nameFileBaru);

    return $nameFileBaru;

}

?>