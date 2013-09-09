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
        $nama = $_POST['nama'];
        $nama_kecil = $_POST['nama_kecil'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $agama = $_POST['agama'];
        $jenkel = $_POST['jenkel'];
        $status = $_POST['status'];
        $negara = $_POST['negara'];
        if($negara<>"107-Indonesia"){
        $provinsi = "no-".$_POST['provinsi'];
        $kota = "no-".$_POST['kota'];
        }else{
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];            
        }
            
        $alamat = $_POST['alamat'];
        $pekerjaan = $_POST['pekerjaan'];
        $pendidikan = $_POST['pendidikan'];
        $kontak = trim($_POST['kontak']);
        $situs = trim($_POST['situs']);
        $email = trim($_POST['email']);
        $jejaring = trim($_POST['jejaring']);

        //mulai validasi
        if (empty($tanggal_lahir)) {
            echo "Anda Harus Menambahkan Tanggal Lahir anda";
        } else if (empty($jenkel)) {
            echo "Anda Harus Menentukan Jenis Kelamin anda";
        } else if (empty($negara)) {
            echo "Tentukan Negara Asal Anda";
        } else if (empty($provinsi)) {
            echo "Tentukan Provinsi Asal Anda";
        } else if (empty($kota)) {
            echo "Tentukan Kota Asal Anda";
       // } else if (preg_match("^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$^", $email)) {
         //  echo "Format E-Mail anda tidak valid";
        } else {
            $db = new user();
            $db->set_nama_lengkap($nama);
            $db->set_nama_panggil($nama_kecil);
            $db->set_tempat_lahir($tempat_lahir);
            $db->set_tanggal_lahir($tanggal_lahir);
            $db->set_agama($agama);
            $db->set_jenis_kelamin($jenkel);
            $db->set_status_hubungan($status);
            $db->set_negara($negara);
            $db->set_provinsi($provinsi);
            $db->set_kota($kota);
            $db->set_alamat($alamat);
            $db->set_pekerjaan($pekerjaan);
            $db->set_pendidikan($pendidikan);
            $db->set_nomor_kontak($kontak);
            $db->set_situs($situs);
            $db->set_email($email);
            $db->set_jejaring($jejaring);
            if($db->update_data_profil($id)){
                echo "Berhasil Mengupdate data profil User";
            }
            }
    }
}
?>