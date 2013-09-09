<?php

function get_base_url() {
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https://' ? 'https://' : 'http://';

    /* returns /myproject/index.php */
    $path = $_SERVER['PHP_SELF'];

    /*
     * returns an array with:
     * Array (
     *  [dirname] => /myproject/
     *  [basename] => index.php
     *  [extension] => php
     *  [filename] => index
     * )
     */
    $path_parts = pathinfo($path);
    $directory = $path_parts['dirname'];
    $directory = ($directory == "/") ? "" : $directory;
    $host = $_SERVER['HTTP_HOST'];
    return $protocol . $host . $directory;
}
//untuk mengambil ekstensi nama file
function getExtension($str) {

    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }
    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}
//untuk mengambil nama file tanpa ekstensi
function getName($str) {
    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }
    $nama = substr($str, 0, $i);
    return $nama;
}







?>
