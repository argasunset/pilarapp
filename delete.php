<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pilarapp";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari parameter URL
if (isset($_GET['id']) && isset($_GET['pelanggan_id'])) {
    $id = $_GET['id'];
    $pelanggan_id = $_GET['pelanggan_id'];

    // Persiapkan statement SQL untuk menghapus data
    $sql = $conn->prepare("DELETE FROM pembayaran WHERE id = ?");
    $sql->bind_param("i", $id);

    // Eksekusi statement
    if ($sql->execute()) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman history_pembayaran.php dengan pelanggan_id
        header("Location: history_pembayaran.php?id=" . $pelanggan_id);
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $sql->error;
    }

    // Tutup statement
    $sql->close();
} else {
    echo "ID atau pelanggan_id tidak diberikan.";
}

// Tutup koneksi
$conn->close();
?>
