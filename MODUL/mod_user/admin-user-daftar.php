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
        $db = new user();
        ?>
        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <h2 class="pull-left">USER LOGIN/PROFIL CALON PASANGAN 
                <!-- page meta -->
                <span class="page-meta">Halaman Untuk Manajemen master data user untuk calon pasangan</span>
            </h2>
            <!-- Breadcrumb -->
            <div class="bread-crumb pull-right">
                <a href="#"><i class="icon-home"></i> Home</a> 
                <!-- Divider -->
                <span class="divider">/</span> 
                <a href="#" class="bread-current">Daftar User</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- Page heading ends -->
        <!-- Matter -->
        <div class="matter">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <button class="btn" type="button" id="cmdTambah">Tambahkan User</button>
                    </div>
                </div>
            <!--    <div class="span5 pull-right">
                    <div class="input-append">
                        <span class="add-on"><i class="icon-filter"></i></span>
                        <select class="span4" id="txtFilter">
                            <option value="id">ID USER</option>
                            <option value="nama">NAMA</option>
                            <option value="level">LEVEL</option>
                        </select>
                        <input class="span7" id="txtCari" type="text">
                        <button class="btn btn-primary" type="button" id="cmdCari"><i class="icon-search"></i> Cari</button>
                    </div>                    
                </div> -->

                <div class="row-fluid">
                    <div class="span12"> 

                        <div class="widget wblue">

                            <div class="widget-head">
                                <div class="pull-left">DAFTAR USER PROFIL CALON PASANGAN</div>
                                <div class="widget-icons pull-right">
                                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget-content">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID User</th>
                                            <th>Foto</th>
                                            <th>Nama User</th>
                                            <th>Password</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                            <th>Aksi FMCDM</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataRowDaftar">
                                        <?php
                                        $sql = "SELECT a.*, b.foto_profil 
                                                FROM tbl_user a 
                                                INNER JOIN  tbl_profil_user b 
                                                ON a.id_user = b.id_user_profil_fk";
                                        $data = $db->ambil_data_user_sql($sql);
                                        $jumlah = sizeof($data);
                                        if ($jumlah > 0) {
                                            for ($i = 0; $i < $jumlah; $i++) {
                                                echo "<tr id='" . $data[$i][0] . "'>";
                                                echo "<td>" . ($i + 1) . "</td>";
                                                echo "<td>" . $data[$i][0] . "</td>";
                                                if ((!file_exists("../../USER_SPACE/" . $data[$i][0] . "/" . $data[$i]["foto_profil"])) || (empty($data[$i]["foto_profil"]))) {
                                                    $icon = "USER_SPACE/foto-profil_50x50.png";
                                                } else {
                                                    $n = getName($data[$i]["foto_profil"]);
                                                    $e = getExtension($data[$i]["foto_profil"]);
                                                    $icon = "USER_SPACE/" . $data[$i][0] . "/" . $n . "_50x50." . $e;
                                                }

                                                echo "<td><img src='$icon' width='50' class='img-bulat' height='50' ></td>";
                                                echo "<td>" . $data[$i][1] . "</td>";
                                                echo "<td>" . $data[$i][2] . "</td>";
                                                echo "<td>" . $data[$i][3] . "</td>";
                                                echo "<td><center>";
                                                echo "<button class='btnEdit btn btn-small' data='" . $data[$i][0] . "'>";
                                                echo "<i class='icon-pencil'/>";
                                                echo "</button>";
                                                echo "<button class='btnHapus btn btn-small' data='" . $data[$i][0] . "'>";
                                                echo "<i class='icon-trash'/>";
                                                echo "</button>";
                                                echo "<button class='btnView btn btn-small' data='" . $data[$i][0] . "'>";
                                                echo "<i class='icon-user'/>";
                                                echo "</button>";
                                                echo "<button class='btnFoto btn btn-small' data='" . $data[$i][0] . "'>";
                                                echo "<i class='icon-picture'/>";
                                                echo "</button>";
                                                echo "</center>";
                                                echo "</td>";
                                                echo "<td>";
                                                echo "<button class='btnSetFMCDM btn btn-link' kode='" . $data[$i][0] . "' nama='" . $data[$i][1] . "'>";
                                                echo "Set Bobot Kriteria";
                                                echo "</button>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>                                                 
                                    </tbody>
                                </table>
                            </div>

                            <div class="widget-foot">
                                <div class="pagination pull-left">
                                    <span class="badge badge-inverse"><?php echo "Total " . $jumlah . " User"; ?></span>

                                </div>
                                <!-- <div class="pagination pull-right">
                                     <ul>
                                         <li><a href="#">Prev</a></li>
                                         <li><a href="#">1</a></li>
                                         <li><a href="#">Next</a></li>
                                     </ul>
                                 </div> -->
                                <div class="clearfix"></div> 

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>



        <!-- Matter ends --> 
        <?php
    } else {
        header("Location: ../../admin-login.php");
    }
}
?>
<script>
    $("#cmdTambah").click(function() {
        $.ajax({
            url: "MODUL/mod_user/admin-user-form.php",
            type: "POST",
            data: "id=0&mode=modeADD",
            cache: false,
            beforeSend: function() {
                $(".mainbar").attr("align", "center");
                $(".mainbar").html("<img src='img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
            },
            success: function(html) {
                $(".mainbar").removeAttr("align");
                $(".mainbar").slideDown("slow").html(html);
            }
        });
    });
    $(".btnEdit").click(function() {
        var id = $(this).attr('data');
        $.ajax({
            url: "MODUL/mod_user/admin-user-form.php",
            type: "POST",
            data: "id=" + id + "&mode=modeEDIT",
            cache: false,
            beforeSend: function() {
                $(".mainbar").attr("align", "center");
                $(".mainbar").html("<img src='img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
            },
            success: function(html) {
                $(".mainbar").removeAttr("align");
                $(".mainbar").slideDown("slow").html(html);
            }
        });
    });
    $(".btnHapus").click(function() {
        var id = $(this).attr('data');
        $.ajax({
            url: "MODUL/mod_user/admin-user-hapus_proses.php",
            type: "POST",
            data: "id=" + id,
            cache: false,
            success: function(html) {
                if (html == 1) {
                    $("#" + id).slideUp("slow", function() {
                        $(this).remove();
                    });
                }
            }
        });
    });

    $(".btnView").click(function() {
        var id = $(this).attr('data');
        $.ajax({
            url: "MODUL/mod_user/admin-profil-form.php",
            type: "POST",
            data: "id=" + id,
            cache: false,
            beforeSend: function() {
                $(".mainbar").attr("align", "center");
                $(".mainbar").html("<img src='img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
            },
            success: function(html) {
                $(".mainbar").removeAttr("align");
                $(".mainbar").slideDown("slow").html(html);
            }
        });
    });


    $(".btnFoto").click(function() {
        var id = $(this).attr('data');
        $.ajax({
            url: "MODUL/mod_user/admin-user-foto.php",
            type: "POST",
            data: "id=" + id,
            cache: false,
            beforeSend: function() {
                $(".mainbar").attr("align", "center");
                $(".mainbar").html("<img src='img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
            },
            success: function(html) {
                $(".mainbar").removeAttr("align");
                $(".mainbar").slideDown("slow").html(html);
            }
        });
    });

    $(".btnSetFMCDM").click(function() {
        var kode = $(this).attr('kode');
        var nama = $(this).attr('nama');
        $.ajax({
            url: "MODUL/mod_rating/admin-set-bobot-kriteria-form.php",
            type: "POST",
            data: "kode=" + kode + "&nama=" + nama,
            cache: false,
            beforeSend: function() {
                $(".mainbar").attr("align", "center");
                $(".mainbar").html("<img src='img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
            },
            success: function(html) {
                $(".mainbar").removeAttr("align");
                $(".mainbar").slideDown("slow").html(html);
            }
        });
    });
</script>
