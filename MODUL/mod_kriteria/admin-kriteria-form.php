<?php
include "../../CLASS/kriteria.class.php";
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
        $kategori = "- Pilih Kriteria -";
        $nama = "";
        $judul = "TAMBAH DATA KRITERIA CALON PASANGAN";

        if ($mode == "modeEDIT") {
            $id_tmp = $_POST['id_tmp'];
            $db = new kriteria();
            $data = $db->ambil_data_kriteria("id_kriteria", $id_tmp);
            if (sizeof($data) == 1) {
                $id = $data[0][0];
                $kategori = $data[0][1];
                $nama = $data[0][2];
                $judul = "EDIT DATA KRITERIA CALON PASANGAN";
            }
        }
        ?>
        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <h2 class="pull-left">FORM KRITERIA
                <!-- page meta -->
                <span class="page-meta">Halaman form master data kriteria untuk calon pasangan</span>
            </h2>
            <!-- Breadcrumb -->
            <div class="bread-crumb pull-right">
                <a href="#"><i class="icon-home"></i> Home</a> 
                <!-- Divider -->
                <span class="divider">/</span> 
                <a href="#" class="bread-current">Form Kriteria</a>
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
                                    <h6>Input Data Kriteria</h6>
                                    <hr/>
                                </div>
                                <form class="form-horizontal">
                                    <input type='hidden' id='txtID' value="<?php echo($id_tmp); ?>">
                                    <input type='hidden' id='txtMode' value="<?php echo($mode); ?>">
                                    <div class="control-group">
                                        <label class="control-label" for="txtIDkriteria">ID Kriteria</label>
                                        <div class="controls">
                                            <input type="text" id="txtIDkriteria" value="<?php echo($id); ?>"/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="cmbKategori">Kategori</label>
                                        <div class="controls">
                                            <select id='cmbKategori'>
                                                <option value='' disabled selected><?php echo($kategori); ?></option>
                                                <option value='agama' >Agama</option>
                                                <option value='sosialbudaya'>Sosial Budaya</option>
                                                <option value='pendidikan'>Pendidikan</option>
                                                <option value='ekonomi'>Ekonomi</option>
                                                <option value='kepribadian'>Kepribadian (Personality)</option>
                                                <option value='fisik'>Fisik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtIDkriteria">Nama Kriteria</label>
                                        <div class="controls">
                                            <input type="text" id='txtNamaKategori' value="<?php echo($nama); ?>"/>
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
                var nama = $("#txtNamaKategori").val();
                var kategori = $("#cmbKategori").val();
                var mode = $("#txtMode").val();
                var id = $("#txtIDkriteria").val();
                var id_tmp = $("#txtID").val();
                if (id == "") {
                    pesan("ID kriteria tidak boleh dikosongkan", "alert alert-warning");
                } else {
                    if (kategori == "") {
                        pesan("Pilih dahulu kategori kriteria", "alert alert-warning");
                    } else {
                        if (nama == "") {
                            pesan("Nama Kriteria tidak boleh dikosongkan", "alert alert-warning");
                        } else {

                            $.ajax({
                                url: "modul/mod_kriteria/admin-kriteria-form_proses.php",
                                type: "POST",
                                data: "id=" + id + "&nama=" + nama + "&kategori=" + kategori + "&mode=" + mode + "&id_tmp=" + id_tmp,
                                cache: false,
                                beforeSend: function() {
                                    pesan("Harap Tunggu...", "alert alert-info");
                                },
                                success: function(st) {
                                    if (st == 1) {
                                        pesan("Berhasil Menyimpan Data", "alert alert-success");
                                    } else if (st == 3) {
                                        pesan("ID Kategori Sudah Terpakai, Coba dengan kombinasi ID Yang Lain", "alert alert-info");
                                    } else {
                                        pesan("Gagal Menyimpan Data", "alert alert-error");
                                    }
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








