<?php

include "../../CLASS/variabel.class.php";

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
        $id_tmp = $_POST['id_tmp'];
        $nama = $_POST['nama'];
        $nilai_a = $_POST['nilai_a'];
        $nilai_b = $_POST['nilai_b'];
        $nilai_c = $_POST['nilai_c'];
        $mode = $_POST['mode'];
        $db = new variabel();
        $db->set_id_variabel(preg_replace('/\s+/', '', $id));
        $db->set_nama_variabel($nama);
        $db->set_nilai_a($nilai_a);
        $db->set_nilai_b($nilai_b);
        $db->set_nilai_c($nilai_c);
        if ($mode == "modeADD") {
            $ada = $db->cek_data_variabel($id);
            if ($ada == 1) {
                echo(3);
            } else {
                $ret = $db->simpan_data_variabel();
                echo $ret;
            }
        } else if ($mode == "modeEDIT") {
            $ret = $db->edit_data_variabel($id_tmp);
            echo $ret;
        }                    
    }
}
?>