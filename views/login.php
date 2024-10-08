
<?php
session_start();
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'ppei_sip20';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$error = '';
$debug_info = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM t_users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['pass'])) {
            $_SESSION['username'] = $row['username'];
            header("Location: home.php");
            exit();
        } else {
            $error = "Username atau password salah";
        }
    } else {
        $error = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi PPEJP</title>
    <link rel="stylesheet" href="style/stylelogin.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    body{
        background-image: url("image/bglogin.jpg");
    }

    .error {
        color: red;
        font-size: small;
        margin-bottom: 15px;
        text-align: center;
    }
</style>

<body>
    <div class="login-container">
        <div class="login-box">
        <div class="login-logo">
            <img src="image/newlogo.png" alt="Logo">
        </div>
            <h1>SISTEM INFORMASI PPEJP</h1>
            <!-- <?php if($error != ''): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?> -->
            <?php if($error != ''): ?>
            <div class="error"><?php echo $error; ?></div> <!-- Menambahkan class="error" -->
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                    <span class="toggle-password"><i class="fas fa-eye"></i></span>
                </div>
                <button type="submit">Masuk</button>
            </form>
        </div>
        <div class="login-footer">
            <p>Kementerian Perdagangan</p>
            <p>SISTEM INFORMASI PPEJP © <?php echo date("Y"); ?> All Rights Reserved.</p>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('.toggle-password');
        const passwordField = document.querySelector('input[name="password"]');

        togglePassword.addEventListener('click', () => {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Ganti ikon
            if (type === 'password') {
                togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                togglePassword.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });
    </script>
</body>
</html>
