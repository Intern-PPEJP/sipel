<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'ppei_sip20';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (mysqli_connect_errno()) {
    echo "Koneksi database mysqli gagal!!! : " . mysqli_connect_error();
}
//mysqli_select_db($name, $koneksi) or die("Tidak ada database yang dipilih!");