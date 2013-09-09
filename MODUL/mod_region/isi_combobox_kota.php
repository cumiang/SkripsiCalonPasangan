<?php

include "../../CLASS/region.class.php";

if ($_POST['ID']) {
    $id = explode("-",$_POST['ID']);
    $db = new region();
    $data = $db->ambil_data_region_kota($id[0]);
    $jumlah = sizeof($data);
    if ($jumlah > 0) {
        for ($i = 0; $i < $jumlah; $i++) {
            echo "<option value='" . $data[$i][0] . "-".$data[$i][1]."' >" . $data[$i][1] . "</option>";
        }
    }
}
?>


