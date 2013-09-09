<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <!-- Title and other stuffs -->
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">

        <!-- Stylesheets -->
        <link href="style/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="style/font-awesome.css">
        <link href="style/style.css" rel="stylesheet">
        <link href="style/bootstrap-responsive.css" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" href="img/favicon/favicon.png">
    </head>

    <body>

        <!-- Form area -->
        <div class="admin-form">
            <div class="container-fluid">

                <div class="row-fluid">
                    <div class="span12">
                        <!-- Widget starts -->
                        <div class="widget wblue">
                            <!-- Widget head -->
                            <div class="widget-head">
                                <i class="icon-lock"></i> Login Administrator 
                            </div>

                            <div class="widget-content">
                                <div class="padd">
                                    <!-- Login form -->
                                    <form class="form-horizontal" method="POST" action="admin-login-proses.php">
                                        <!-- User -->
                                        <div class="control-group">
                                            <label class="control-label" for="user">Nama User</label>
                                            <div class="controls">
                                                <div class="input-prepend">
                                                    <span class="add-on"><i class="icon-user"></i></span>
                                                    <input class="span12" name="user" id="user" type="text" placeholder="Input Username">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Password -->
                                        <div class="control-group">
                                            <label class="control-label" for="pass">Password</label>
                                            <div class="controls">
                                                <div class="input-prepend">
                                                    <span class="add-on"><i class="icon-lock"></i></span>
                                                    <input class="span12" name="pass" id="pass" type="password" placeholder="Input Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" class="btn btn-primary" id="login">Masuk</button>
                                                <button type="reset" class="btn" id="batal">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="widget-foot">
                            </div>
                        </div>  
                    </div>
                </div>
            </div> 
        </div>
        <!-- JS -->
        <script src="js/jquery-1.10.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
       <!-- <script>
          function pesan(msg, tanda) {
                $("#pesan").html("");
                $("#pesan").removeClass();
                $("#pesan").addClass(tanda);
                $("#pesan").html(msg);
            }
            $("#login").click(function(){
                var user = $("#user").val();
                var pass = $("#pass").val();
                $.ajax({
                    url: "admin-login-proses.php",
                    type: "POST",
                    data: "user="+user+"&pass="+pass,
                    cache: false,
                    beforeSend: function() {
                   //     pesan("Harap Tunggu...", "alert alert-info");
                    },
                    success: function(st) {
                alert (st);
                        pesan(st, "alert alert-info");
                    }
                });
            });
        </script>-->
        
    </body>
</html>