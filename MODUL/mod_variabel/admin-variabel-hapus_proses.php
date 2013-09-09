<?php

include "../../CLASS/variabel.class.php";

session_start();

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses aplikasi, Anda harus login terlebih dahulu<br>";
    echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {

    if ($_SESSION['leveluser'] == 'admin') {
        $id = $_POST['id'];
        $db = new variabel();
        $ada = $db->hapus_data_variabel($id);
        echo $ada;
       }
}
?>