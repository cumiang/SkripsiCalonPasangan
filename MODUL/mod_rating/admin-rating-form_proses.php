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
        $id = $_POST['id'];
        $mode = $_POST['mode'];
        $id_user_rating = $_POST['id_user_rating'];
        $id_kriteria_rating = $_POST['id_kriteria_rating'];
        $id_variabel_rating = $_POST['id_variabel_rating'];
        $db = new rating();

        $db->set_id_user_rating(preg_replace('/\s+/', '', $id_user_rating));
        $db->set_id_kriteria_rating(preg_replace('/\s+/', '', $id_kriteria_rating));
        $db->set_id_variabel_rating(preg_replace('/\s+/', '', $id_variabel_rating));
        if ($mode == "modeADD") {
            $ada = $db->cek_data_rating($id_user_rating,$id_kriteria_rating);
            if ($ada == 1) {
                echo(3);
            } else {
                $ret = $db->simpan_data_rating();
                echo $ret;
            }
        } else if ($mode == "modeEDIT") {
            $ret = $db->edit_data_rating($id);
            echo $ret;
        }
        
    }
}
?>