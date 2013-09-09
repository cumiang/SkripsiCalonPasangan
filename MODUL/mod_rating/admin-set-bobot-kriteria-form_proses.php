<?php

include "../../CLASS/rating.class.php";

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
        $data = $_POST['data'];
        $db = new rating();
        $ret = $db->operasi_multi_transkasi($data);
        if($ret==1){
            echo "Berhasil Menyimpan data Rating Bobot Kriteria";
        }else{
            echo "Ada Kesalahan Pada : ".$ret;
        }
    }
}
?>