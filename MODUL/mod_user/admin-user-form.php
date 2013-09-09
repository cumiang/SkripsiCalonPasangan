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
        $mode = $_POST['mode'];
        $id = "";
        $nama = "";
        $pass = "";
        $level = "- Pilih Hak Akses -";
        $judul = "TAMBAH DATA USER";

        if ($mode == "modeEDIT") {
            $id = $_POST['id'];
            $db = new user();
            $data = $db->ambil_data_user("id_user", $id);
            if (sizeof($data) == 1) {
                $nama = $data[0][1];
                $pass = $data[0][2];
                $level = $data[0][3];
                $judul = "EDIT DATA USER";
            }
        }
        ?>
        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <h2 class="pull-left">FORM USER
                <!-- page meta -->
                <span class="page-meta">Halaman form master data user untuk calon pasangan</span>
            </h2>
            <!-- Breadcrumb -->
            <div class="bread-crumb pull-right">
                <a href="#"><i class="icon-home"></i> Home</a> 
                <!-- Divider -->
                <span class="divider">/</span> 
                <a href="#" class="bread-current">Form User</a>
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
                                    <h6>Input Data User</h6>
                                    <hr/>
                                </div>
                                <form class="form-horizontal">
                                    <input type='hidden' id='txtID' value="<?php echo($id); ?>">
                                    <input type='hidden' id='txtMode' value="<?php echo($mode); ?>">
                                    <div class="control-group">
                                        <label class="control-label" for="txtUser">Nama User</label>
                                        <div class="controls">
                                            <input type="text" id="txtUser" value="<?php echo($nama); ?>"/>
                                        </div>
                                    </div>
                                    <?php
                                    if ($mode == "modeEDIT") {
                                        echo '<div class="control-group">';
                                        echo '<label class="control-label" for="txtPass">Password Lama</label>';
                                        echo '<div class="controls">';
                                        echo '<input type="text" id="txtPassLama" value="'.$pass.'" disabled/>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    ?>

                                    <div class="control-group">
                                        <label class="control-label" for="txtPass">Password Baru</label>
                                        <div class="controls">
                                            <input type="text" id='txtPassBaru' value=""/>
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label" for="cmbKategori">Level User</label>
                                        <div class="controls">
                                            <select id='cmbLevel'>
                                                <option value='' disabled selected><?php echo($level); ?></option>
                                                <option value='user' >User</option>
                                                <option value='admin'>Administrator</option>
                                            </select>
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
                $("#txtUser").val("");
                $("#txtPass").val("");
                $("#pesan").hide();
            });
            $("#cmdSimpan").click(function() {
                var nama = $("#txtUser").val();
                var pass = $("#txtPassBaru").val();
                var level = $("#cmbLevel").val();
                var mode = $("#txtMode").val();
                var id = $("#txtID").val();
                if (nama == "") {
                    pesan("nama tidak boleh dikosongkan", "alert warning");
                } else {
                    if (pass == "") {
                        pesan("password tidak boleh dikosongkan", "alert warning");
                    } else {
                        if (level == "") {
                            pesan("Anda Harus Memilih Hak Akses", "alert warning");
                        } else {
                            $.ajax({
                                url: "MODUL/mod_user/admin-user-form_proses.php",
                                type: "POST",
                                data: "id=" + id + "&nama=" + nama + "&pass=" + pass + "&level=" + level + "&mode=" + mode,
                                cache: false,
                                beforeSend: function() {
                                    pesan("Harap Tunggu...", "alert info");
                                },
                                success: function(st) {
                                    if (st == 1) {
                                        pesan("Berhasil Menyimpan Data", "alert success");
                                    } else if (st == 3) {
                                        pesan("Nama User Sudah Terpakai, Coba dengan Nama Yang Lain", "alert info");
                                    } else {
                                        pesan("Gagal Menyimpan Data, error pada : " + st, "alert error");
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








