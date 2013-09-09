<?php

/**
 *
 * @author muh. asrul ismail
 */
include "db_koneksi.class.php";

class region extends db_koneksi {

    
    public function __construct() {
        parent::__construct();
    }

    public function ambil_data_region_negara() {
        $sql = "SELECT * FROM master_country ORDER BY country_name ASC";
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }
    public function ambil_data_region_provinsi($id_negara) {
        $sql = "SELECT * FROM master_state WHERE state_country_id=$id_negara ORDER BY state_name ASC";
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }
    public function ambil_data_region_kota($id_provinsi) {
        $sql = "SELECT * FROM master_city WHERE city_state_id=$id_provinsi ORDER BY city_name ASC";
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

}

?>
