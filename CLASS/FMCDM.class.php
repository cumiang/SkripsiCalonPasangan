<?php

/**
 *
 * @author muh. asrul ismail
 */
include "db_koneksi.class.php";

class FMCDM extends db_koneksi {

    public function __construct() {
        parent::__construct();
    }

    public function ambil_kriteria($field_filter, $value_filter) {
        if ($field_filter == "ALL" & $value_filter == NULL) {
            $sql = "SELECT * FROM tbl_kriteria ORDER BY kategori_kriteria ASC";
        } else {
            $sql = "SELECT * FROM tbl_kriteria WHERE $field_filter='$value_filter' ORDER BY kategori_kriteria ASC";
        }
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

    public function ambil_sql($sql) {
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

    public function ambil_nilai_bobot_rating($user, $kriteria) {
        $sql = "SELECT id_bobot_variabel_fk FROM tbl_rating_kepentingan_kriteria WHERE id_user_rating_fk='$user' AND id_kriteria_fk='$kriteria'";
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

    public function ambil_nilai_variabel_linguistik() {
        $sql = "SELECT * FROM tbl_bobot_variabel_linguistik";
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $a = $kuery->fetchAll();
        $tot = sizeof($a);
        //mengembalikan nilai dalam bentuk array
        //menyusun ulang struktur array menjadi asosiativ array
        if ($tot > 0) {
            $key_array =[];
            $value_array = [];
            for ($i = 0; $i < $tot; $i++) {
                array_push($key_array, $a[$i]["id_bobot_variabel"]);
                array_push($value_array, array("Y"=>$a[$i]["nilai_A"],
                                                "Q"=>$a[$i]["nilai_B"],
                                                "Z"=>$a[$i]["nilai_C"]));
            }
            $hasil=  array_combine($key_array, $value_array);
        }
        return $hasil;
    }

}

?>
