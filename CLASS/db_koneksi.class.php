<?php

/*
 * @author muh. asrul ismail
 */

class db_koneksi {

    protected $db;

    protected function __construct() {
        $c = Array();
        $c['DB_HOST'] = "localhost"; //untuk URL web server
        $c['DB_USER'] = "asrul_native"; //untuk nama pengguna database
        $c['DB_PASS'] = "bsw101213bsw"; //untuk password
        $c['DB_NAME'] = "calon_pasangan"; //nama database yang akan dipakai

        foreach ($c as $name => $val) {
            define($name, $val);
        }

        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        try {
            $this->db = new PDO($dsn, $user, $pass);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

?>
