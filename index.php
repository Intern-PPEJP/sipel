<?php
// Mulai sesi
session_start();

// Sertakan file konfigurasi dan controller
require_once 'config/database.php'; // Buat file ini jika menggunakan database
require_once 'controllers/logincontroller.php';
require_once 'controllers/homecontroller.php'; // Jika ada halaman lain setelah login

// Routing dasar
$page = isset($_GET['page']) ? $_GET['page'] : 'login'; // Default ke halaman login jika belum login

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user']) && $page !== 'login') {
    header('Location: index.php?page=login');
    exit();
}

switch ($page) {
    case 'login':
        $controller = new LoginController();
        $controller->login();
        break;
    case 'logout':
        $controller = new LoginController();
        $controller->logout();
        break;
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    default:
        include 'views/404.php'; // Jika halaman tidak ditemukan
        break;
}
