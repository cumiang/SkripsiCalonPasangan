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
        $id = $_POST['id'];
        if (isset($id)) {
            $db = new user();
            $data = $db->ambil_data_user_sql("CALL sp_view_profil('$id')");
            if (sizeof($data) > 0) {
                $nonAktif = "disabled";
                $ng = $data[0]['negara_tempat_tinggal'];
                $ng = explode("-", (empty($ng)) ? " - " : $ng);
                $pv = $data[0]['provinsi_tempat_tinggal'];
                $pv = explode("-", (empty($pv)) ? " - " : $pv);
                $kt = $data[0]['kota_tempat_tinggal'];
                $kt = explode("-", (empty($kt)) ? " - " : $kt);
            } else {
                $nonAktif = "";
            }
        }
        ?>
        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <h2 class="pull-left">FORM UPDATE PROFIL
                <!-- page meta -->
                <span class="page-meta">Halaman update master data profil lengkap untuk calon pasangan</span>
            </h2>
            <!-- Breadcrumb -->
            <div class="bread-crumb pull-right">
                <a href="#"><i class="icon-home"></i> Home</a> 
                <!-- Divider -->
                <span class="divider">/</span> 
                <a href="#" class="bread-current">Form Profil</a>
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
                                <div class="pull-left"><?php echo("PROFIL"); ?></div>
                                <div class="widget-icons pull-right">
                                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget-content">
                                <div class="padd">
                                    <h6>Update Data Profil</h6>
                                    <hr/>
                                </div>
                                <form class='form-horizontal'>
                                    <div class="control-group">
                                        <label class="control-label" for="txtID">ID User</label>
                                        <div class="controls">
                                            <input class="input-small" type="text" name="txtID" id="txtID" value='<?php echo $id; ?>' disabled/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtUser">Nama User</label>
                                        <div class="controls">
                                            <input class="input-xxlarge" type="text" name="txtUser" id="txtUser" value='<?php echo $data[0]['nama_user']; ?>' <?php echo $nonAktif; ?>/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtNamaLengkap">Nama Lengkap</label>
                                        <div class="controls">
                                            <input class="input-xxlarge" type="text" class="input-large" name="txtNamaLengkap" id="txtNamaLengkap" value='<?php echo $data[0]['nama_lengkap']; ?>' <?php echo $nonAktif; ?>/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtNamaKecil">Nama Panggilan</label>
                                        <div class="controls">
                                            <input class="input-xxlarge" type="text" name="txtNamaKecil" id="txtNamaKecil" value='<?php echo $data[0]['nama_panggilan']; ?>' <?php echo $nonAktif; ?>/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtTempatLahir">Tempat Lahir</label>
                                        <div class="controls">
                                            <input class="input-xxlarge" type="text" name="txtTempatLahir" id="txtTempatLahir"  value='<?php echo $data[0]['tempat_lahir']; ?>' <?php echo $nonAktif; ?>/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtDate">Tanggal Lahir</label>
                                        <div class="controls">
                                            <input class="input-xxlarge" type="date" name="txtDate" id="txtDate" value='<?php echo $data[0]['tanggal_lahir']; ?>' <?php echo $nonAktif; ?>/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="cmbAgama">Agama</label>
                                        <div class="controls">
                                            <select class="input-xxlarge" name="cmbAgama" id="cmbAgama" <?php echo $nonAktif; ?>>
                                                <option value='<?php echo $data[0]['agama']; ?>' selected><?php echo $data[0]['agama']; ?></option>                                    
                                                <option value='Islam' >Islam</option>
                                                <option value='Kristen' >Kristen</option>
                                                <option value='Budha' >Budha</option>
                                                <option value='Hindu' >Hindu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="cmbJenkel">Jenis Kelamin</label>
                                        <div class="controls">
                                            <select class="input-xxlarge" name="cmbJenkel" id="cmbJenkel" <?php echo $nonAktif; ?>>
                                                <option  value='<?php echo $data[0]['jenis_kelamin']; ?>' selected><?php echo $data[0]['jenis_kelamin']; ?></option>                                    
                                                <option value='Laki-Laki' >Laki-Laki</option>
                                                <option value='Perempuan' >Perempuan</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label" for="cmbStatus">Status Hubungan</label>
                                        <div class="controls">
                                            <select class="input-xxlarge" name="cmbStatus" id="cmbStatus"  <?php echo $nonAktif; ?>>
                                                <option  value='<?php echo $data[0]['status_hubungan']; ?>' selected><?php echo $data[0]['status_hubungan']; ?></option>                                    
                                                <option value='Lajang' >Lajang</option>
                                                <option value='Menikah' >Menikah</option>
                                                <option value='Janda' >Janda</option>
                                                <option value='Duda' >Duda</option>
                                                <option value='Jalin Hubungan' >Menjalin Hubungan</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label" for="cmbAgama">Negara</label>
                                        <div class="controls">
                                            <select class="input-xxlarge" name="cmbNegara" id="cmbNegara"  <?php echo $nonAktif; ?>>
                                                <option  value='<?php echo $ng[0] . "-" . $ng[1]; ?>' selected><?php echo $ng[1]; ?></option>                                    
                                                <?php
                                                $db = new user();
                                                $negara = $db->ambil_data_user_sql("CALL sp_country_list");
                                                $jumlah = sizeof($negara);
                                                if ($jumlah > 0) {
                                                    for ($i = 0; $i < $jumlah; $i++) {
                                                        echo "<option value='" . $negara[$i][0] . "-" . $negara[$i][1] . "' >" . $negara[$i][1] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>  
                                    <div id="provinsi-kota">
                                        <?php
                                        if (sizeof($data) > 0) {
                                            ?>
                                            <div class="control-group">
                                                <label class="control-label" for="cmbProvinsi">Provinsi</label>
                                                <div class="controls">
                                                    <input class="input-xxlarge" type='text' name='cmbProvinsi' id='cmbProvinsi' value='<?php echo $pv[1]; ?>' <?php echo $nonAktif; ?>/>
                                                </div>
                                            </div>                                          
                                            <div class="control-group">
                                                <label class="control-label" for="cmbKota">Kota</label>
                                                <div class="controls">
                                                    <input class="input-xxlarge" type='text' name='cmbKota' id='cmbKota' value='<?php echo $kt[1]; ?>' <?php echo $nonAktif; ?>/>
                                                </div>
                                            </div>                                                  
                                            <?php
                                        }
                                        ?>
                                    </div>   
                                    <div class="control-group">
                                        <label class="control-label" for="txtAlamat">Alamat</label>
                                        <div class="controls">
                                            <textarea rows='3' class="input-xxlarge" name="txtAlamat" id="txtAlamat" <?php echo $nonAktif; ?>><?php echo $data[0]['alamat']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtPekerjaan">Pekerjaan</label>
                                        <div class="controls">
                                            <input class="input-xxlarge" type='text' name="txtPekerjaan" id="txtPekerjaan" value='<?php echo $data[0]['pekerjaan']; ?>' <?php echo $nonAktif; ?>/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="cmbPendidikan">Pendidikan</label>
                                        <div class="controls">
                                            <select class="input-xxlarge" name="cmbPendidikan" id="cmbPendidikan" <?php echo $nonAktif; ?>>
                                                <option  value='<?php echo $data[0]['pendidikan']; ?>' selected><?php echo $data[0]['pendidikan']; ?></option>                                                                      
                                                <option value='Tidak Ada' >Tidak Ada</option>
                                                <option value='SD' >SD</option>
                                                <option value='SMP' >SMP</option>
                                                <option value='SMU' >SMU</option>
                                                <option value='S1' >S1</option>
                                                <option value='S2' >S2</option>
                                                <option value='S3' >S3</option>
                                                <option value='Professor' >Professor</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label" for="txtKontak">Nomor Kontak</label>
                                        <div class="controls">
                                            <input class="input-xxlarge" type='number' name="txtKontak" id="txtKontak" placeholder="nomor HP atau Telpon Rumah" value='<?php echo $data[0]['no_kontak']; ?>' <?php echo $nonAktif; ?>/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="ttxtSitus">Situs Web</label>
                                        <div class="controls">
                                            <input class="input-xxlarge" type='text' name="txtSitus" id="txtSitus" placeholder="Alamat Website" value='<?php echo $data[0]['situs_web']; ?>' <?php echo $nonAktif; ?>/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtEmail">Email</label>
                                        <div class="controls">
                                            <input class="input-xxlarge" type='email' name="txtEmail" id="txtEmail" placeholder="E-mail" value='<?php echo $data[0]['email']; ?>' <?php echo $nonAktif; ?>/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="txtAlamat">Jejaring Sosial</label>
                                        <div class="controls">
                                            <input class="input-xxlarge" type='text' name="txtJejaring" id="txtJejaring" placeholder="Alamat Jejaring Sosial" value='<?php echo $data[0]['jejaring_sosial']; ?>' <?php echo $nonAktif; ?>/>
                                        </div>
                                    </div>
                                </form>

                                <div class="control-group">
                                    <div class="controls" id="aksi-edit">
                                        <button id="cmdEdit" class="btn btn-primary btn-large btn-success">Edit</button>
                                    </div>
                                    <div class="controls" id="aksi-simpan" style="display: none;">
                                        <button id="cmdSimpan" class="btn btn-primary btn-large">Simpan</button>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-foot">
                                <div class="clearfix"></div> 
                                <div id="message">
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
                $("#message").html("");
                $("#message").removeClass();
                $("#message").addClass(tanda);
                $("#message").html(msg);
            }


            $("#cmdEdit").click(function() {
                $("input").each(function() {
                    $(this).removeAttr("disabled");
                });
                $("select").each(function() {
                    $(this).removeAttr("disabled");
                });
                $("#txtAlamat").removeAttr("disabled");
                //$("#message").hide();
                $("#txtID").attr("disabled", true);
                $("#txtUser").attr("disabled",true);
                $("#aksi-edit").hide();
                $("#aksi-simpan").show();
            });

            $("#cmbNegara").change(function() {
                var ID = $(this).val();
                $.ajax({
                    url: "MODUL/mod_region/isi_combobox_provinsi.php",
                    type: "POST",
                    data: "ID=" + ID,
                    cache: false,
                    beforeSend: function() {
                        $("#provinsi-kota").html('<img src="../img/loading3.gif" alt="Memuat Data...."/>');
                    },
                    success: function(st) {
                        $("#provinsi-kota").html(st);
                    }
                });

            });


            $("#cmdSimpan").click(function() {
                var id = $("#txtID").val();
                //var user = $("#txtUser").val();
                var nama = $("#txtNamaLengkap").val();
                var nama_kecil = $("#txtNamaKecil").val();
                var tempat_lahir = $("#txtTempatLahir").val();
                var tanggal_lahir = $("#txtDate").val();
                var agama = $("#cmbAgama").val();
                var jenkel = $("#cmbJenkel").val();
                var status = $("#cmbStatus").val();
                var negara = $("#cmbNegara").val();
                var provinsi = $("#cmbProvinsi").val();
                var kota = $("#cmbKota").val();
                var alamat = $("#txtAlamat").val();
                var pekerjaan = $("#txtPekerjaan").val();
                var pendidikan = $("#cmbPendidikan").val();
                var kontak = $("#txtKontak").val();
                var situs = $("#txtSitus").val();
                var email = $("#txtEmail").val();
                var jejaring = $("#txtJejaring").val();
                var dataAjax = "id=" + id + "&nama=" + nama + "&nama_kecil=" + nama_kecil +
                        "&tempat_lahir=" + tempat_lahir + "&tanggal_lahir=" + tanggal_lahir +
                        "&agama=" + agama + "&jenkel=" + jenkel +
                        "&status=" + status + "&negara=" + negara +
                        "&provinsi=" + provinsi + "&kota=" + kota +
                        "&alamat=" + alamat + "&pekerjaan=" + pekerjaan +
                        "&pendidikan=" + pendidikan + "&kontak=" + kontak +
                        "&situs=" + situs + "&email=" + email + "&jejaring=" + jejaring;
                $.ajax({
                    url: "MODUL/mod_user/admin-profil-form_proses.php",
                    type: "POST",
                    data: dataAjax,
                    cache: false,
                    beforeSend: function() {
                        pesan("Harap Tunggu...", "alert alert-info");
                    },
                    success: function(st) {
                        pesan(st, "alert alert-info");
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








