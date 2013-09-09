<?php

include "CLASS/user.class.php";
if (!empty($_POST["user"]) && !empty($_POST["pass"])) {
    $user = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($_POST["user"], ENT_QUOTES))));
    $pass = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars(md5($_POST["pass"]), ENT_QUOTES))));

    $user_login = new user();
    $sql ="SELECT a.*,b.foto_profil,b.jenis_kelamin
           FROM tbl_user a 
           INNER JOIN tbl_profil_user b
           ON a.id_user = b.id_user_profil_fk
           WHERE nama_user='$user' AND password_user='$pass' AND level_user='admin'";
    $ketemu = $user_login->ambil_data_user_sql($sql);

    if (sizeof($ketemu) > 0) {
        session_start();
        $_SESSION['id'] = $ketemu[0][0];
        $_SESSION['username'] = $ketemu[0][1];
        $_SESSION['passuser'] = $ketemu[0][2];
        $_SESSION['sessid'] = session_id();
        $_SESSION['leveluser'] = $ketemu[0][3];
        $_SESSION['foto'] = $ketemu[0][4];
        $_SESSION['jenis_kelamin'] = $ketemu[0]["jenis_kelamin"];
        header('location:admin.php');
    } else {
        echo '<link href="style/bootstrap.css" rel="stylesheet">';
        echo "<link href='style/style.css' rel='stylesheet'>";
        echo "
  </head>
  <body>
  <div class='admin-form'>
  <div class='hero-unit'>
  <div align='center'>
    <h2>ANDA GAGAL LOGIN !</h2>
    <img src='img/lock.png' class='offset'>
    
    <p>Username atau Password anda tidak sesuai atau anda bukan administrator.</p>
    <p><a class='btn btn-primary btn-large' href='admin-login.php'>Ulangi Lagi</a></p></div>
</div></div>";
    }
}else{
    header("Location: admin-login.php");
}
?>
