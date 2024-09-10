<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangani pengiriman form untuk menambahkan kegiatan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_event'])) {
        $event_date = $_POST['event_date'];
        $event_label = $_POST['event_label'];
        if (!empty($event_date) && !empty($event_label)) {
            $stmt = $conn->prepare("INSERT INTO events (event_date, event_label) VALUES (?, ?)");
            $stmt->bind_param("ss", $event_date, $event_label);
            $stmt->execute();
            $stmt->close();
        }
    } elseif (isset($_POST['edit_event'])) {
        $event_id = $_POST['event_id'];
        $event_date = $_POST['event_date'];
        $event_label = $_POST['event_label'];
        if (!empty($event_id) && !empty($event_date) && !empty($event_label)) {
            $stmt = $conn->prepare("UPDATE events SET event_date = ?, event_label = ? WHERE id = ?");
            $stmt->bind_param("ssi", $event_date, $event_label, $event_id);
            $stmt->execute();
            $stmt->close();
        }
    }
}

// Tangani penghapusan kegiatan
if (isset($_GET['delete_id'])) {
    $event_id = $_GET['delete_id'];
    if (!empty($event_id)) {
        $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Ambil data pengguna dari database
$id = $_SESSION['id'];
$query = "SELECT username FROM user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

// Ambil data kegiatan dari database
$query = "SELECT id, event_date, event_label FROM events";
$events_result = $conn->query($query);
$events = [];
while ($row = $events_result->fetch_assoc()) {
    $events[$row['event_date']][] = ['id' => $row['id'], 'label' => $row['event_label']];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Sederhana</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        td {
            height: 100px;
            vertical-align: top;
        }
        .today {
            background-color: #e2f7e2;
        }
        .event {
            background-color: #fffae6;
            margin-top: 5px;
            padding: 2px;
            border-radius: 3px;
        }
        .event a {
            margin-left: 5px;
            color: #007bff;
            text-decoration: none;
        }
        .event a:hover {
            text-decoration: underline;
        }
        #editForm {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -20%);
            padding: 20px;
            border: 1px solid #ddd;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
        #editForm .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom styles for this template -->
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
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">Interface</div>
            <li class="nav-item">
                <a class="nav-link" href="internet_home.php">
                    <i class="fa-solid fa-wifi"></i>
                    <span>Internet Home</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="data_barang.php">
                    <i class="fas fa-box"></i>
                    <span>Data Barang</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="mitra.php">
                <i class="fa-solid fa-users"></i>
                    <span>Mitra</span>
                </a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
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
            <div class="sidebar-heading">Addons</div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
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
                    <span>Charts</span>
                </a>
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
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($username); ?></span>
                                <i class="fas fa-user-circle fa-2x"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
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
                    <h1 class="h3 mb-4 text-gray-800">Kalender Sederhana</h1>

                    <!-- Form untuk Menambahkan Kegiatan -->
                    <div>
                        <form method="post" action="">
                            <input type="date" name="event_date" required>
                            <input type="text" name="event_label" required>
                            <button type="submit" name="add_event">Tambah Kegiatan</button>
                        </form>
                    </div>
                    <br>

                    <!-- Calendar -->
                    <?php
                    // Fungsi untuk membangun kalender
                    function build_calendar($month, $year, $events) {
                        $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                        $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                        $firstDay = date('w', strtotime("$year-$month-01"));
                        $calendar = '<table>';
                        $calendar .= '<thead><tr>';
                        foreach ($daysOfWeek as $day) {
                            $calendar .= "<th>$day</th>";
                        }
                        $calendar .= '</tr></thead><tbody><tr>';

                        for ($i = 0; $i < $firstDay; $i++) {
                            $calendar .= '<td></td>';
                        }

                        for ($day = 1; $day <= $numDays; $day++) {
                            $date = "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT);
                            $dayEvents = isset($events[$date]) ? $events[$date] : [];
                            $eventHtml = '';
                            foreach ($dayEvents as $event) {
                                $eventHtml .= "<div class='event'>" . htmlspecialchars($event['label']) . 
                                    " <a href='#' onclick='showEditForm(" . htmlspecialchars($event['id']) . ", \"" . htmlspecialchars($event['label']) . "\", \"" . $date . "\")'>Edit</a>" .
                                    " <a href='?delete_id=" . htmlspecialchars($event['id']) . "' onclick='return confirm(\"Are you sure you want to delete this event?\")'>Delete</a>" .
                                    "</div>";
                            }
                            $todayClass = ($date == date('Y-m-d')) ? 'today' : '';
                            $calendar .= "<td class='$todayClass'>$day$eventHtml</td>";
                            if (($firstDay + $day) % 7 == 0) {
                                $calendar .= '</tr><tr>';
                            }
                        }

                        while (($firstDay + $numDays) % 7 != 0) {
                            $calendar .= '<td></td>';
                            $firstDay++;
                        }

                        $calendar .= '</tr></tbody></table>';
                        return $calendar;
                    }

                    // Tampilkan kalender
                    $currentMonth = date('m');
                    $currentYear = date('Y');
                    echo build_calendar($currentMonth, $currentYear, $events);
                    ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Edit Event Form -->
    <div id="editForm">
        <span class="close" onclick="hideEditForm()">&times;</span>
        <form method="post" action="">
            <input type="hidden" id="edit_event_id" name="event_id">
            <input type="date" id="edit_event_date" name="event_date" required>
            <input type="text" id="edit_event_label" name="event_label" required>
            <button type="submit" name="edit_event">Update Kegiatan</button>
        </form>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages -->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        function showEditForm(id, label, date) {
            document.getElementById('edit_event_id').value = id;
            document.getElementById('edit_event_label').value = label;
            document.getElementById('edit_event_date').value = date;
            document.getElementById('editForm').style.display = 'block';
        }

        function hideEditForm() {
            document.getElementById('editForm').style.display = 'none';
        }
    </script>
</body>
</html>
