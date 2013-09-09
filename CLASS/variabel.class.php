<?php

/**
 *
 * @author muh. asrul ismail
 */
include "db_koneksi.class.php";

class variabel extends db_koneksi {

    private $id_variabel;
    private $nama_variabel;
    private $nilai_a;
    private $nilai_b;
    private $nilai_c;
    
    public function __construct() {
        parent::__construct();
    }

    public function set_id_variabel($id) {
        $this->id_variabel = $id;
    }

    public function set_nama_variabel($var) {
        $this->nama_variabel = $var;
    }

    public function set_nilai_a($a) {
        $this->nilai_a = $a;
    }
    public function set_nilai_b($b) {
        $this->nilai_b = $b;
    }
    public function set_nilai_c($c) {
        $this->nilai_c = $c;
    }

    public function simpan_data_variabel() {
        $sql = "INSERT INTO tbl_bobot_variabel_linguistik VALUES(
                '$this->id_variabel',
                '$this->nama_variabel',
                 $this->nilai_a,
                 $this->nilai_b,
                 $this->nilai_c)";
        
        $return = $this->db->exec($sql);
        return $return;
    }

    public function edit_data_variabel($id) {
        $sql = "UPDATE  tbl_bobot_variabel_linguistik SET 
                id_bobot_variabel='$this->id_variabel',
                nama_variabel='$this->nama_variabel',
                nilai_A=$this->nilai_a,
                nilai_B=$this->nilai_b,
                nilai_C=$this->nilai_c 
                WHERE id_bobot_variabel='$id';";
        $ret = $this->db->exec($sql);
        return $ret;
    }

    public function hapus_data_variabel($id) {
        $sql = "DELETE  FROM tbl_bobot_variabel_linguistik  WHERE id_bobot_variabel='{$id}'";
        $ret = $this->db->exec($sql);
        return $ret;
    }

    public function jumlah_data_variabel() {
        $sql = "SELECT id_bobot_variabel FROM tbl_bobot_variabel_linguistik";
        $stat = $this->db->prepare($sql);
        $stat->execute();
        return $stat->rowCount();
    }

    public function cek_data_variabel($id) {
        $stat = $this->db->prepare("SELECT * FROM tbl_bobot_variabel_linguistik WHERE id_bobot_variabel='$id'");
        $stat->execute();
        $jumlah = $stat->rowCount();
        if ($jumlah > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function ambil_data_variabel($field_filter, $value_filter) {
        if ($field_filter == "ALL" & $value_filter == NULL) {
            $sql = "SELECT * FROM tbl_bobot_variabel_linguistik";
        } else {
            $sql = "SELECT * FROM tbl_bobot_variabel_linguistik WHERE $field_filter='$value_filter'";
        }
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

    public function ambil_data_variabel_sql($sql) {
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

}

?>
