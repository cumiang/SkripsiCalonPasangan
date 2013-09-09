<?php

include "../../CLASS/user.class.php";
//include "../../FUNGSI/fungsi.php";
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
        $nama = $_POST['nama'];
        $pass = $_POST['pass'];
        $level = $_POST['level'];
        $mode = $_POST['mode'];
        $db = new user();

        $kode=$db->set_id_user();
        $db->set_nama_user(preg_replace('/\s+/', '', $nama));
        $db->set_password_user($pass);
        $db->set_level_user($level);
        if ($mode == "modeADD") {
            $ada = $db->cek_data_user($nama);
            if ($ada == 1) {
                echo(3);
            } else {
                $ret = $db->simpan_data_user();
                if ($ret == 1) {
                    $space = "../../USER_SPACE/$kode";
                    //$space = "./coba/".$id."/makna/";
                    if (!file_exists($space)) {
                        umask(0);
                        mkdir($space, 0777, TRUE);
                    }
                    echo $ret;
                }
            }
        } else if ($mode == "modeEDIT") {
            $ret = $db->edit_data_user($id);
            echo $ret;
        }
    }
}
?>