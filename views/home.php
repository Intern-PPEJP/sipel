<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/stylehome.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="user-info">
                <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                <button class="profile-btn">
                    <i class="fa fa-user-circle"></i>
                </button>
            </div>
        </div>
    </header>

    <aside>
        <div class="sidebar">
            <div class="sidebar-logo">
                <img src="assets/logo.png" alt="Sidebar Logo">
            </div>
            <nav>
                <ul class="sidebar-menu">
                    <li class="header">Main Navigation</li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-home"></i> <span>Beranda</span>
                        </a>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Peserta</span>
                        </a>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-building-o"></i> <span>Perusahaan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Contact Person</a></li>
                        </ul>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Fasilitator</span>
                        </a>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Rencana Kegiatan</span>
                        </a>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-building-o"></i> <span>Rencana Program</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Rencana Program Diklat PPEI</a></li>
                            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Rencana Program Kerjasama Diklat PPEI</a></li>
                            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Rencana Kegiatan Export Coaching Program</a></li>
                            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Rencana Kegiatan Webinar</a></li>
                        </ul>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Panitia Pelatihan</span>
                        </a>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Pelatihan</span>
                        </a>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Judul Pelatihan</span>
                        </a>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Webinar</span>
                        </a>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Export Coaching Program</span>
                        </a>
                    </li>'<li class="active treeview">
                        <a href="#">Kurikulum & Silabus</span>
                        </a>
                    </li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Coaching Program</span>
                        </a>
                    </li>'
                    <li class="header">Report</li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Evaluasi</span>
                        </a>
                    </li>'
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Lap. Real. Pengajar</span>
                        </a>
                    </li>'
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Lap. Real. Pelatihan</span>
                        </a>
                    </li>'
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Lap. Real. Peserta</span>
                        </a>
                    </li>'
                    <li class="active treeview">
                        <a href="#">
                            <i class="fas fa-users"></i> <span>Pelatihan, Peserta, Perusahan</span>
                        </a>
                    </li>'
    
                </ul>
            </nav>
        </div>
    </aside>

    <footer>
        <div class="footer-content">
            <p>SISTEM INFORMASI PPEJP &copy; <?php echo date("Y"); ?> All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
