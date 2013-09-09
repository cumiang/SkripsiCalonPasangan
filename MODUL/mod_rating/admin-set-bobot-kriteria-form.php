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

        $db = new user();
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];

        //enumerate data variabel lingusitik untuk bobot kriteria
        $combo = $db->ambil_data_user_sql("SELECT id_bobot_variabel,nama_variabel FROM tbl_bobot_variabel_linguistik");
        $totCombo = sizeof($combo);
        $data_combo = "";
        if ($totCombo > 0) {
            for ($a = 0; $a < $totCombo; $a++) {
                $data_combo = $data_combo . $combo[$a][0] . "-" . $combo[$a][1] . "#";
            }
            $data_combo = substr($data_combo, 0, strlen($data_combo) - 1);
        }
        ?>
        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <h2 class="pull-left">BOBOT KRITERIA CALON PASANGAN
                <!-- page meta -->
                <span class="page-meta">Halaman form untuk set bobot kriteria untuk calon pasangan</span>
            </h2>
            <!-- Breadcrumb -->
            <div class="bread-crumb pull-right">
                <a href="#"><i class="icon-home"></i> Home</a> 
                <!-- Divider -->
                <span class="divider">/</span> 
                <a href="#" class="bread-current">Form Set Bobot</a>
            </div>
            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->
        <div class="matter">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12"> 

                        <div class="widget wblue">

                            <div class="widget-head">
                                <div class="pull-left">BERIKAN BOBOT KRITERIA CALON PASANGAN <?php echo strtoupper($nama); ?></div>
                                <div class="widget-icons pull-right">
                                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget-content">
                                    <input type='hidden' name="txtID" id="txtID" value='<?php echo $kode; ?>'>
                                    <input type='hidden' name="txtUser" id="txtUser" value='<?php echo $nama; ?>'>

                                <form class="form-horizontal" id="frmSetBobotKriteria">
                                    <?php
                                    $aspek = $db->ambil_data_user_sql("SELECT kategori_kriteria FROM tbl_kriteria GROUP BY kategori_kriteria ORDER BY kategori_kriteria ASC");
                                    $tot = sizeof($aspek);
                                    if ($tot > 0) {
                                        for ($i = 0; $i < $tot; $i++) {
                                            echo "<hr>";
                                            echo '<p>&nbsp;&nbsp;<font color="blue" size="3">ASPEK ' . strtoupper($aspek[$i][0]) . '</font></p>';
                                            echo "<hr>";
                                            //enumerate semua kriteria
                                            $kriteria = $db->ambil_data_user_sql("SELECT * FROM tbl_kriteria WHERE kategori_kriteria='" . $aspek[$i][0] . "' ORDER BY id_kriteria ASC");
                                            $tot1 = sizeof($kriteria);
                                            if ($tot1 > 0) {
                                                 echo "<table class='table-striped'";
                                                for ($j = 0; $j < $tot1; $j++) {
                                                   
                                                    echo "<tr>";
                                                    echo '<td>[' . ($j + 1) . '] ' . $kriteria[$j][2] . ' &nbsp;&nbsp;</td>';
                                                    echo '<td><select id=' . $kriteria[$j][0] . ' name=' . $kriteria[$j][0] . ' disabled>';
                                                    //membaca nilai bobot yang sudah tersimpan
                                                    $sql = "SELECT a.id_bobot_variabel_fk, b.nama_variabel 
                                                                FROM tbl_rating_kepentingan_kriteria a
                                                                INNER JOIN tbl_bobot_variabel_linguistik b
                                                                ON a.id_bobot_variabel_fk = b.id_bobot_variabel
                                                                WHERE id_user_rating_fk='$kode' AND id_kriteria_fk='" . $kriteria[$j][0] . "'";
                                                    $rating = $db->ambil_data_user_sql($sql);
                                                    $tot2 = sizeof($rating);

                                                    if ($tot2 > 0) {
                                                        $id_bobot = $kode . '-' . $rating[0][0];
                                                        $nilai_bobot = $rating[0][1];
                                                    } else {
                                                        $id_bobot = "NOT";
                                                        $nilai_bobot = "NOT SET";
                                                    }
                                                    //end                                                          
                                                    echo '<option value="' . $id_bobot . '" disabled selected>' . $nilai_bobot . '</option>';
                                                    if ($var_array = explode("#", $data_combo)) {
                                                        for ($k = 0; $k < count($var_array); $k++) {
                                                            if ($nilai_var_array = explode("-", $var_array[$k])) {
                                                                //echo '<option value='.$kode.'-'.$kriteria[$j][0].'-'.$nilai_var_array[0].'>'.$nilai_var_array[1].'</option>';
                                                                echo '<option value="' . $kode . '-' . $nilai_var_array[0] . '">' . $nilai_var_array[1] . '</option>';
                                                            }
                                                        }
                                                    }
                                                    echo '</select>';
                                                    echo "</td>";
                                                    echo "</tr>";                                                   
                                                }
                                                echo "</table>";
                                            }
                                            //end
                                        }
                                    }
                                    ?>



                                </form>
                                <div class="control-group">
                                    <div class="controls" id="aksi-edit">
                                        <button id="cmdEdit" class="btn btn-primary btn-large btn-success">EDIT</button>
                                    </div>
                                    <div class="controls" id="aksi-simpan" style="display: none;">
                                        <button id="cmdSimpan" class="btn btn-primary btn-large btn-danger ">Simpan</button>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-foot">
                                <div class="clearfix"></div> 
                                <div id='pesan'>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


        <!-- Matter ends --> 
        <script>
            function pesan(msg, tanda) {
                $("#pesan").html("");
                $("#pesan").removeClass();
                $("#pesan").addClass(tanda);
                $("#pesan").html(msg);
            }
            $("#cmdEdit").click(function() {
                $(".form-horizontal select").each(function() {
                    $(this).removeAttr("disabled");
                });
                //$("#pesan").hide();
                $("#aksi-edit").hide();
                $("#aksi-simpan").show();
            });
            $("#cmdSimpan").click(function() {
                //var id = $("#txtID").val();
                //var user = $("#txtUser").val();
                data = $("#frmSetBobotKriteria").serialize();
                data = data.split("=");
                data = data.join("-");
                data = data.split("&");
                data = data.join("#");
                $.ajax({
                    url: "MODUL/mod_rating/admin-set-bobot-kriteria-form_proses.php",
                    type: "POST",
                    data: "data=" + data,
                    cache: false,
                    beforeSend: function() {
                        pesan("Harap Tunggu...", "alert info");
                    },
                    success: function(st) {
                        pesan(st, "alert info");
                    }
                });
            });

        </script>

        <?php
    } else {
        header("Location: ../../admin-login.php");
    }
}
?>








