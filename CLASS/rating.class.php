<?php

/**
 *
 * @author muh. asrul ismail
 */
include "db_koneksi.class.php";

class rating extends db_koneksi {

    private $id_rating;
    private $id_user_rating;
    private $id_kriteria_rating;
    private $id_variabel_rating;

    public function __construct() {
        parent::__construct();
    }

    public function set_id_rating($id) {
        $this->id_rating = $id;
    }

    public function set_id_user_rating($id_user) {
        $this->id_user_rating = $id_user;
    }

    public function set_id_kriteria_rating($id_kriteria) {
        $this->id_kriteria_rating = $id_kriteria;
    }

    public function set_id_variabel_rating($id_variabel) {
        $this->id_variabel_rating = $id_variabel;
    }

    public function simpan_data_rating() {
        $sql = "INSERT INTO tbl_rating_kepentingan_kriteria(id_user_rating_fk,id_kriteria_fk,id_bobot_variabel_fk) VALUES(
                '$this->id_user_rating',
                '$this->id_kriteria_rating',
                '$this->id_variabel_rating')";

        $return = $this->db->exec($sql);
        return $return;
    }

    public function edit_data_rating($id) {
        $sql = "UPDATE tbl_rating_kepentingan_kriteria SET 
                id_user_rating_fk='$this->id_user_rating',
                id_kriteria_fk='$this->id_kriteria_rating',
                id_bobot_variabel_fk='$this->id_variabel_rating'
                WHERE id_rating_penting_kriteria=$id;";
        $ret = $this->db->exec($sql);
        return $ret;
    }
    public function edit_data_rating2($id_user,$id_kriteria) {
        $sql = "UPDATE tbl_rating_kepentingan_kriteria SET 
                id_bobot_variabel_fk='$this->id_variabel_rating'
                WHERE (id_user_rating_fk='$id_user') AND (id_kriteria_fk='$id_kriteria');";
        $ret = $this->db->exec($sql);
        return $ret;
    }

    public function operasi_multi_transkasi($data_array) {
        try {
            $rating = explode("#", $data_array);
            $tot = count($rating);

            if ($tot > 0) {
                $this->db->beginTransaction();
                for ($i = 0; $i < $tot; $i++) {
                    $rating_nilai = explode("-", $rating[$i]);
                    if ($rating_nilai[1]=="NOT"){
                        echo "Penyimpanan Data Rating Dibatalkan karena masih ada kriteria yang belum ter set (diberi bobot)";
                        exit();
                    }
                    $id = $rating_nilai[1];
                    $kriteria = $rating_nilai[0];
                    $bobot = $rating_nilai[2];
                    $this->set_id_user_rating(preg_replace('/\s+/', '', $id));
                    $this->set_id_kriteria_rating(preg_replace('/\s+/', '', $kriteria));
                    $this->set_id_variabel_rating(preg_replace('/\s+/', '', $bobot));
                    $ada = $this->cek_data_rating($id, $kriteria);
                    if ($ada > 0) {
                        $this->edit_data_rating2($id,$kriteria);
                    } else {
                        $this->simpan_data_rating();
                    }
                }
                $return = $this->db->commit();
                return $return;
            }
        } catch (Exception $e) {
            $this->db->rollBack();
            return $e->getMessage();
        }
    }

    public function hapus_data_rating($id) {
        $sql = "DELETE  FROM tbl_rating_kepentingan_kriteria  WHERE id_rating_penting_kriteria='{$id}'";
        $ret = $this->db->exec($sql);
        return $ret;
    }

    public function jumlah_data_rating() {
        $sql = "SELECT * FROM tbl_rating_kepentingan_kriteria";
        $stat = $this->db->prepare($sql);
        $stat->execute();
        return $stat->rowCount();
    }

    public function cek_data_rating($user, $kriteria) {
        $sql = "SELECT * FROM tbl_rating_kepentingan_kriteria WHERE (id_user_rating_fk='$user') AND (id_kriteria_fk='$kriteria')";
        $stat = $this->db->prepare($sql);
        $stat->execute();
        $jumlah = $stat->rowCount();
        if ($jumlah > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function ambil_data_rating($field_filter, $value_filter) {
        if ($field_filter == "ALL" & $value_filter == NULL) {
            $sql = "SELECT * FROM tbl_rating_kepentingan_kriteria";
        } else {
            $sql = "SELECT * FROM tbl_rating_kepentingan_kriteria WHERE $field_filter='$value_filter'";
        }
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

    public function ambil_data_rating_sql($sql) {
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

    public function ambil_data_view($view) {
        $kuery = $this->db->prepare($view);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

}

?>
