<?php
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
        include "admin-top.php";
        ?>      
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-inner">
                <div class="sidebar-widget">
                    </br>
                    <button id="cmdAnalisis" class="btn-danger btn-large btn-block"><center>Mulai Analisis</center></button>
                    <hr>
                    <button id="pilih" class="btn btn-block"><i class="icon-user"></i> Pilih Alternatif Calon</button>
                </div>
                <hr>
                <div class="sidebar-widget">
                    <!-- content block -->
                    <div id="content_1" class="content">
                        <table id="daftarCalon">
                        </table>    
                    </div>
                </div>
            </div>
        </div>
        <!-- end Sidebar -->
        <!-- Main bar -->
        <div class="mainbar">
            <!-- Page heading -->
            <div class="page-head">
                <!-- Page heading -->
                <h2 class="pull-left">LAB ANALISIS PROSES METODE FMCDM
                    <!-- page meta -->
                    <span class="page-meta">Halaman untuk pengujian analisis proses penentuan calon pasangan dengan metode Fuzzy Multi Criteria Decision Making</span>
                </h2>
                <div class="clearfix"></div>
            </div>
            <!-- Page heading ends -->
            <!-- Matter -->
            <div class="matter">
                    <div class="container-fluid" id="hasil_analisis">
                    <!-- content block -->
                    </div>                    
            </div>
            <!-- Matter ends -->


            <!-- modal -->
            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h5 id="myModalLabel"><i class="icon-user">  </i>Cari Alternatif Calon Pasangan yang Menjadi Kandidat</h5>
                </div>
                <div class="modal-body">
                    <p>Paramater Pencarian Kandidat Calon</p>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-filter"></i></span>
                        <select class="span2" id="txtFilterKandidat">
                            <!--<option value="all">All</option>-->
                            <option value="nama" selected>Nama</option>
                            <option value="asal">Tempat Tinggal</option>
                            <option value="status">Status Hubungan</option>
                        </select>
                    </div>
                    <div class="input-append">
                        <input type="text" id="txtCariKandidat" class="span3 search-query">
                        <!--<button id="cmdCariKandidat" class="btn">Search</button>-->
                    </div>
                    <div>
                        <table id="modalHasil" class='table table-hover'>                            
                        </table>
                    </div>


                </div>
                <div class="modal-footer">
                    <button id="cmdPilih" class="btn btn-primary">Tambahkan ke Daftar Kandidat</button>
                </div>
            </div>



        </div>

        <!-- Mainbar ends -->	    	
        <div class="clearfix"></div>
        </div>
        <!-- Content ends -->
        <script src="js/bootstrap-modal.js"></script> <!-- Custom codes -->      
        <script src="js/custom.js"></script> <!-- Custom codes -->      
        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom codes -->      
        <script src="js/lab-fmcdm.js"></script> <!-- Custom codes -->      
        </body>
        </html>

        <?php
    } else {
        header("Location: admin-login.php");
    }
}
?>