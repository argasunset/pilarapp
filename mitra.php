<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit;
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah filter bulan diterapkan
if (isset($_POST['bulan']) && !empty($_POST['bulan'])) {
    $bulan = $_POST['bulan'];
    // Format bulan untuk SQL
    $bulan_awal = $bulan . "-01";
    $bulan_akhir = date("Y-m-t", strtotime($bulan_awal)); // Ambil akhir bulan

    // Query untuk menghitung total pemasukan berdasarkan bulan yang dipilih
    $query = "SELECT SUM(nominal_bayar) as total_pemasukan FROM pembayaran WHERE tanggal_pembayaran BETWEEN ? AND ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $bulan_awal, $bulan_akhir);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil hasil query
        $row = $result->fetch_assoc();
        $total_pemasukan = $row['total_pemasukan'];
    } else {
        $total_pemasukan = 0; // Jika tidak ada data, set total pemasukan ke 0
    }

    // Query untuk menghitung total pengeluaran berdasarkan bulan yang dipilih
    $query = "SELECT SUM(total_harga) as total_harga_semua FROM barang WHERE tanggal BETWEEN ? AND ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $bulan_awal, $bulan_akhir);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil hasil query
        $row = $result->fetch_assoc();
        $total_harga_semua = $row['total_harga_semua'];
    } else {
        $total_harga_semua = 0; // Jika tidak ada data, set total pengeluaran ke 0
    }

} else {
    // Jika filter tidak diterapkan, gunakan query default untuk seluruh data
    // Query untuk menghitung total pemasukan dari kolom nominal_bayar di tabel pembayaran
    $query = "SELECT SUM(nominal_bayar) as total_pemasukan FROM pembayaran";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Ambil hasil query
        $row = $result->fetch_assoc();
        $total_pemasukan = $row['total_pemasukan'];
    } else {
        $total_pemasukan = 0; // Jika tidak ada data, set total pemasukan ke 0
    }

    // Query untuk menghitung total pengeluaran dari kolom total_harga di tabel barang
    $query = "SELECT SUM(total_harga) as total_harga_semua FROM barang";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Ambil hasil query
        $row = $result->fetch_assoc();
        $total_harga_semua = $row['total_harga_semua'];
    } else {
        $total_harga_semua = 0; // Jika tidak ada data, set total pengeluaran ke 0
    }
}

// Query untuk menghitung jumlah barang
$query = "SELECT COUNT(*) as total_barang FROM barang";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Ambil hasil query
    $row = $result->fetch_assoc();
    $jumlah_barang = $row['total_barang'];
} else {
    $jumlah_barang = 0; // Jika tidak ada data, set jumlah barang ke 0
}

// Query untuk menghitung total pelanggan
$query = "SELECT COUNT(*) as total_pelanggan FROM pelanggan";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Ambil hasil
    $row = $result->fetch_assoc();
    $total_pelanggan = $row['total_pelanggan'];
} else {
    $total_pelanggan = 0; // Jika tidak ada data, set total pelanggan ke 0
}

// Query untuk mengambil total pemasukan per bulan
$query = "SELECT MONTH(tanggal_pembayaran) as bulan, SUM(nominal_bayar) as total_pemasukan 
FROM pembayaran 
GROUP BY MONTH(tanggal_pembayaran)";
$result = $conn->query($query);

$months = [];
$earnings = [];

// Cek apakah ada hasil dari query
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
// Gunakan nama bulan dalam teks atau angka
$months[] = date('M', mktime(0, 0, 0, $row['bulan'], 10)); // Jan, Feb, Mar, dst.
// Jangan format total pemasukan, simpan dalam bentuk angka
$earnings[] = (int) $row['total_pemasukan']; // Pastikan total_pemasukan adalah angka
}
} else {
// Jika tidak ada data, kirim array kosong atau 0
$months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
$earnings = array_fill(0, 12, 0); // Semua bulan diisi dengan 0
}

// Kirim data ke JavaScript dalam format JSON
$months_json = json_encode($months);
$earnings_json = json_encode($earnings);


// Contoh nilai lain (social dan referral) untuk diagram pie
// Misalnya nilai tetap atau dari query database lain
// Misalnya nilai tetap atau dari query database lain

$id = $_SESSION['id']; // Pastikan variabel sesi sesuai dengan kolom di database

// Ambil data pengguna dari database
$query = "SELECT username FROM user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content=""> 

    <title>SB Admin 2 - Dashboard</title>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/styleoke.css">

    <link rel="stylesheet" href="mitra.css">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                <i class="fa-solid fa-gem" style="font-size: 25px;"></i>
                </div>
                <div class="sidebar-brand-text mx-2">Pilar solusi</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link" href="internet_home.php">
                <i class="fa-solid fa-wifi"></i>
                    <span>Internet Home</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="data_barang.php">
                <i class="fas fa-box"></i>
                    <span>Data Barang</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="mitra.php">
                <i class="fa-solid fa-users"></i>
                    <span>Mitra</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Tabel Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Tes</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="kalender.php">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Kalender</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <button class="theme"><i class="fa-solid fa-sun" id="icon"></i></button>
                       
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($username); ?></span>
        <img class="img-profile rounded-circle"
        src="img/undraw_profile.svg">
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="profile.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
        </a>
        <a class="dropdown-item" href="settings.php">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Settings
        </a>
        <a class="dropdown-item" href="activity_log.php">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Activity Log
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="logout.php">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
        </a>
    </div>
</li>


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                     <!-- Page Heading -->
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
</div>

<div class="container">
            <div class="col-md-9">
                <h3 class="h3 mb-0 text-gray-800">Mitra</h3>
                <p>Home / Dashboard</p>
                
                <div class="card mb-3 custom-card" onclick="window.location.href='kaligandu/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Kaligandu.Net</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card mb-3 custom-card" onclick="window.location.href='transformer/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Transformer.Net</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card mb-3 custom-card" onclick="window.location.href='oneqid/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Oneqid.Net</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>   

                <div class="card mb-3 custom-card" onclick="window.location.href='lebokengok/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Lebok Engok "LA"</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card mb-3 custom-card" onclick="window.location.href='kalitanjung/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Kalitanjung.Net</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card mb-3 custom-card" onclick="window.location.href='iringiring/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Iring-Iring</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card mb-3 custom-card" onclick="window.location.href='tanjakan/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Tanjakan</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card mb-3 custom-card" onclick="window.location.href='kemantren/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Kemantren</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card mb-3 custom-card" onclick="window.location.href='ozet/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Ozet</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card mb-3 custom-card" onclick="window.location.href='bojong/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Bojong</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card mb-3 custom-card" onclick="window.location.href='warungduet/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Warung Duet</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card mb-3 custom-card" onclick="window.location.href='benjaran/index.php';" style="cursor: pointer;">
                        <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="img/pilar-kayu.png" class="card-img" alt="...">
                        </div>
                    <div class="col-md-8">
                <div class="card-body">
                        <h5 class="card-title custom-title">Benjaran</h5>
                            <p class="card-text">Gunakan Username dan Password Yang Telah di Berikan Oleh Admin.</p>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="vendor/chart.js/Chart.min.js"></script>
</html>