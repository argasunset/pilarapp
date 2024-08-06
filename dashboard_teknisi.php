<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'teknisi') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teknisi Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome Teknisi</h2>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
