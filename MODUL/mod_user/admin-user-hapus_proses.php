<?php

include "../../CLASS/user.class.php";

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
        $db = new user();
        $ada = $db->hapus_data_user($id);
        if ($ada == 1) {
            $space = "../../USER_SPACE/$id";
            //$space = "./coba/".$id."/makna/";
            if (is_dir($space)) {
                rmdir($space);
            }
            echo $ada;
        }
    }
}
?>