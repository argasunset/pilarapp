<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$no_wa = $_POST['no_wa'];
$alamat = $_POST['alamat'];
$paket_wifi = $_POST['paket_wifi'];
$tanggal_aktivasi = $_POST['tanggal_aktivasi'];

// Simpan data ke database
$sql = "INSERT INTO pelanggan (nama_pelanggan, no_wa, alamat, paket_wifi, tanggal_aktivasi) VALUES ('$nama', '$no_wa', '$alamat', '$paket_wifi', '$tanggal_aktivasi')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirect kembali ke halaman data pelanggan
header("Location: data_pelanggan.php");
exit();
?>
