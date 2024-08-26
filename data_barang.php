<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Dashboard 2</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="adminLTE/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link rel="stylesheet" href="adminLTE/dist/css/adminlte.min.css?v=3.2.0">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

<div class="preloader flex-column justify-content-center align-items-center">
<img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div>

<nav class="main-header navbar navbar-expand navbar-dark">

<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
</li>
<li class="nav-item d-none d-sm-inline-block">
<a href="index3.html" class="nav-link">Home</a>
</li>
<li class="nav-item d-none d-sm-inline-block">
<a href="#" class="nav-link">Contact</a>
</li>
</ul>

<ul class="navbar-nav ml-auto">

<li class="nav-item">
<a class="nav-link" data-widget="navbar-search" href="#" role="button">
<i class="fas fa-search"></i>
</a>
<div class="navbar-search-block">
<form class="form-inline">
<div class="input-group input-group-sm">
<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
<div class="input-group-append">
<button class="btn btn-navbar" type="submit">
<i class="fas fa-search"></i>
</button>
<button class="btn btn-navbar" type="button" data-widget="navbar-search">
<i class="fas fa-times"></i>
</button>
</div>
</div>
</form>
</div>
</li>

<li class="nav-item dropdown">
<a class="nav-link" data-toggle="dropdown" href="#">
<i class="far fa-comments"></i>
<span class="badge badge-danger navbar-badge">3</span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
<a href="#" class="dropdown-item">

<div class="media">
<img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
<div class="media-body">
<h3 class="dropdown-item-title">
Brad Diesel
<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
</h3>
<p class="text-sm">Call me whenever you can...</p>
<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
</div>
</div>

</a>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item">

<div class="media">
<img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
<div class="media-body">
<h3 class="dropdown-item-title">
John Pierce
<span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
</h3>
<p class="text-sm">I got your message bro</p>
<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
</div>
</div>

</a>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item">

<div class="media">
<img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
<div class="media-body">
<h3 class="dropdown-item-title">
Nora Silvester
<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
</h3>
<p class="text-sm">The subject goes here</p>
<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
</div>
</div>

</a>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
</div>
</li>

<li class="nav-item dropdown">
<a class="nav-link" data-toggle="dropdown" href="#">
<i class="far fa-bell"></i>
<span class="badge badge-warning navbar-badge">15</span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
<span class="dropdown-item dropdown-header">15 Notifications</span>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item">
<i class="fas fa-envelope mr-2"></i> 4 new messages
<span class="float-right text-muted text-sm">3 mins</span>
</a>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item">
<i class="fas fa-users mr-2"></i> 8 friend requests
<span class="float-right text-muted text-sm">12 hours</span>
</a>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item">
<i class="fas fa-file mr-2"></i> 3 new reports
<span class="float-right text-muted text-sm">2 days</span>
</a>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
</div>
</li>
<li class="nav-item">
<a class="nav-link" data-widget="fullscreen" href="#" role="button">
<i class="fas fa-expand-arrows-alt"></i>
</a>
</li>
<li class="nav-item">
<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
<i class="fas fa-th-large"></i>
</a>
</li>
</ul>
</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="index3.html" class="brand-link">
<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light">AdminLTE 3</span>
</a>

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
</div>
<div class="info">
<a href="#" class="d-block">Alexander Pierce</a>
</div>
</div>

<div class="form-inline">
<div class="input-group" data-widget="sidebar-search">
<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
<div class="input-group-append">
<button class="btn btn-sidebar">
<i class="fas fa-search fa-fw"></i>
</button>
</div>
</div>
</div>

<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<li class="nav-item menu-open">
<a href="#" class="nav-link active">
<i class="nav-icon fas fa-tachometer-alt"></i>
<p>
Dashboard
<i class="right fas fa-angle-left"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="dashboard_admin.php" class="nav-link active">
<i class="far fa-circle nav-icon"></i>
<p>Dashboard</p>
</a>
</li>
</ul>
</li>
<li class="nav-item">
<a href="internet_home.php" class="nav-link">
<i class="fa-solid fa-wifi"></i>
<p>
Internet Home
</p>
</a>
</li>
<li class="nav-item">
<a href="data_barang.php" class="nav-link">
<i class="fas fa-box"></i>
<p>
Data Barang
</p>
</a>
</li>
<li class="nav-header">EXAMPLES</li>
<li class="nav-item">
<a href="kalender.php" class="nav-link">
<i class="nav-icon fas fa-calendar-alt"></i>
<p>
Kalender
<span class="badge badge-info right">2</span>
</p>
</a>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon far fa-envelope"></i>
<p>
Mailbox
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="pages/mailbox/mailbox.html" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Inbox</p>
</a>
</li>
<li class="nav-item">
<a href="pages/mailbox/compose.html" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Compose</p>
</a>
</li>
<li class="nav-item">
<a href="pages/mailbox/read-mail.html" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Read</p>
</a>
</li>
</ul>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon fas fa-search"></i>
<p>
Search
<i class="fas fa-angle-left right"></i>
</p>
</a>
<ul class="nav nav-treeview">
<li class="nav-item">
<a href="pages/search/simple.html" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Simple Search</p>
</a>
</li>
<li class="nav-item">
<a href="pages/search/enhanced.html" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Enhanced</p>
</a>
</li>
</ul>
</li>
<li class="nav-header">LABELS</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon far fa-circle text-danger"></i>
<p class="text">Important</p>
</a>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon far fa-circle text-warning"></i>
<p>Warning</p>
</a>
</li>
<li class="nav-item">
<a href="#" class="nav-link">
<i class="nav-icon far fa-circle text-info"></i>
<p>Informational</p>
</a>
</li>
</ul>
</nav>

