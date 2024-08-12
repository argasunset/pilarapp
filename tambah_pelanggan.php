<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari formulir
$nama = $_POST['nama'];
$no_wa = $_POST['no_wa'];
$alamat = $_POST['alamat'];
$paket_wifi = $_POST['paket_wifi'];
$tanggal_aktivasi = $_POST['tanggal_aktivasi'];

// Query untuk menambah data ke tabel pelanggan
$sql = "INSERT INTO pelanggan (nama_pelanggan, no_wa, alamat, paket_wifi, tanggal_aktivasi, status) 
        VALUES ('$nama', '$no_wa', '$alamat', '$paket_wifi', '$tanggal_aktivasi', 'Aktif')";

if ($conn->query($sql) === TRUE) {
    echo "Data pelanggan berhasil ditambahkan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirect ke halaman Internet Home
header("Location: internet_home.php");
exit();
?>
