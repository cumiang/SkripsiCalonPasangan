<?php
include "../../CLASS/user.class.php";
include "../../FUNGSI/fungsi.php";
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
        $id = $_POST['id'];
        $db = new user();
        $data = $db->ambil_data_user_sql("SELECT foto_profil,foto_sampul FROM tbl_profil_user WHERE id_user_profil_fk='$id'");
        if (sizeof($data) > 0) {
            if (!empty($data[0][0])) {
                $profil = $data[0][0];
                $profil_160 = getName($profil) . "_160x160." . getExtension($profil);
                $profil_50 = getName($profil) . "_50x50." . getExtension($profil);
            } else {
                $profil = "foto-profil.png";
            }
            if (!empty($data[0][1])) {
                $sampul = $data[0][1];
            } else {
                $sampul = "foto-sampul.png";
            }
        } else {
            $profil = "foto-profil.png";
            $profil_160 = "foto-profil_160x160.png";
            $profil_50 = "foto-profil_50x50.png";
            $sampul = "foto-sampul.png";
        }
        ?>
        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <h2 class="pull-left">FOTO PROFIL CALON PASANGAN
                <!-- page meta -->
                <span class="page-meta">Halaman form foto profil</span>
            </h2>
            <!-- Breadcrumb -->
            <div class="bread-crumb pull-right">
                <a href="#"><i class="icon-home"></i> Home</a> 
                <!-- Divider -->
                <span class="divider">/</span> 
                <a href="#" class="bread-current">Foto Profil</a>
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
                                <div class="pull-left">UPDATE FOTO PROFIL</div>
                                <div class="widget-icons pull-right">
                                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget-content">
                                <div class="padd">
                                    <h6>User <?php echo($id); ?></h6>
                                    <hr/>
                                </div>
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="frmProfilFoto" action="MODUL/mod_user/admin-user-foto_proses.php">
                                    <input type='hidden' id='txtID' name='txtID' value="<?php echo($id); ?>">
                                    <div class="control-group">
                                        <label class="control-label" for="imgProfil">Upload Foto</label>
                                        <div class="controls">
                                            <input class="file" type="file" id="imgProfil" name="imgProfil"/>
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label" for="imgOri">Foto Original</label>
                                        <div class="controls">
                                            <?php
                                            if (empty($profil)) {
                                                $imgOri = "USER_SPACE/foto-profil.png";
                                            } else {
                                                if (file_exists("../../USER_SPACE/" . $id . "/" . $profil)) {
                                                    $imgOri = "USER_SPACE/" . $id . "/" . $profil;
                                                } else {
                                                    $imgOri = "USER_SPACE/foto-profil.png";
                                                }
                                            }
                                            ?>                                            
                                            <img src="<?php echo $imgOri; ?>" class="img-polaroid" id="imgOri">
                                        </div></br>
                                        <label class="control-label" for="img160">Foto 160 x 160 Pixel</label>
                                        <div class="controls">
                                            <?php
                                            if (empty($profil_160)) {
                                                $img160 = "USER_SPACE/foto-profil_160x160.png";
                                            } else {
                                                if (file_exists("../../USER_SPACE/" . $id . "/" . $profil_160)) {
                                                    $img160 = "USER_SPACE/" . $id . "/" . $profil_160;
                                                } else {
                                                    $img160 = "USER_SPACE/foto-profil_160x160.png";
                                                }
                                            }
                                            ?>
                                            <img src="<?php echo $img160; ?>" class="img-polaroid" id="img160">
                                        </div></br>
                                        <label class="control-label" for="img50">Foto 50 x 50 Pixel</label>
                                        <div class="controls">
                                            <?php
                                            if (empty($profil_50)) {
                                                $img50 = "USER_SPACE/foto-profil_50x50.png";
                                            } else {
                                                if (file_exists("../../USER_SPACE/" . $id . "/" . $profil_50)) {
                                                    $img50 = "USER_SPACE/" . $id . "/" . $profil_50;
                                                } else {
                                                    $img50 = "USER_SPACE/foto-profil_50x50.png";
                                                }
                                            }
                                            ?>
                                            <img src="<?php echo $img50; ?>" class="img-polaroid" id="img50">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button id ='cmdSimpanFoto' class="btn btn-primary">Simpan</button>
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
                <div class="row-fluid">
                    <div class="span12"> 
                        <div class="widget wred">
                            <div class="widget-head">
                                <div class="pull-left">UPDATE FOTO SAMPUL</div>
                                <div class="widget-icons pull-right">
                                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget-content">
                                <div class="padd">
                                    <h6>User <?php echo($id); ?></h6>
                                    <hr/>
                                </div>
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="frmSampulFoto" action="MODUL/mod_user/admin-user-foto-sampul_proses.php">
                                    <input type='hidden' id='txtID' name='txtID' value="<?php echo($id); ?>">
                                    <div class="control-group">
                                        <label class="control-label" for="imgOri">Foto Cover (Sampul)</label>
                                        <div class="controls">
                                            <?php
                                            if (empty($sampul)) {
                                                $imgSampul = "USER_SPACE/foto-sampul.png";
                                            } else {
                                                if (file_exists("../../USER_SPACE/" . $id . "/" . $sampul)) {
                                                    $imgSampul = "USER_SPACE/" . $id . "/" . $sampul;
                                                } else {
                                                    $imgSampul = "USER_SPACE/foto-sampul.png";
                                                }
                                            }
                                            ?>                                               
                                            <img src="<?php echo $imgSampul; ?>" class="img-polaroid" id="imgSampulView">
                                        </div></br>
                                    </div>
                                    <hr>
                                    <div class="control-group">
                                        <label class="control-label" for="imgSampul">Upload Foto Sampul</label>
                                        <div class="controls">
                                            <input class="file" type="file" id="imgSampul" name="imgSampul"/>
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <div class="controls">
                                            <button id ='cmdSimpanSampul' class="btn btn-primary">Simpan</button>
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
            $("#cmdSimpanFoto").click(function() {
                $("#frmProfilFoto").submit(function(e) {
                });

            });
            $("#cmdSimpanSampul").click(function() {
                $("#frmSampulFoto").submit(function(e) {
                });

            });            
        </script>

        <?php
    } else {
        header("Location: ../../admin-login.php");
    }
}
?>








