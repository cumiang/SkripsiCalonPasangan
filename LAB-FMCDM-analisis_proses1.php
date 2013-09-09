<?php
include "CLASS/FMCDM.class.php";

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
        $data = $_POST["calon"];
        if (!empty($data)) {
            $calon = explode("#", $data);
            $db = new FMCDM();
            //inisialisasi variabel global untuk hasil aggregasi tiap alternatif
            //   for($j = 0; $j < sizeof($calon); $j++) {
            //          ${"FY" . ($j + 1)} = 0;
            //          ${"FQ" . ($j + 1)} = 0;
            //         ${"FZ" . ($j + 1)} = 0;
            //    }
        } else {
            echo "Pilih Dahulu Kandidat Calon Pasangan";
            exit();
        }
        ?>
        <!-- TAHAP KE-1  -->
        <div class="row-fluid" >      
            <div class="span12"> 
                <div class="widget wblue">
                    <div class="widget-head">
                        <div class="pull-left">Tahap 1 - Mendefinisikan Daftar Calon Pasangan</div>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>KODE</th>
                                    <th>NAMA CALON</th>
                                    <th>PREDIKAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>DM</td>
                                    <td><?php echo $_SESSION['username']; ?></td>
                                    <td>Pencari Pasangan (Decision Maker)</td>
                                </tr>
                                <?php
                                foreach ($calon as $index => $calon_val) {
                                    $calon_val_data = explode("|", $calon_val);
                                    echo "<tr>";
                                    echo "<td> A" . ($index + 1) . "</td>";
                                    echo "<td>{$calon_val_data[2]}</td>";
                                    echo "<td> Alternatif Calon Pasangan ke-" . ($index + 1) . "</td>";
                                    echo "</tr>";
                                }
                                ?>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- TAHAP KE-2  -->
        <div class="row-fluid" >   
            <div class="span12"> 
                <div class="widget wblue">
                    <div class="widget-head">
                        <div class="pull-left">Tahap 2 - Menentukan Rating Kepentingan (DM) dan Kecocokan (A) Calon Pasangan Terhadap Kriteria</div>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-content">                        
                        <div class="content-tahap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kriteria(C)</th>
                                        <?php
                                        $kriteria = $db->ambil_sql("SELECT id_kriteria FROM tbl_kriteria ORDER BY kategori_kriteria ASC");
                                        $tot = sizeof($kriteria);
                                        if ($tot > 0) {
                                            for ($i = 0; $i < $tot; $i++) {
                                                echo "<th>";
                                                echo $kriteria[$i][0];
                                                echo "</th>";
                                            }
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="<?php echo "USER_SPACE/" . $_SESSION['id'] . "/" . $_SESSION['foto']; ?>" class="img-circle" width="20" height="20">&nbsp;DM
                                        </td>
                                        <?php
                                        //START---------enumerate nilai variabel linguistik rating kepentingan
                                        if ($tot > 0) {
                                            for ($i = 0; $i < $tot; $i++) {
                                                $bobot = $db->ambil_nilai_bobot_rating($_SESSION['id'], $kriteria[$i][0]);
                                                if (sizeof($bobot) > 0) {
                                                    echo "<td>";
                                                    echo $bobot[0][0];
                                                    echo "</td>";
                                                } else {
                                                    echo "<td>";
                                                    echo "-";
                                                    echo "</td>";
                                                }
                                            }
                                        }
                                        //END--------------------------------------
                                        ?>
                                    </tr>
                                    <tr>
                                        <td colspan="<?php echo ($tot + 1); ?>">Daftar Alternatif / Kandidat Calon Pasangan (A)</td>
                                    </tr>
                                    <?php
                                    foreach ($calon as $index => $A_val) {
                                        $A_val_data = explode("|", $A_val);
                                        echo "<tr>";
                                        echo "<td>";
                                        echo '<img src="' . $A_val_data[1] . '" class="img-circle" width="20" height="20">&nbsp;A' . ($index + 1);
                                        echo "</td>";
                                        //START---------enumerate nilai variabel linguistik rating kepentingan
                                        if ($tot > 0) {
                                            for ($i = 0; $i < $tot; $i++) {
                                                $bobot = $db->ambil_nilai_bobot_rating($A_val_data[0], $kriteria[$i][0]);
                                                if (sizeof($bobot) > 0) {
                                                    echo "<td>";
                                                    echo $bobot[0][0];
                                                    echo "</td>";
                                                } else {
                                                    echo "<td>";
                                                    echo "-";
                                                    echo "</td>";
                                                }
                                            }
                                        }
                                        //END--------------------------------------
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <!-- TAHAP KE-3  -->
        <div class="row-fluid" >   
            <div class="span12"> 
                <div class="widget wblue">
                    <div class="widget-head">
                        <div class="pull-left">Tahap 3 - Mengkonversi Variabel Linguistik kedalam Fungsi Keanggotaan (Triangle Fuzzy Number)</div>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-content">                        
                        <div class="content-tahap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kriteria(C)</th>
                                        <?php
                                        $kriteria = $db->ambil_sql("SELECT id_kriteria FROM tbl_kriteria ORDER BY kategori_kriteria ASC");
                                        $tot = sizeof($kriteria);
                                        if ($tot > 0) {
                                            for ($i = 0; $i < $tot; $i++) {
                                                echo "<th>";
                                                echo $kriteria[$i][0];
                                                echo "</th>";
                                            }
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="<?php echo ($tot + 1); ?>">Bobot Variabel Linguistik dengan Triangle Fuzzy Number Untuk Pencari Calon (DM)</td>                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="<?php echo "USER_SPACE/" . $_SESSION['id'] . "/" . $_SESSION['foto']; ?>" class="img-circle" width="20" height="20">&nbsp;Rating DM
                                        </td>
                                        <?php
                                        //START---------enumerate nilai variabel linguistik rating kepentingan
                                        if ($tot > 0) {
                                            for ($i = 0; $i < $tot; $i++) {
                                                $bobot = $db->ambil_nilai_bobot_rating($_SESSION['id'], $kriteria[$i][0]);
                                                echo "<td>";
                                                if (sizeof($bobot) > 0) {
                                                    echo $bobot[0][0];
                                                } else {
                                                    echo "-";
                                                }
                                                echo "</td>";
                                            }
                                        }
                                        //END--------------------------------------
                                        ?>
                                    </tr>
                                    <?php
                                    //---VARIABEL LINGUISTIK---------------
                                    $variabel = $db->ambil_nilai_variabel_linguistik();
                                    ?>
                                    <tr>
                                        <td>Y</td>
                                        <?php
                                        if ($tot > 0) {
                                            for ($i = 0; $i < $tot; $i++) {
                                                $bobot = $db->ambil_nilai_bobot_rating($_SESSION['id'], $kriteria[$i][0]);
                                                if (sizeof($bobot) > 0) {
                                                    echo "<td>" . $variabel["{$bobot[0][0]}"]["Y"] . "</td>";
                                                } else {
                                                    echo "<td>0</td>";
                                                }
                                            }
                                        }
                                        ?> 
                                    </tr>
                                    <tr>
                                        <td>Q</td>
                                        <?php
                                        if ($tot > 0) {
                                            for ($i = 0; $i < $tot; $i++) {
                                                $bobot = $db->ambil_nilai_bobot_rating($_SESSION['id'], $kriteria[$i][0]);
                                                if (sizeof($bobot) > 0) {
                                                    echo "<td>" . $variabel["{$bobot[0][0]}"]["Q"] . "</td>";
                                                } else {
                                                    echo "<td>0</td>";
                                                }
                                            }
                                        }
                                        ?> 
                                    </tr>
                                    <tr>
                                        <td>Z</td>
                                        <?php
                                        if ($tot > 0) {
                                            for ($i = 0; $i < $tot; $i++) {
                                                $bobot = $db->ambil_nilai_bobot_rating($_SESSION['id'], $kriteria[$i][0]);
                                                if (sizeof($bobot) > 0) {
                                                    echo "<td>" . $variabel["{$bobot[0][0]}"]["Z"] . "</td>";
                                                } else {
                                                    echo "<td>0</td>";
                                                }
                                            }
                                        }
                                        ?> 
                                    </tr>

                                    <tr>
                                        <td colspan="<?php echo ($tot + 1); ?>">Bobot Variabel Linguistik dengan Triangle Fuzzy Number Untuk Alternatif Calon (A)</td>
                                    </tr>
                                    <?php
                                    foreach ($calon as $index => $A_val) {
                                        $A_val_data = explode("|", $A_val);
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo $A_val_data[1]; ?>" class="img-circle" width="20" height="20">&nbsp;Rating A<?php echo ($index + 1); ?>
                                            </td>
                                            <?php
                                            //START---------enumerate nilai variabel linguistik rating kepentingan
                                            if ($tot > 0) {
                                                for ($i = 0; $i < $tot; $i++) {
                                                    $bobot = $db->ambil_nilai_bobot_rating($A_val_data[0], $kriteria[$i][0]);
                                                    echo "<td>";
                                                    if (sizeof($bobot) > 0) {
                                                        echo $bobot[0][0];
                                                    } else {
                                                        echo "-";
                                                    }
                                                    echo "</td>";
                                                }
                                            }
                                            //END--------------------------------------
                                            ?>
                                        </tr>
                                        <?php
                                        //---VARIABEL LINGUISTIK---------------
                                        $variabel = $db->ambil_nilai_variabel_linguistik();
                                        ?>
                                        <tr>
                                            <td>Y</td>
                                            <?php
                                            if ($tot > 0) {
                                                for ($i = 0; $i < $tot; $i++) {
                                                    $bobot = $db->ambil_nilai_bobot_rating($A_val_data[0], $kriteria[$i][0]);
                                                    if (sizeof($bobot) > 0) {
                                                        echo "<td>" . $variabel["{$bobot[0][0]}"]["Y"] . "</td>";
                                                    } else {
                                                        echo "<td>0</td>";
                                                    }
                                                }
                                            }
                                            ?> 
                                        </tr>
                                        <tr>
                                            <td>Q</td>
                                            <?php
                                            if ($tot > 0) {
                                                for ($i = 0; $i < $tot; $i++) {
                                                    $bobot = $db->ambil_nilai_bobot_rating($A_val_data[0], $kriteria[$i][0]);
                                                    if (sizeof($bobot) > 0) {
                                                        echo "<td>" . $variabel["{$bobot[0][0]}"]["Q"] . "</td>";
                                                    } else {
                                                        echo "<td>0</td>";
                                                    }
                                                }
                                            }
                                            ?> 
                                        </tr>
                                        <tr>
                                            <td>Z</td>
                                            <?php
                                            if ($tot > 0) {
                                                for ($i = 0; $i < $tot; $i++) {
                                                    $bobot = $db->ambil_nilai_bobot_rating($A_val_data[0], $kriteria[$i][0]);
                                                    if (sizeof($bobot) > 0) {
                                                        echo "<td>" . $variabel["{$bobot[0][0]}"]["Z"] . "</td>";
                                                    } else {
                                                        echo "<td>0</td>";
                                                    }
                                                }
                                            }
                                            ?> 
                                        </tr>






                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <!-- TAHAP KE-4  -->
        <div class="row-fluid" >   
            <div class="span12"> 
                <div class="widget wblue">
                    <div class="widget-head">
                        <div class="pull-left">Tahap 4 - Mengaggregasikan bobot kriteria pilihan dengan derajat kepentingan menggunakan rumus Mean(F)</div>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-content">                        
                        <div class="content-tahap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kriteria(C)</th>
                                        <?php
                                        $kriteria = $db->ambil_sql("SELECT id_kriteria FROM tbl_kriteria ORDER BY kategori_kriteria ASC");
                                        $tot = sizeof($kriteria);
                                        if ($tot > 0) {
                                            for ($i = 0; $i < $tot; $i++) {
                                                echo "<th>";
                                                echo $kriteria[$i][0];
                                                echo "</th>";
                                            }
                                        }
                                        ?>
                                        <th colspan="2">&sum;C = <?php echo $tot; ?> Kriteria</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($calon as $index => $A_val) {
                                        $A_val_data = explode("|", $A_val);
                                        ?>

                                        <tr>
                                            <td colspan = "<?php echo ($tot + 3); ?>">Hasil Aggregasi Antara Pencari Calon(DM) dengan Alternatif Calon Ke-<?php echo ($index + 1); ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src = "<?php echo "USER_SPACE/" . $_SESSION['id'] . "/" . $_SESSION['foto']; ?>" class = "img-circle" width = "20" height = "20">&nbsp;Rating DM
                                            </td>
                                            <?php
                                            //START---------enumerate nilai variabel linguistik rating kepentingan
                                            if ($tot > 0) {
                                                for ($i = 0; $i < $tot; $i++) {
                                                    $bobot = $db->ambil_nilai_bobot_rating($_SESSION['id'], $kriteria[$i][0]);
                                                    if (sizeof($bobot) > 0) {
                                                        echo "<td>";
                                                        echo $bobot[0][0];
                                                        echo "</td>";
                                                    } else {
                                                        echo "<td>";
                                                        echo "-";
                                                        echo "</td>";
                                                    }
                                                }
                                            }
                                            //END--------------------------------------
                                            ?>
                                            <td rowspan="2" style="vertical-align: middle;">Total</br>(T)</td>
                                            <td rowspan="2" style="vertical-align: middle;">F(Mean)</br>=T/&sum;C</td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <img src = "<?php echo $A_val_data[1]; ?>" class = "img-circle" width = "20" height = "20">&nbsp;Rating A<?php echo ($index + 1); ?>
                                            </td>
                                            <?php
                                            //START---------enumerate nilai variabel linguistik rating kepentingan
                                            if ($tot > 0) {
                                                for ($i = 0; $i < $tot; $i++) {
                                                    $bobot = $db->ambil_nilai_bobot_rating($A_val_data[0], $kriteria[$i][0]);
                                                    if (sizeof($bobot) > 0) {
                                                        echo "<td>";
                                                        echo $bobot[0][0];
                                                        echo "</td>";
                                                    } else {
                                                        echo "<td>";
                                                        echo "-";
                                                        echo "</td>";
                                                    }
                                                }
                                            }
                                            //END--------------------------------------
                                            ?>

                                        </tr>
                                        <?php
                                        //---VARIABEL LINGUISTIK---------------
                                        $variabel = $db->ambil_nilai_variabel_linguistik();
                                        ?>
                                        <tr>
                                            <td>Y(DM)x Y(A<?php echo ($index + 1); ?>)</td>
                                            <?php
                                            if ($tot > 0) {
                                                $T = 0;
                                                for ($i = 0; $i < $tot; $i++) {
                                                    $bobotDM = $db->ambil_nilai_bobot_rating($_SESSION['id'], $kriteria[$i][0]);
                                                    $bobotA = $db->ambil_nilai_bobot_rating($A_val_data[0], $kriteria[$i][0]);
                                                    if (sizeof($bobotDM) > 0) {
                                                        $DM = $variabel["{$bobotDM[0][0]}"]["Y"];
                                                    } else {
                                                        $DM = 0;
                                                    }
                                                    if (sizeof($bobotA) > 0) {
                                                        $A = $variabel["{$bobotA[0][0]}"]["Y"];
                                                    } else {
                                                        $A = 0;
                                                    }
                                                    $hasilkaliDM_A = $DM * $A;
                                                    echo "<td>" . round($hasilkaliDM_A, 2) . "</td>";
                                                    $T = $T + $hasilkaliDM_A;
                                                }
                                                ${"FY" . ($index + 1)} = $T / $tot;
                                                echo "<td>" . round($T, 2) . "</td>";
                                                echo "<td>" . round(${"FY" . ($index + 1)}, 3) . "</td>";
                                            }
                                            ?> 
                                        </tr>
                                        <tr>
                                            <td>Q(DM)x Q(A<?php echo ($index + 1); ?>)</td>
                                            <?php
                                            if ($tot > 0) {
                                                $T = 0;
                                                for ($i = 0; $i < $tot; $i++) {
                                                    $bobotDM = $db->ambil_nilai_bobot_rating($_SESSION['id'], $kriteria[$i][0]);
                                                    $bobotA = $db->ambil_nilai_bobot_rating($A_val_data[0], $kriteria[$i][0]);
                                                    if (sizeof($bobotDM) > 0) {
                                                        $DM = $variabel["{$bobotDM[0][0]}"]["Q"];
                                                    } else {
                                                        $DM = 0;
                                                    }
                                                    if (sizeof($bobotA) > 0) {
                                                        $A = $variabel["{$bobotA[0][0]}"]["Q"];
                                                    } else {
                                                        $A = 0;
                                                    }
                                                    $hasilkaliDM_A = $DM * $A;
                                                    echo "<td>" . round($hasilkaliDM_A, 2) . "</td>";
                                                    $T = $T + $hasilkaliDM_A;
                                                }
                                                ${"FQ" . ($index + 1)} = $T / $tot;
                                                echo "<td>" . round($T, 2) . "</td>";
                                                echo "<td>" . round(${"FQ" . ($index + 1)}, 3) . "</td>";
                                            }
                                            ?> 
                                        </tr>
                                        <tr>
                                            <td>Z(DM)x Z(A<?php echo ($index + 1); ?>)</td>
                                            <?php
                                            if ($tot > 0) {
                                                $T = 0;
                                                for ($i = 0; $i < $tot; $i++) {
                                                    $bobotDM = $db->ambil_nilai_bobot_rating($_SESSION['id'], $kriteria[$i][0]);
                                                    $bobotA = $db->ambil_nilai_bobot_rating($A_val_data[0], $kriteria[$i][0]);
                                                    if (sizeof($bobotDM) > 0) {
                                                        $DM = $variabel["{$bobotDM[0][0]}"]["Z"];
                                                    } else {
                                                        $DM = 0;
                                                    }
                                                    if (sizeof($bobotA) > 0) {
                                                        $A = $variabel["{$bobotA[0][0]}"]["Z"];
                                                    } else {
                                                        $A = 0;
                                                    }
                                                    $hasilkaliDM_A = $DM * $A;
                                                    echo "<td>" . round($hasilkaliDM_A, 2) . "</td>";
                                                    $T = $T + $hasilkaliDM_A;
                                                }
                                                ${"FZ" . ($index + 1)} = $T / $tot;
                                                echo "<td>" . round($T, 2) . "</td>";
                                                echo "<td>" . round(${"FZ" . ($index + 1)}, 3) . "</td>";
                                            }
                                            ?> 
                                        </tr>

                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <!-- TAHAP KE-5  -->
        <div class="row-fluid" >   
            <div class="span6"> 
                <div class="widget wgreen">
                    <div class="widget-head">
                        <div class="pull-left">Tahap 5 - Merangkum Semua Hasil Aggregasi Semua Alternatif Terhadap Kriterianya</div>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-content">                        
                        <div class="content-tahap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Y = a</th>
                                        <th>Q = b</th>
                                        <th>Z = c</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($calon as $index => $A_val) {
                                        $A_val_data = explode("|", $A_val);
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo $A_val_data[1]; ?>" class="img-circle" width="20" height="20">&nbsp;A<?php echo ($index + 1); ?>
                                            </td>
                                            <td><?php echo round(${"FY" . ($index + 1)}, 8); ?></td>
                                            <td><?php echo round(${"FQ" . ($index + 1)}, 8); ?></td>
                                            <td><?php echo round(${"FZ" . ($index + 1)}, 8); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="span6"> 
                <div class="widget wgreen">
                    <div class="widget-head">
                        <div class="pull-left">Tahap 6 - Perangkingan dengan Metode Nilai Total Integral sesuai indeks keoptimisan alpha</div>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-content">                        
                        <div class="content-tahap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>&alpha;1 = 0</th>
                                        <th>&alpha;2 = 0,5</th>
                                        <th>&alpha;3 = 1</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($calon as $index => $A_val) {
                                        $A_val_data = explode("|", $A_val);
                                        $alpha0 = 0;
                                        $alpha0_5 = 0.5;
                                        $alpha1 = 1;
                                        $y = ${"FY" . ($index + 1)};
                                        $q = ${"FQ" . ($index + 1)};
                                        $z = ${"FZ" . ($index + 1)};
                                        $F_alpha1 = (($alpha0 * $z) + $q + ((1 - $alpha0) * $y)) / 2;
                                        $F_alpha2 = (($alpha0_5 * $z) + $q + ((1 - $alpha0_5) * $y)) / 2;
                                        $F_alpha3 = (($alpha1 * $z) + $q + ((1 - $alpha1) * $y)) / 2;

                                        ${"rankingA_" . ($index + 1)} = $F_alpha1 + $F_alpha2 + $F_alpha3;
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo $A_val_data[1]; ?>" class="img-circle" width="20" height="20">&nbsp;A<?php echo ($index + 1); ?>
                                            </td>
                                            <td><?php echo round($F_alpha1, 8); ?></td>
                                            <td><?php echo round($F_alpha2, 8); ?></td>
                                            <td><?php echo round($F_alpha3, 8); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row-fluid"> 
                <div class="span12"> 
                    <div class="widget wred">
                        <div class="widget-head">
                            <div class="pull-left">KESIMPULAN PENETUAN CALON PASANGAN TERBAIK</div>
                            <div class="widget-icons pull-right">
                                <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget-content">                        
                            <table class="table table-bordered">
                                <?php
                                foreach ($calon as $index => $A_val) {
                                    $A_val_data = explode("|", $A_val);

                                    ${"rankingA_" . ($index + 1)} = ${"rankingA_" . ($index + 1)} / 1 * 100;
                                    $persen = round(${"rankingA_" . ($index + 1)}, 1);
                                    ?>   
                                    <tr>
                                        <td style="vertical-align: middle;">A<?php echo ($index + 1); ?>&nbsp;&nbsp;
                                        <img src="<?php echo $A_val_data[1]; ?>" class="img-circle" width="30" height="30">
                                        </td>
                                        <td>  
                                            <?php echo $A_val_data[2]; ?> 
                                            <div class="progress progress-striped">
                                                <div class="bar bar-info" data-percentage="<?php echo $persen; ?>" style="width: <?php echo $persen; ?>%;"/>&nbsp;&nbsp;<?php echo round(${"rankingA_" . ($index + 1)}, 1); ?> %
                                            </div>                                             
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="js/custom.js"></script> <!-- Custom codes -->      
        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom codes -->      
        <script>
            $(".content-tahap").mCustomScrollbar({
                scrollButtons: {
                    enable: true
                },
                theme: "light-thin",
                horizontalScroll: true
            });
        </script>
        <?php
    } else {
        header("Location: admin-login.php");
    }
}
?>
