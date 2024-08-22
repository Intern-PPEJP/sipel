<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi PPEJP</title>
    <link rel="stylesheet" href="assets/stylelogin.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
        <div class="login-logo">
            <img src="assets/newlogo.png" alt="Logo">
        </div>
            <h1>SISTEM INFORMASI PPEJP</h1>
            <form action="index.php?page=login" method="post">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                    <span class="toggle-password"><i class="fas fa-eye"></i></span>
                </div>
                <button type="submit">Login</button>
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
