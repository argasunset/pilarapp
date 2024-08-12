<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['role'] == 'admin') {
    header('Location: dashboard_admin.php');
} elseif ($_SESSION['role'] == 'manajemen') {
    header('Location: dashboard_manajemen.php');
} elseif ($_SESSION['role'] == 'teknisi') {
    header('Location: dashboard_teknisi.php');
} else {
    echo "Invalid role!";
}
?>
