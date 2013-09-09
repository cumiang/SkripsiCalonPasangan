<?php

include "CLASS/user.class.php";
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
        $filter = $_POST['filter'];
        $key = $_POST['key'];
        //echo $filter."-".$key;
        //exit();
        $jk = $_SESSION['jenis_kelamin'];
        $db = new user();

        if ($filter == "nama") {
            $sql = "SELECT id_user_profil_fk,status_hubungan,foto_profil,nama_lengkap,kota_tempat_tinggal 
                    FROM tbl_profil_user 
                    WHERE (jenis_kelamin <> '$jk')
                    AND (nama_lengkap LIKE '%$key%')";
        } else if ($filter == "asal") {
            $sql = "SELECT id_user_profil_fk,status_hubungan,foto_profil,nama_lengkap,kota_tempat_tinggal 
                    FROM tbl_profil_user 
                    WHERE (jenis_kelamin <> '$jk')
                    AND (kota_tempat_tinggal LIKE '%$key%')";
        } else if ($filter == "status") {
            $sql = "SELECT id_user_profil_fk,status_hubungan,foto_profil,nama_lengkap,kota_tempat_tinggal 
                    FROM tbl_profil_user 
                    WHERE (jenis_kelamin <> '$jk')
                    AND (status_hubungan LIKE '%$key%')";
        }else{
            $sql = "SELECT id_user_profil_fk,status_hubungan,foto_profil,nama_lengkap,kota_tempat_tinggal 
                    FROM tbl_profil_user 
                    WHERE jenis_kelamin <> '$jk'";            
        }
        //membuat struktur hasil berformat JSON
        $data = $db->ambil_data_user_sql($sql);
        $jumlah = sizeof($data);
        $user = "";
        if ($jumlah > 0) {
            for ($i = 0; $i < $jumlah; $i++) {
                $id = $data[$i]["id_user_profil_fk"];
                if (empty($data[$i]["foto_profil"])){
                    $foto = "USER_SPACE/foto-profil_50x50.png";
                }else{
                    $foto = "USER_SPACE/$id/".$data[$i]["foto_profil"];
                }
                $nama = $data[$i]["nama_lengkap"];
                $kota = explode("-",$data[$i]["kota_tempat_tinggal"]);
                $kota = $kota[1];
                $user = $user."$id|$foto|$nama|$kota"."#";
            }
                echo rtrim($user,"#");
            }
    }
}
?>