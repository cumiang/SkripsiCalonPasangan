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
    include "admin-top.php";
    include "admin-side.php";
    include "CLASS/user.class.php";
    if ($_SESSION['leveluser'] == 'admin') {
        ?>

        <!-- Main bar -->
        <div class="mainbar">
            <img  style="display: none" src='img/loading.gif'></img> 
            <!-- Page heading -->
            <div class="page-head">
                <!-- Page heading -->
                <h2 class="pull-left">DASHBOARD 
                    <!-- page meta -->
                    <span class="page-meta">Halaman Untuk Administrator Aplikasi Penentuan calon Pasangan</span>
                </h2>

                <!-- Breadcrumb -->
                <div class="bread-crumb pull-right">
                    <a href="index.html"><i class="icon-home"></i> Home</a> 
                    <!-- Divider -->
                    <span class="divider">/</span> 
                    <a href="#" class="bread-current">Halaman Utama</a>
                </div>

                <div class="clearfix"></div>

            </div>
            <!-- Page heading ends -->
            <!-- Matter -->
            <div class="matter">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="hero-unit">
                            <h1>SELAMAT DATANG</h1>
                            <p class="muted">Aplikasi Penentuan Calon Pasangan Dengan Metode <em>Fuzzy Multicriteria Decision Making</em></p></br>

                            <p class="text-success">
                                studi kasus bagaimana menemukan kandidat pasangan berdasarkan kriteria yang ditentukan 
                                dan kemudian didapatkan hasilnya berdasarkan kalkulasi matematis 
                                dengan menggunakan metode pengambilan keputusan <em>fuzzy Multi Criteria Decision Making.</em>

                            </p>
                            <p class="text-warning">
                                Hasil dari pemilihan alternatif terbaik kemudian disajikan dalam bentuk media jejaring sosial 
                                sehingga output atau keluaran yang dihasilkan menciptakan interaksi sosial diantara alternatif atau calon pasangan.
                            </p></br>
                            <p>
                                <small>Muh. Asrul Ismail</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Matter ends -->

        </div>

        <!-- Mainbar ends -->	    	
        <div class="clearfix"></div>
        <!-- Content ends -->

        <?php
        include "admin-bottom.php";
    } else {
        header("Location: admin-login.php");
    }
}
//
?>
