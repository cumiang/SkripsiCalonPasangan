<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-inner">
        <!-- Search form -->
        <div class="sidebar-widget">
            <div class="media">
                <a class="pull-left" href="#">
                                    <?php
                                               $img2 = "USER_SPACE/".$_SESSION['id']."/".$nm."_160x160.".$ex; 

                                    ?>                    
                    <img class="media-object" src="<?php echo $img2; ?>" width="80" height="80">
                </a>
                <div class="media-body">
                    <h6 class="media-heading">Muh. Asrul Ismail</h6>
                    Makassar, Sulsel
                </div>
            </div>        
        </div>
        <!--- Sidebar navigation -->
        <!-- If the main navigation has sub navigation, then add the class "has_submenu" to "li" of main navigation. -->
        <ul class="navi">
            <!-- Use the class nred, ngreen, nblue, nlightblue, nviolet or norange to add background color. You need to use this in <li> tag. -->
            <li class="nred current"><a href="#"><i class="icon-desktop"></i> Menu Utama</a></li>
            <!-- Menu with sub menu -->
            <li class="ngreen"><a id="user" href="#"><i class="icon-user"></i> Data Calon Pasangan</a></li>
            <li class="has_submenu nviolet">
                <a href="#">
                    <i class="icon-table"></i> Data FMCDM
                    <span class="pull-right"><i class="icon-angle-right"></i></span>
                </a>

                <ul>
                    <li><a id="kriteria" href="#">Data Kriteria</a></li>
                    <li><a id="variabel" href="#">Data Variabel Linguistik</a></li>
                    <li><a id="rating" href="#">Data Rating Kepentingan</a></li>
                </ul>
            </li> 
            <li class="ngreen current"><a href="LAB-FMCDM.php"><i class="icon-tasks"></i> LAB Analisis FMCDM</a></li>
        </ul>
    </div>
</div>

<!-- Sidebar ends -->
<script>
     $("#kriteria").click(function() {
        $(".mainbar").html("<img src='img/loading.gif'> </br>Sedang Memuat Konten, Harap Tunggu..</img>");
        $.ajax({
            url: "MODUL/mod_kriteria/admin-kriteria-daftar.php",
            beforeSend: function() {
                $(".mainbar").attr("align","center");
                $(".mainbar").html("<img src='img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
            },
            success: function(html) {
                $(".mainbar").removeAttr("align");
                $(".mainbar").slideDown("slow").html(html);

            }
        });
    });   

     $("#variabel").click(function() {
        $(".mainbar").html("<img src='img/loading.gif'> </br>Sedang Memuat Konten, Harap Tunggu..</img>");
        $.ajax({
            url: "MODUL/mod_variabel/admin-variabel-daftar.php",
            beforeSend: function() {
                $(".mainbar").attr("align","center");
                $(".mainbar").html("<img src='img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
            },
            success: function(html) {
                $(".mainbar").removeAttr("align");
                $(".mainbar").slideDown("slow").html(html);
            }
        });
    });   
    
     $("#rating").click(function() {
        $(".mainbar").html("<img src='img/loading.gif'> </br>Sedang Memuat Konten, Harap Tunggu..</img>");
        $.ajax({
            url: "MODUL/mod_rating/admin-rating-daftar.php",
            beforeSend: function() {
                $(".mainbar").attr("align","center");
                $(".mainbar").html("<img src='img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
            },
            success: function(html) {
                $(".mainbar").removeAttr("align");
                $(".mainbar").slideDown("slow").html(html);
            }
        });
    });   

     $("#user").click(function() {
        $(".mainbar").html("<img src='img/loading.gif'> </br>Sedang Memuat Konten, Harap Tunggu..</img>");
        $.ajax({
            url: "MODUL/mod_user/admin-user-daftar.php",
            beforeSend: function() {
                $(".mainbar").attr("align","center");
                $(".mainbar").html("<img src='img/loading.gif'></br>Sedang Memuat Konten, Harap Tunggu..</img>");
            },
            success: function(html) {
                $(".mainbar").removeAttr("align");
                $(".mainbar").slideDown("slow").html(html);
            }
        });
    });   

</script>