</div>

</aside>




<aside class="control-sidebar control-sidebar-dark">

</aside>

<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$successMessage = "";  // Variabel untuk menyimpan pesan sukses

// Proses data ketika form di-submit untuk menambah barang
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambahBarang'])) {
    $tanggal = $_POST['tanggal'];  // Inisialisasi variabel tanggal dari form input
    $namaBarang = $_POST['namaBarang'];
    $hargaSatuan = $_POST['hargaSatuan'];
    $qty = $_POST['qty'];
    $deskripsi = $_POST['deskripsi'];

    // Hitung total harga
    $totalHarga = $hargaSatuan * $qty;

    // Query untuk memasukkan data ke tabel barang
    $sql_insert = "INSERT INTO barang (tanggal, nama_barang, harga_satuan, qty, total_harga, deskripsi) 
                   VALUES ('$tanggal', '$namaBarang', '$hargaSatuan', '$qty', '$totalHarga', '$deskripsi')";

    if ($conn->query($sql_insert) === TRUE) {
        $successMessage = "Data barang berhasil ditambahkan";  // Set pesan sukses
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// Proses data ketika form di-submit untuk menghapus barang
// Proses data ketika form di-submit untuk menghapus barang
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteBarang'])) {
    $barang_id = $_POST['barang_id'];

    // Query untuk menghapus data dari tabel barang
    $sql_delete = "DELETE FROM barang WHERE id='$barang_id'";

    // Debug statement
    var_dump($sql_delete); // Lihat query yang akan dijalankan

    if ($conn->query($sql_delete) === TRUE) {
        $successMessage = "Data barang berhasil dihapus";
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error; // Tampilkan error
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter'])) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Query untuk mengambil data dari tabel barang berdasarkan tanggal
    $sql_select = "SELECT * FROM barang WHERE tanggal BETWEEN '$startDate' AND '$endDate' ORDER BY tanggal DESC";
    $result = $conn->query($sql_select);
} else {
    // Ambil semua data jika tidak ada filter
    $sql_select = "SELECT * FROM barang ORDER BY tanggal DESC";
    $result = $conn->query($sql_select);
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $dataBarang[] = $row; // Simpan data barang ke array
    }
} else {
    echo "<tr><td colspan='8'>Tidak ada data barang</td></tr>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="container">
        <h2>Data Barang</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#filterModal">Filter Tanggal</button>
        <button class="btn btn-success" data-toggle="modal" data-target="#tambahBarangModal">Tambah Barang</button>
        
        <table class="table table-bordered mt-3" id="barangTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Harga Satuan</th>
            <th>Qty</th>
            <th>Total Harga</th>
            <th>Deskripsi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if (!empty($dataBarang)) {
        $no = 1;
        foreach ($dataBarang as $row) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['tanggal'] . "</td>";
            echo "<td>" . $row['nama_barang'] . "</td>";
            echo "<td>" . number_format($row['harga_satuan'], 0, ',', '.') . "</td>";
            echo "<td>" . $row['qty'] . "</td>";
            echo "<td>" . number_format($row['total_harga'], 0, ',', '.') . "</td>";
            echo "<td>" . $row['deskripsi'] . "</td>";
            echo "<td>
                <form method='POST' style='display:inline;' onsubmit='return confirmDelete();'>
                    <input type='hidden' name='barang_id' value='" . $row['id'] . "'>
                    <button type='submit' name='deleteBarang' class='btn btn-danger btn-sm'>Delete</button>
                </form>
            </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Tidak ada data barang</td></tr>";
    }
    ?>
    
</tbody>

</table>

    </div>

    <!-- Modal Filter Tanggal -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterLabel">Filter Berdasarkan Tanggal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="startDate">Dari Tanggal</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" required>
                        </div>
                        <div class="form-group">
                            <label for="endDate">Sampai Dengan</label>
                            <input type="date" class="form-control" id="endDate" name="endDate" required>
                        </div>
                        <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                        <a href="download.php?startDate=" id="downloadButton" class="btn btn-success" style="display:none;">Download Excel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang -->
    <div class="modal fade" id="tambahBarangModal" tabindex="-1" role="dialog" aria-labelledby="tambahBarangLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBarangLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="namaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="namaBarang" name="namaBarang" required>
                        </div>
                        <div class="form-group">
                            <label for="hargaSatuan">Harga Satuan</label>
                            <input type="number" class="form-control" id="hargaSatuan" name="hargaSatuan" required>
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control" id="qty" name="qty" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                        </div>
                        <button type="submit" name="tambahBarang" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

    <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus barang ini?");
        }

        // SweetAlert buat notifikasi sukses
        <?php if ($successMessage): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo $successMessage; ?>',
            timer: 2000,
            showConfirmButton: false
        });
        <?php endif; ?>

// Update tombol download
$(document).ready(function() {
        $('#startDate, #endDate').on('change', function() {
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();
            if (startDate && endDate) {
                $('#downloadButton').attr('href', 'download.php?startDate=' + startDate + '&endDate=' + endDate).show();
            } else {
                $('#downloadButton').hide(); // Sembunyikan jika salah satu tanggal belum diisi
            }
        });
    });
    </script>
</div>
</body>
</html>