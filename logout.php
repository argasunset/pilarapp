<?php
session_start(); // Mulai sesi

// Hapus semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Arahkan ke halaman login setelah logout
header("Location: login.php");
exit();
?>
