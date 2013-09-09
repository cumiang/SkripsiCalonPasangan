<?php
include "../../CLASS/region.class.php";

if ($_POST['ID']) {
    $id = explode("-", $_POST['ID']);
    $db = new region();
    $data = $db->ambil_data_region_provinsi($id[0]);
    $jumlah = sizeof($data);
    if ($jumlah > 0) {
        if ($id[0] == 107) {
            //klau negaranya indonesia kode 107
            echo '<div class="control-group">';
            echo '<label class="control-label" for="cmbProvinsi">Provinsi</label>';
            echo '<div class="controls">';
            echo '<select class="input-xxlarge" name="cmbProvinsi" id="cmbProvinsi">';
            for ($i = 0; $i < $jumlah; $i++) {
                echo "<option value='" . $data[$i][0] . "-" . $data[$i][1] . "' >" . $data[$i][1] . "</option>";
            }
            echo '</select>';
            echo '</div>';
            echo '</div>';
            
            echo '<div class="control-group">';
            echo '<label class="control-label" for="cmbProvinsi">Kota/Kabupaten</label>';
            echo '<div class="controls">';
            echo '<select class="input-xxlarge" name="cmbKota" id="cmbKota">';
            echo "<option>- Pilih Kota -</option>";
            echo '</select>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        //klau negaranya bukan indonesia kode 107
            echo '<div class="control-group">';
            echo '<label class="control-label" for="cmbProvinsi">Provinsi</label>';
            echo '<div class="controls">';
            echo "<input class='input-xxlarge' type='text' name='cmbProvinsi' id='cmbProvinsi'>";
            echo '</div>';
            echo '</div>';
            echo '<div class="control-group">';
            echo '<label class="control-label" for="cmbKota">Kota/Kabupaten</label>';
            echo '<div class="controls">';
            echo "<input class='input-xxlarge' type='text' name='cmbKota' id='cmbKota'>";
            echo '</div>';
            echo '</div>';                    
    }
}
?>


<script>
    $("#cmbProvinsi").change(function() {
        var ID = $(this).val();
        $.ajax({
            url: "MODUL/mod_region/isi_combobox_kota.php",
            type: "POST",
            data: "ID=" + ID,
            cache: false,
            beforeSend: function() {
                $("#cmbKota").html('<img src="../img/loading3.gif" alt="Memuat Data...."/>');
            },
            success: function(st) {
                $("#cmbKota").html(st);
            }
        });
    });
</script>
