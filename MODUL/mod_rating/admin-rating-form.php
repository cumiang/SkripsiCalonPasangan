<?php
include "../../CLASS/rating.class.php";
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

        $mode = $_POST['mode'];
        $id = "";
        $id_user_rating = "- Pilih User -";
        $id_kriteria_rating = "- Pilih Kriteria -";
        $id_variabel_rating = "- Pilih Variabel -";
        $user = "";
        $kriteria = "";
        $variabel = "";
        $judul = "TAMBAH DATA RATING KEPENTINGAN";

        if ($mode == "modeEDIT") {
            $id = $_POST['id'];
            $user = $_POST['user'];
            $kriteria = $_POST['kriteria'];
            $variabel = $_POST['variabel'];
            $db = new rating();
            $data = $db->ambil_data_rating("id_rating_penting_kriteria", $id);
            if (sizeof($data) == 1) {
                $id = $data[0][0];
                $id_user_rating = $data[0][1];
                $id_kriteria_rating = $data[0][2];
                $id_variabel_rating = $data[0][3];
                $judul = "EDIT DATA RATING KEPENTINGAN";
            }
        }
        ?>
        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <h2 class="pull-left">FORM RATING
                <!-- page meta -->
                <span class="page-meta">Halaman form master data rating kepentingan kriteria terhadap alternatif</span>
            </h2>
            <!-- Breadcrumb -->
            <div class="bread-crumb pull-right">
                <a href="#"><i class="icon-home"></i> Home</a> 
                <!-- Divider -->
                <span class="divider">/</span> 
                <a href="#" class="bread-current">Form Rating</a>
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
                                <div class="pull-left"><?php echo($judul); ?></div>
                                <div class="widget-icons pull-right">
                                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget-content">
                                <div class="padd">
                                    <h6>Input Data Rating</h6>
                                    <hr/>
                                </div>
                                <form class="form-horizontal">
                                    <input type='hidden' id='txtID' value="<?php echo($id); ?>">
                                    <input type='hidden' id='txtMode' value="<?php echo($mode); ?>">

                                    <div class="control-group">
                                        <label class="control-label" for="cmbAlternatif">Alternatif Calon</label>
                                        <div class="controls">
                                            <select id='cmbAlternatif'>
                                                <option value='' disabled selected><?php echo($user); ?></option>
                                                <?php
                                                $db = new rating();
                                                $data = $db->ambil_data_view("CALL sp_user_list");
                                                $jumlah = sizeof($data);
                                                if ($jumlah > 0) {
                                                    for ($i = 0; $i < $jumlah; $i++) {
                                                        echo "<option value='" . $data[$i][0] . "' >" . $data[$i][1] . "</option>";
                                                    }
                                                }
                                                ?>       
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="cmbAlternatif">Kriteria Calon</label>
                                        <div class="controls">
                                            <select id='cmbKriteria'>
                                                <option value='' disabled selected><?php echo($kriteria); ?></option>
                                                <?php
                                                $db = new rating();
                                                $data = $db->ambil_data_view("CALL sp_kriteria_list");
                                                $jumlah = sizeof($data);
                                                if ($jumlah > 0) {
                                                    for ($i = 0; $i < $jumlah; $i++) {
                                                        echo "<option value='" . $data[$i][0] . "' >" . $data[$i][2] . "</option>";
                                                    }
                                                }
                                                ?>                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="cmbAlternatif">Rating Variabel</label>
                                        <div class="controls">
                                            <select id='cmbVariabel'>
                                                <option value='' disabled selected><?php echo($variabel); ?></option>
                                                <?php
                                                $db = new rating();
                                                $data = $db->ambil_data_view("CALL sp_variabel_list");
                                                $jumlah = sizeof($data);
                                                if ($jumlah > 0) {
                                                    for ($i = 0; $i < $jumlah; $i++) {
                                                        echo "<option value='" . $data[$i][0] . "' >" . $data[$i][1] . "</option>";
                                                    }
                                                }
                                                ?>                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button id ='cmdSimpan' class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
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

    $("#cmdSimpan").click(function() {
        var id_user_rating = $("#cmbAlternatif").val();
        var id_kriteria_rating = $("#cmbKriteria").val();
        var id_variabel_rating = $("#cmbVariabel").val();
        var mode = $("#txtMode").val();
        var id = $("#txtID").val();       
        if (id_user_rating == "") {
            pesan("Anda Harus Memilih Alternatif Calon", "alert warning");
        } else {
            if (id_kriteria_rating == "") {
                pesan("Anda Harus Memilih Kriteria Calon", "alert warning");
            } else {
                if (id_variabel_rating == "") {
                    pesan("Anda Harus Menentukan Rating Variabel", "alert warning");
                } else {
                    $.ajax({
                        url: "modul/mod_rating/admin-rating-form_proses.php",
                        type: "POST",
                        data: "id="+id+"&id_user_rating=" +id_user_rating + "&id_kriteria_rating=" + id_kriteria_rating +"&id_variabel_rating="+id_variabel_rating+"&mode="+mode,
                        cache: false,
                        beforeSend: function() {
                            pesan("Harap Tunggu...", "alert info");
                        },
                        success: function(st) {
                            if (st == 1) {
                                pesan("Berhasil Menyimpan Data", "alert success");
                            } else if (st == 3) {
                                pesan("User dengan kriteria yang dipilih sudah digunakan, coba dengan data yang lain", "alert info");
                            } else {
                                pesan("Gagal Menyimpan Data", "alert error");                           }
                        }
                    });
                }
            }
        }
    });

        </script>

        <?php
    } else {
        header("Location: ../../admin-login.php");
    }
}
?>








