<?php
// Periksa apakah user sudah login atau belum.
// Misalnya, dengan session. Jika belum login, redirect ke login.php.
session_start();

if (!isset($_SESSION['username'])) {
    // Jika user belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Hentikan eksekusi sisa kode
}
?>
<?php
header("Location: login.php");
exit();
?>


<!-- Konten halaman jika sudah login -->
