<?php
include "../../CLASS/variabel.class.php";
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
        $id_tmp = "";
        $nama_variabel = "";
        $nilai_a = 0;
        $nilai_b = 0;
        $nilai_c = 0;
        $judul = "TAMBAH DATA VARIABEL LINGUISTIK";

        if ($mode == "modeEDIT") {
            $id_tmp = $_POST['id_tmp'];
            $db = new variabel();
            $data = $db->ambil_data_variabel("id_bobot_variabel", $id_tmp);
            if (sizeof($data) == 1) {
                $id = $data[0][0];
                $nama_variabel = $data[0][1];
                $nilai_a = $data[0][2];
                $nilai_b = $data[0][3];
                $nilai_c = $data[0][4];
                $judul = "EDIT DATA VARIABEL LINGUISTIK";
            }
        }
        ?>
        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <h2 class="pull-left">FORM VARIABEL LINGUISTIK
                <!-- page meta -->
                <span class="page-meta">Halaman form master data variabel untuk pembobotan kriteria</span>
            </h2>
            <!-- Breadcrumb -->
            <div class="bread-crumb pull-right">
                <a href="#"><i class="icon-home"></i> Home</a> 
                <!-- Divider -->
                <span class="divider">/</span> 
                <a href="#" class="bread-current">Form Variabel</a>
            </div>
            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->
        <div class="matter">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12"> 

                        <div class="widget worange">

                            <div class="widget-head">
                                <div class="pull-left"><?php echo($judul); ?></div>
                                <div class="widget-icons pull-right">
                                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget-content">
                                <div class="padd">
                                    <h6>Input Data Variabel</h6>
                                    <hr/>
                                </div>
                                <form class="form-horizontal">
                                    <input type='hidden' id='txtID' value="<?php echo($id_tmp); ?>">
                                    <input type='hidden' id='txtMode' value="<?php echo($mode); ?>">
                                    <div class="control-group">
                                        <label class="control-label" for="txtIDvariabel">ID Variabel</label>
                                        <div class="controls">
                                            <input type="text" id="txtIDvariabel" value="<?php echo($id); ?>"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtNamaVariabel">Nama Variabel</label>
                                        <div class="controls">
                                            <input type="text" id="txtNamaVariabel" value="<?php echo($nama_variabel); ?>"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtNilaiA">Nilai A (lower)</label>
                                        <div class="controls">
                                            <input type="number" id='txtNilaiA' value="<?php echo($nilai_a); ?>"/>
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label" for="txtNilaiB">Nilai B (medium)</label>
                                        <div class="controls">
                                            <input type="number" id='txtNilaiB' value="<?php echo($nilai_b); ?>"/>
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label" for="txtNilaiC">Nilai C (upper)</label>
                                        <div class="controls">
                                            <input type="number" id='txtNilaiC' value="<?php echo($nilai_c); ?>"/>
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <div class="controls">
                                            <button id ='cmdSimpan' class="btn btn-primary">Simpan</button>
                                            <button id ='cmdBatal' class="btn btn-danger">Batal</button>
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
            $("#cmdBatal").click(function() {
                $("#txtIDvariabel").val("");
                $("#txtNamaVariabel").val("");
                $("#txtNilaiA").val(0);
                $("#txtNilaiB").val(0);
                $("#txtNilaiC").val(0);
                $("#pesan").hide();
            });

            $("#cmdSimpan").click(function() {
                var nama = $("#txtNamaVariabel").val();
                var nilai_a = $("#txtNilaiA").val();
                var nilai_b = $("#txtNilaiB").val();
                var nilai_c = $("#txtNilaiC").val();
                var mode = $("#txtMode").val();
                var id = $("#txtIDvariabel").val();
                var id_tmp = $("#txtID").val();
                if (id == "") {
                    pesan("ID variabel tidak boleh dikosongkan", "alert warning");
                } else {
                    if (nama == "") {
                        pesan("Nama Variabel tidak boleh dikosongkan", "alert warning");
                    } else {
                        if (nilai_a == "") {
                            pesan("Nilai Variabel A (Upper) tidak boleh kosong", "alert warning");
                        } else {
                            if (nilai_b == "") {
                                pesan("Nilai Variabel B (Medium) tidak boleh kosong", "alert warning");
                            } else {
                                if (nilai_c == "") {
                                    pesan("Nilai Variabel A (Low) tidak boleh kosong", "alert warning");
                                } else {
                                    $.ajax({
                                        url: "modul/mod_variabel/admin-variabel-form_proses.php",
                                        type: "POST",
                                        data: "id=" + id + "&nama=" + nama + "&nilai_a=" + nilai_a + "&nilai_b=" + nilai_b + "&nilai_c=" + nilai_c + "&mode=" + mode + "&id_tmp=" + id_tmp,
                                        cache: false,
                                        beforeSend: function() {
                                            pesan("Harap Tunggu...", "alert info");
                                        },
                                        success: function(st) {
                                            if (st == 1) {
                                                pesan("Berhasil Menyimpan Data", "alert success");
                                            } else if (st == 3) {
                                                pesan("ID Variabel Sudah Terpakai, Coba dengan kombinasi ID Yang Lain", "alert info");
                                            } else {
                                                pesan("Gagal Menyimpan Data", "alert error");
                                            }
                                        }
                                    });
                                }
                            }
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








