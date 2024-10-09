<?php

$host = "localhost";
$user = "root";
$pass = "";
$name = "ppejp_new";


$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (mysqli_connect_errno()) {
    echo "Koneksi database mysqli gagal!!! : " . mysqli_connect_error();
}
//mysqli_select_db($name, $koneksi) or die("Tidak ada database yang dipilih!");