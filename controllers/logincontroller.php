<?php
class LoginController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Ganti dengan verifikasi dari database jika ada
            if ($username === 'admin' && $password === 'password123') {
                $_SESSION['user'] = $username;
                header('Location: index.php?page=home');
                exit();
            } else {
                $error = "Username atau password salah!";
                include 'views/login.php';
            }
        } else {
            include 'views/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?page=login');
        exit();
    }
}
