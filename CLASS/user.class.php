<?php

/**
 *
 * @author muh. asrul ismail
 */
include "db_koneksi.class.php";

class user extends db_koneksi {

//data untuk login
    private $id_user;
    private $nama_user;
    private $password_user;
    private $level_user;
//data untuk profil
    private $nama_lengkap;
    private $nama_panggil;
    private $tempat_lahir;
    private $tanggal_lahir;
    private $agama;
    private $jenis_kelamin;
    private $status_hubungan;
    private $negara;
    private $provinsi;
    private $kota;
    private $alamat;
    private $pekerjaan;
    private $pendidikan;
    private $nomor_kontak;
    private $situs;
    private $email;
    private $jejaring;
//data untuk foto 
    private $foto_profil;
    private $foto_sampul;

    public function __construct() {
        parent::__construct();
    }

    public function set_id_user() {
        //$this->id_user = $this->db->lastInsertId();
        $maxID = $this->ambil_data_user_sql("CALL sp_max_id_user");
        $tmpID = $maxID[0][0];
        if (is_null($tmpID)) {
            $tmpID = "U00000001";
            $this->id_user = $tmpID;
            return $tmpID;
        } else {

            $ID = (substr(($tmpID), 1, (strlen($tmpID) - 1)) + 1);
            $totTmp = strlen($tmpID);
            $totID = strlen($ID);
            $newID = substr_replace($tmpID, $ID, ($totTmp - $totID));
            $this->id_user = $newID;
            return $newID;
        }
    }

// set data login
    public function set_nama_user($nama) {
        $this->nama_user = strtolower($nama);
    }

    public function set_password_user($pass) {
        $this->password_user = md5($pass);
    }

    public function set_level_user($level) {
        $this->level_user = $level;
    }

// set data profil
    public function set_nama_lengkap($nl) {
        $this->nama_lengkap = $nl;
    }

    public function set_nama_panggil($np) {
        $this->nama_panggil = $np;
    }

    public function set_tempat_lahir($tl) {
        $this->tempat_lahir = $tl;
    }

    public function set_tanggal_lahir($tgl_l) {
        $this->tanggal_lahir = $tgl_l;
    }

    public function set_agama($ag) {
        $this->agama = $ag;
    }

    public function set_jenis_kelamin($jk) {
        $this->jenis_kelamin = $jk;
    }

    public function set_status_hubungan($sh) {
        $this->status_hubungan = $sh;
    }

    public function set_negara($ng) {
        $this->negara = $ng;
    }

    public function set_provinsi($prv) {
        $this->provinsi = $prv;
    }

    public function set_kota($kt) {
        $this->kota = $kt;
    }

    public function set_alamat($alm) {
        $this->alamat = $alm;
    }

    public function set_pekerjaan($pkr) {
        $this->pekerjaan = $pkr;
    }

    public function set_pendidikan($pdk) {
        $this->pendidikan = $pdk;
    }

    public function set_nomor_kontak($kntk) {
        $this->nomor_kontak = $kntk;
    }

    public function set_situs($sts) {
        $this->situs = $sts;
    }

    public function set_email($em) {
        $this->email = $em;
    }

    public function set_jejaring($jrj) {
        $this->jejaring = $jrj;
    }

// set data foto
    public function set_foto_profil($fp) {
        $this->foto_profil = $fp;
    }

    public function set_foto_sampul($fs) {
        $this->foto_sampul = $fs;
    }

    public function simpan_data_user() {
        try {
            $this->db->beginTransaction();
            $sql1 = "INSERT INTO tbl_user VALUES('$this->id_user','$this->nama_user','$this->password_user','$this->level_user')";
            $sql2 = "INSERT INTO tbl_profil_user (id_user_profil_fk) VALUES('$this->id_user')";
            $this->db->exec($sql1);
            $this->db->exec($sql2);
            $return = $this->db->commit();
            return $return;
        } catch (Exception $e) {
            $this->db->rollBack();
            return $e->getMessage();
        }
    }

    public function edit_data_user($id) {
        $sql = "UPDATE  tbl_user SET nama_user='$this->nama_user', password_user='$this->password_user',level_user='$this->level_user' WHERE id_user='$id';";
        $ret = $this->db->exec($sql);
        return $ret;
    }

    public function update_data_profil($id) {
        $sql = "UPDATE  tbl_profil_user SET 
                nama_lengkap='$this->nama_lengkap',
                nama_panggilan='$this->nama_panggil',
                tempat_lahir='$this->tempat_lahir', 
                tanggal_lahir='$this->tanggal_lahir', 
                agama='$this->agama', 
                jenis_kelamin='$this->jenis_kelamin', 
                status_hubungan='$this->status_hubungan', 
                negara_tempat_tinggal='$this->negara', 
                provinsi_tempat_tinggal='$this->provinsi', 
                kota_tempat_tinggal='$this->kota', 
                alamat='$this->alamat', 
                pekerjaan='$this->pekerjaan', 
                pendidikan='$this->pendidikan', 
                no_kontak='$this->nomor_kontak', 
                situs_web='$this->situs', 
                email='$this->email', 
                jejaring_sosial='$this->jejaring' 
                WHERE id_user_profil_fk='$id';";
        $ret = $this->db->exec($sql);
        return $ret;
    }

    public function update_foto_profil($id) {
        $sql = "UPDATE tbl_profil_user 
                SET foto_profil='$this->foto_profil'
                WHERE id_user_profil_fk='$id';";
        $ret = $this->db->exec($sql);
        return $ret;
    }
    public function update_foto_sampul($id) {
        $sql = "UPDATE tbl_profil_user SET 
                foto_sampul='$this->foto_sampul' 
                WHERE id_user_profil_fk='$id';";
        $ret = $this->db->exec($sql);
        return $ret;
    }
    public function hapus_data_user($id) {
        $sql = "DELETE  FROM tbl_user  WHERE id_user='{$id}'";
        $ret = $this->db->exec($sql);
        return $ret;
    }

    public function jumlah_data_user() {
        $sql = "SELECT id_user FROM tbl_user";
        $stat = $this->db->prepare($sql);
        $stat->execute();
        return $stat->rowCount();
    }

    public function cek_data_user($nama_user) {
        $stat = $this->db->prepare("SELECT * FROM tbl_user WHERE nama_user='" . strtolower($nama_user) . "'");
        $stat->execute();
        $jumlah = $stat->rowCount();
        if ($jumlah > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function ambil_data_user($field_filter, $value_filter) {
        if ($field_filter == "ALL" & $value_filter == NULL) {
            $sql = "SELECT * FROM tbl_user";
        } else {
            $sql = "SELECT * FROM tbl_user WHERE $field_filter='$value_filter'";
        }
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

    public function ambil_data_user_sql($sql) {
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

}

?>
