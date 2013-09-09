<?php

/**
 *
 * @author muh. asrul ismail
 */
include "db_koneksi.class.php";

class kriteria extends db_koneksi {

    private $id_kriteria;
    private $kategori_kriteria;
    private $nama_kriteria;
    
    public function __construct() {
        parent::__construct();
    }

    public function set_id_kriteria($id) {
        $this->id_kriteria = $id;
    }

    public function set_kategori_kriteria($kri) {
        $this->kategori_kriteria = $kri;
    }

    public function set_nama_kriteria($nama_kri) {
        $this->nama_kriteria = $nama_kri;
    }

    public function simpan_data_kriteria() {
        $sql = "INSERT INTO tbl_kriteria VALUES('$this->id_kriteria','$this->kategori_kriteria','$this->nama_kriteria')";
        $return = $this->db->exec($sql);
        return $return;
    }

    public function edit_data_kriteria($id_tmp) {
        $sql = "UPDATE  tbl_kriteria SET id_kriteria='$this->id_kriteria',kategori_kriteria='$this->kategori_kriteria',nama_kriteria='$this->nama_kriteria' WHERE id_kriteria='$id_tmp';";
        $ret = $this->db->exec($sql);
        return $ret;
    }

    public function hapus_data_kriteria($id) {
        $sql = "DELETE  FROM tbl_kriteria  WHERE id_kriteria='{$id}'";
        $ret = $this->db->exec($sql);
        return $ret;
    }

    public function jumlah_data_kriteria() {
        $sql = "SELECT id_kriteria FROM tbl_kriteria";
        $stat = $this->db->prepare($sql);
        $stat->execute();
        return $stat->rowCount();
    }

    public function cek_data_kriteria($id_kriteria) {
        $stat = $this->db->prepare("SELECT * FROM tbl_kriteria WHERE id_kriteria='$id_kriteria'");
        $stat->execute();
        $jumlah = $stat->rowCount();
        if ($jumlah > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function ambil_data_kriteria($field_filter, $value_filter) {
        if ($field_filter == "ALL" & $value_filter == NULL) {
            $sql = "SELECT * FROM tbl_kriteria";
        } else {
            $sql = "SELECT * FROM tbl_kriteria WHERE $field_filter='$value_filter'";
        }
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

    public function ambil_data_kriteria_sql($sql) {
        $kuery = $this->db->prepare($sql);
        $kuery->execute();
        $hasil = $kuery->fetchAll();
        //mengembalikan nilai dalam bentuk array
        //contoh $hasil[0]['nama field'] mengebalikan record pertama dengan field kolom
        return $hasil;
    }

}

?>
