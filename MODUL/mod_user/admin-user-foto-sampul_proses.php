<?php

include "../../CLASS/user.class.php";
include "../../FUNGSI/fungsi.php";
session_start();



if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo '<link href="style/bootstrap.css" rel="stylesheet">';
    echo "<link href='style/style.css' rel='stylesheet'>";
    echo "</head><body><div class='admin-form'><div class='hero-unit'>
              <div align='center'>
              <h2>ANDA TIDAK MENDAPATKAN AKSES</h2>
              <img src='img/lock.png' class='offset'>
              <p>Untuk mengakses aplikasi, Anda harus login terlebih dahulu</p>
              <p><a class='btn btn-primary btn-large' href='admin-login.php'>Ulangi Lagi</a></p></div>
              </div></div>";
} else {

    if ($_SESSION['leveluser'] == 'admin') {

        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['txtID'];
            $nama_upload = $_FILES['imgSampul']['name'];
            $size_upload = $_FILES['imgSampul']['size'];
            $tmp_upload = $_FILES['imgSampul']["tmp_name"];
            $db = new user();
            //validasi format gambar
            $nama = strtolower(stripslashes($nama_upload));
            $nama_ext = strtolower(getExtension($nama));
            if (($nama_ext != "jpg") && ($nama_ext != "jpeg") && ($nama_ext != "png") && ($nama_ext != "gif")) {
                echo "format gambar tidak diizinkan kecuali (jpg,jpeg,png,gif)";
                exit();
            }


            $path_upload = "../../" . "USER_SPACE/" . $id . "/";
            $sampul_upload = $path_upload . $nama;

            if (strlen($nama)) {
                if ($size_upload < (1024 * 500)) {

                    if ($nama_ext == "jpg" || $nama_ext == "jpeg") {
                        $sumber = imagecreatefromjpeg($tmp_upload);
                    } else if ($nama_ext == "png") {
                        $sumber = imagecreatefrompng($tmp_upload);
                    } else if ($nama_ext == "gif") {
                        $sumber = imagecreatefromgif($tmp_upload);
                    }
                    //mengambil ukuran tinggi dan lebar file
                    list($lebar, $tinggi) = getimagesize($tmp_upload);
                    //ukuran gambar sampul 851x315 pixel
                    $lebar_new = 851;
                    $tinggi_new = 315;
                    $tmp = imagecreatetruecolor($lebar_new, $tinggi_new);

                    imagecopyresampled($tmp, $sumber, 0, 0, 0, 0, $lebar_new, $tinggi_new, $lebar, $tinggi);

                    //simpan gambar
                    if ($nama_ext == "jpg" || $nama_ext == "jpeg") {
                        imagejpeg($tmp, $sampul_upload);
                    } else if ($nama_ext == "png") {
                        imagepng($tmp, $path_upload . $sampul_upload);
                    } else if ($nama_ext == "gif") {
                        imagegif($tmp, $path_upload . $sampul_upload);
                    }
                    //update database
                    $db->set_foto_sampul($nama);
                    $db->update_foto_sampul($id);
                    //bebaskan variabel dr memori
                    imagedestroy($sumber);
                    imagedestroy($tmp);
                    echo "<script>
                            alert('sukses mengupload foto sampul');
                            window.location.href = '../../admin.php';
                          </script>";
                    //header("Location: ../../admin.php");
                }
            } else {
                    echo "<script>
                            alert('Ukuran file gambar tidak diizinkan melebihi 500kb');
                            window.location.href = '../../admin.php';
                          </script>";                
                //echo "Ukuran file gambar anda melebihi 500kb";
            }
        } else {
                    echo "<script>
                            alert('Pilih dulu gambarnya..');
                            window.location.href = '../../admin.php';
                          </script>";                
            //echo "Pilih dulu gambarnya..";
        }
    } else {
        echo "ada kesalahan";
    }
}
?>