<?php
//include 'CLASS/user.class.php';
include 'FUNGSI/fungsi.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <!-- Title and other stuffs -->
        <title>Halaman Admin - Calon Pasangan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">


        <!-- Stylesheets -->
        <link href="style/bootstrap.css" rel="stylesheet">
        <!-- Font awesome icon -->
        <link rel="stylesheet" href="style/font-awesome.css"> 
        <!-- jQuery UI -->
        <link rel="stylesheet" href="style/jquery-ui.css"> 
        <!-- Calendar -->
        <link rel="stylesheet" href="style/fullcalendar.css">
        <!-- prettyPhoto -->
        <link rel="stylesheet" href="style/prettyPhoto.css">   
        <!-- Star rating -->
        <link rel="stylesheet" href="style/rateit.css">
        <!-- Date picker -->
        <link rel="stylesheet" href="style/bootstrap-datetimepicker.min.css">
        <!-- jQuery Gritter -->
        <link rel="stylesheet" href="style/jquery.gritter.css">
        <!-- CLEditor -->
        <link rel="stylesheet" href="style/jquery.cleditor.css"> 
        <!-- Bootstrap toggle -->
        <link rel="stylesheet" href="style/bootstrap-toggle-buttons.css">
        <!-- Main stylesheet -->
        <link href="style/style.css" rel="stylesheet">
        <!-- Widgets stylesheet -->
        <link href="style/widgets.css" rel="stylesheet">   
        <!-- Responsive style (from Bootstrap) -->
        <link href="style/bootstrap-responsive.css" rel="stylesheet">
        <link href="style/jquery.mCustomScrollbar.css" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" href="img/favicon/favicon.png">
        <!-- JS -->
        <script src="js/jquery.js"></script> <!-- jQuery -->
        <script src="js/bootstrap.js"></script> <!-- Bootstrap -->
        <script src="js/jquery-ui-1.10.2.custom.min.js"></script> <!-- jQuery UI -->
        <script src="js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

        <script src="js/jquery.gritter.min.js"></script> <!-- jQuery Gritter -->
        <script src="js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
        <script src="js/jquery.toggle.buttons.js"></script> <!-- Bootstrap Toggle -->
        <script src="js/custom.js"></script> <!-- Custom codes -->      
	<style>
		.content{height:450px; overflow:auto; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;}
	</style>

    </head>

    <body>
        <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <!-- Menu button for smallar screens -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <!-- Site name for smallar screens -->
                    <a href="index.html" class="brand">CALON <span class="bold">PASANGAN</span></a>

                    <!-- Navigation starts -->
                    <div class="nav-collapse collapse">        

                        <!-- Links -->
                        <ul class="nav pull-right">
                            <li class="dropdown pull-right">            
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <?php
                                            if(empty($_SESSION['foto'])){
                                                $img = "foto-profil_50x50.png";
                                            }else{
                                                $nm = getName($_SESSION['foto']);
                                                $ex = getExtension($_SESSION['foto']);                                                
                                               $img = "USER_SPACE/".$_SESSION['id']."/".$nm."_50x50.".$ex; 
                                            }
                                    ?>
                                    <img src="<?php echo $img; ?>" alt="" class="nav-user-pic" /><?php echo $_SESSION['username']; ?> <b class="caret"></b>              
                                </a>

                                <!-- Dropdown menu -->
                                <ul class="dropdown-menu">
                                   <!-- <li><a href="#"><i class="icon-user"></i> Profil</a></li>
                                    <li><a href="#"><i class="icon-cogs"></i> Beranda</a></li> -->
                                    <li><a href="admin-logout.php"><i class="icon-off"></i> Logout</a></li>
                                </ul>
                            </li>

                        </ul>

                        <!-- Notifications -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Main content starts -->

