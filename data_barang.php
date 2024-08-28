<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$successMessage = "";  // Variabel untuk menyimpan pesan sukses
$dataBarang = []; // Inisialisasi variabel untuk data barang

// Fungsi untuk memvalidasi input dan mencegah serangan XSS
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Fungsi untuk menambahkan notifikasi dengan opsi pemulihan
function addAlert($type, $message, $canRestore = false, $itemId = null) {
    $_SESSION['alerts'][] = [
        'type' => $type,
        'message' => $message,
        'can_restore' => $canRestore,
        'item_id' => $itemId,
        'timestamp' => time()
    ];
}

// Proses data ketika form di-submit untuk menambah barang
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambahBarang'])) {
    $tanggal = test_input($_POST['tanggal']);
    $namaBarang = test_input($_POST['namaBarang']);
    $hargaSatuan = test_input($_POST['hargaSatuan']);
    $qty = test_input($_POST['qty']);
    $deskripsi = test_input($_POST['deskripsi']);

    // Validasi tipe data
    if (is_numeric($hargaSatuan) && is_numeric($qty)) {
        $totalHarga = $hargaSatuan * $qty;

        // Query untuk memasukkan data ke tabel barang
        $stmt = $conn->prepare("INSERT INTO barang (tanggal, nama_barang, harga_satuan, qty, total_harga, deskripsi) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiis", $tanggal, $namaBarang, $hargaSatuan, $qty, $totalHarga, $deskripsi);

        if ($stmt->execute()) {
            $successMessage = "Data barang berhasil ditambahkan";
        } else {
            echo "Terjadi kesalahan saat menambahkan data: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Harga satuan dan kuantitas harus berupa angka.";
    }
}

// Proses data ketika form di-submit untuk menghapus barang
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteBarang'])) {
    $barang_id = test_input($_POST['barang_id']);

    if (is_numeric($barang_id)) {
        // Ambil nama barang dari database
        $stmt = $conn->prepare("SELECT nama_barang FROM barang WHERE id = ?");
        $stmt->bind_param("i", $barang_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $namaBarang = $row['nama_barang'];
        } else {
            $namaBarang = "Unknown";
        }
        $stmt->close();

        // Hapus barang
        $stmt = $conn->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->bind_param("i", $barang_id);

        if ($stmt->execute()) {
            // Tambahkan notifikasi dengan opsi pemulihan
            addAlert('warning', "Barang '$namaBarang' telah dihapus.", true, $barang_id);
        } else {
            // Tambahkan notifikasi error
            addAlert('error', 'Terjadi kesalahan saat menghapus data: ' . $stmt->error);
        }
        $stmt->close();
    } else {
        addAlert('error', 'ID barang tidak valid.');
    }
}



// Proses filter data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter'])) {
    $startDate = test_input($_POST['startDate']);
    $endDate = test_input($_POST['endDate']);

    if (!empty($startDate) && !empty($endDate)) {
        $stmt = $conn->prepare("SELECT * FROM barang WHERE tanggal BETWEEN ? AND ? ORDER BY tanggal DESC");
        $stmt->bind_param("ss", $startDate, $endDate);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        echo "Tanggal mulai dan akhir harus diisi.";
    }
} else {
    $result = $conn->query("SELECT * FROM barang ORDER BY tanggal DESC");
}

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dataBarang[] = $row; // Simpan data barang ke array
    }
} else {
    $dataBarang = []; // Set data barang kosong jika tidak ada data atau terjadi kesalahan query
}

// Hapus notifikasi setelah 1 hari
if (!empty($_SESSION['alerts'])) {
    foreach ($_SESSION['alerts'] as $index => $alert) {
        if ($alert['timestamp'] < (time() - 86400)) { // 86400 detik = 1 hari
            unset($_SESSION['alerts'][$index]);
        }
    }
    // Re-index array
    $_SESSION['alerts'] = array_values($_SESSION['alerts']);
}

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                <i class="fa-solid fa-home" style="font-size: 25px;"></i>
                </div>
                <div class="sidebar-brand-text mx-2">Pilar solusi</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
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
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
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
                                aria-label="Search" aria-describedby="basic-addon2" id="search">
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
                                            aria-describedby="basic-addon2" id="search">
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <?php
        // Hitung jumlah notifikasi
        $alertCount = isset($_SESSION['alerts']) ? count($_SESSION['alerts']) : 0;
        if ($alertCount > 0): ?>
            <span class="badge badge-danger badge-counter"><?= $alertCount; ?>+</span>
        <?php endif; ?>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
    <h6 class="dropdown-header">Alerts Center</h6>
    <?php
    if (!empty($_SESSION['alerts'])):
        foreach ($_SESSION['alerts'] as $index => $alert): ?>
            <a class="dropdown-item d-flex align-items-center">
                <div class="mr-3">
                    <div class="icon-circle <?= $alert['type'] === 'success' ? 'bg-success' : 'bg-warning'; ?>">
                        <i class="fas <?= $alert['type'] === 'success' ? 'fa-check' : 'fa-exclamation-triangle'; ?> text-white"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="small text-gray-500"><?= date('F d, Y'); ?></div>
                    <?= htmlspecialchars($alert['message']); ?>
                </div>
            </a>
        <?php endforeach;
    else: ?>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-info">
                        <i class="fas fa-info-circle text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500"><?= date('F d, Y'); ?></div>
                    Tidak ada notifikasi baru.
                </div>
            </a>
        <?php endif; ?>
        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
    </div>
</li>




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
                        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="container">
    <!-- Buttons for Modals -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#filterModal">Filter Tanggal</button>
    <button class="btn btn-success" data-toggle="modal" data-target="#tambahBarangModal">Tambah Barang</button>

    <!-- Table Container -->
    <div class="table-responsive mt-3">
        <table class="table table-bordered" id="barangTable">
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
    <script>
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus barang ini?");
    }

    // SweetAlert for success notification
    <?php if (isset($successMessage) && !empty($successMessage)): ?>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?php echo $successMessage; ?>',
        timer: 2000,
        showConfirmButton: false
    });
    <?php endif; ?>

    // SweetAlert for filter notification
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter'])): ?>
    Swal.fire({
        icon: 'success',
        title: 'Filter Berhasil!',
        text: 'Data barang telah difilter berdasarkan tanggal.',
        timer: 2000,
        showConfirmButton: false
    });
    <?php endif; ?>

    // Tambahkan notifikasi ke Alert Center saat barang dihapus
    <?php if (isset($deleteMessage) && !empty($deleteMessage)): ?>
    $(document).ready(function() {
        var newAlert = `<a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-danger">
                                    <i class="fas fa-trash text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?php echo date('F j, Y'); ?></div>
                                <?php echo $deleteMessage; ?>
                            </div>
                        </a>`;
        $('#alertsDropdown .dropdown-list').prepend(newAlert);
        Swal.fire({
            icon: 'info',
            title: 'Barang Dihapus!',
            text: '<?php echo $deleteMessage; ?>',
            timer: 2000,
            showConfirmButton: false
        });
    });
    <?php endif; ?>

    // Update download button
    $(document).ready(function() {
        $('#startDate, #endDate').on('change', function() {
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();
            if (startDate && endDate) {
                $('#downloadButton').attr('href', 'download.php?startDate=' + startDate + '&endDate=' + endDate).show();
            } else {
                $('#downloadButton').hide(); // Hide if either date is not filled
            }
        });

        // Pencarian di tabel barang
        $('#search').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            $('#barangTable tbody tr').each(function() {
                var rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.indexOf(searchText) > -1);
            });
        });
    });
</script>


</div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Pilar Solusi &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

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
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>