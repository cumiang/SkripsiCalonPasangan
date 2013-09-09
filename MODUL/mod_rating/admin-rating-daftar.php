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
        $db = new rating();
        ?>
        <!-- Page heading -->
        <div class="page-head">
            <!-- Page heading -->
            <h2 class="pull-left">RATING KEPENTINGAN KRITERIA TERHADAP ALTERNATIF 
                <!-- page meta -->
                <span class="page-meta">Halaman Untuk Manajemen master data rating kepentingan terhadap alternatif calon pasangan</span>
            </h2>
            <!-- Breadcrumb -->
            <div class="bread-crumb pull-right">
                <a href="#"><i class="icon-home"></i> Home</a> 
                <!-- Divider -->
                <span class="divider">/</span> 
                <a href="#" class="bread-current">Daftar Rating</a>
            </div>
            <div class="clearfix"></div>

        </div>
        <!-- Page heading ends -->

        <!-- Matter -->
        <div class="matter">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <button class="btn" type="button" id="cmdTambah">Tambahkan Rating</button>
                    </div>
               <!--     <div class="span5 pull-right">
                        <div class="input-append">
                            <span class="add-on"><i class="icon-filter"></i></span>
                            <select class="span4" id="txtFilter">
                                <option value="alternatif">ALTERNATIF</option>
                                <option value="kriteria">KRITERIA</option>
                                <option value="rating">RATING</option>
                            </select>
                            <input class="span7" id="txtCari" type="text">
                            <button class="btn btn-primary" type="button" id="cmdCari"><i class="icon-search"></i> Cari</button>
                        </div>                    
                    </div> -->
                </div>
                <div class="row-fluid">
                    <div class="span12"> 

                        <div class="widget wred">

                            <div class="widget-head">
                                <div class="pull-left">DAFTAR RATING</div>
                                <div class="widget-icons pull-right">
                                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="widget-content">

                                <table class="table  table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Alternatif calon</th>
                                            <th>Kriteria Calon</th>
                                            <th>Rating Kepentingan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataRowDaftar">
                                        <?php
                                        $data = $db->ambil_data_rating_sql("CALL sp_rating_list");
                                        $jumlah = sizeof($data);
                                        if ($jumlah > 0) {
                                            for ($i = 0; $i < $jumlah; $i++) {
                                                echo "<tr id='" . $data[$i][0] . "'>";
                                                echo "<td>" . ($i + 1) . "</td>";
                                            echo "<td>".$data[$i]['nama_user'] . " Terhadap</td>";
                                            echo "<td>".$data[$i]['nama_kriteria']." (".$data[$i]['id_kriteria_fk'] .") yaitu</td>";
                                            echo "<td>".$data[$i]['id_bobot_variabel_fk'] ." (".$data[$i]['nama_variabel']. ")</td>";
                                                echo "<td>";
                                                echo "<center>";
                                                echo "<button class='btnEdit btn btn-small btn-success' data='" . $data[$i][0] . "' data-user='".$data[$i]['nama_user']."' data-kriteria='".$data[$i]['nama_kriteria']."' data-variabel='".$data[$i]['nama_variabel']."'>";
                                                echo "<i class='icon-pencil'/>";
                                                echo "</button>";
                                                echo "<button class='btnHapus btn btn-small btn-danger' data='" . $data[$i][0] . "'>";
                                                echo "<i class='icon-trash'/>";
                                                echo "</button>";
                                                echo "</center>";
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
                                    <span class="badge badge-inverse"><?php echo "Total " . $jumlah . " Rating"; ?></span>

                                </div>
                           <!--     <div class="pagination pull-right">
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
            url: "MODUL/mod_rating/admin-rating-form.php",
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
                var user = $(this).attr('data-user');
                var kriteria = $(this).attr('data-kriteria');
                var variabel = $(this).attr('data-variabel');
                $.ajax({
                    url: "MODUL/mod_rating/admin-rating-form.php",
                    type: "POST",
                    data: "id=" + id + "&mode=modeEDIT"+ "&user="+user+ "&kriteria="+kriteria+ "&variabel="+variabel,
                    cache: false,
                    success: function(html) {
                $(".mainbar").removeAttr("align");
                $(".mainbar").slideDown("slow").html(html);
                    }
                });
            });

            $(".btnHapus").click(function() {
                var id = $(this).attr('data');
                $.ajax({
                    url: "MODUL/mod_rating/admin-rating-hapus_proses.php",
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
    
    

</script>