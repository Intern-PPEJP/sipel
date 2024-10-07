<?php
// session_start(); // Pastikan session dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <!-- <style>
        main {
            margin-bottom: 60px; /* Atur sesuai tinggi footer */
        }

    </style>

    <main>
        <h1>Ini adalah halaman peserta</h1>
    </main> -->

    <!-- <?php include 'footer.php'; ?> -->
</body>
</html>
