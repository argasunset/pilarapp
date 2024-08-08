<?php
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$payment_id = isset($_GET['id']) ? $_GET['id'] : '';

if ($payment_id) {
    $sql = "SELECT p.*, pl.nama_pelanggan FROM pembayaran p JOIN pelanggan pl ON p.pelanggan_id = pl.id WHERE p.id='$payment_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $nama_pelanggan = $data['nama_pelanggan'];
        $nominal_bayar = $data['nominal_bayar'];
        $terbilang = $data['terbilang'];
        $untuk_pembayaran = $data['untuk_pembayaran'];
        $tanggal_pembayaran = $data['tanggal_pembayaran'];
    } else {
        die("Data tidak ditemukan");
    }
} else {
    die("ID pembayaran tidak disertakan");
}

if (!function_exists('imagecreatefrompng')) {
    die('GD Library tidak terpasang dengan benar. Silakan periksa konfigurasi PHP Anda.');
}

// Load the image
$image = imagecreatefrompng('kwitansi.png');
if (!$image) {
    die('Tidak dapat memuat gambar kwitansi. Pastikan file "kwitansi.png" ada di folder yang benar.');
}

// Allocate colors
$black = imagecolorallocate($image, 0, 0, 0);

// Font path
$font_path = __DIR__ . '/arial.ttf'; // Pastikan path ini benar dan font file ada di lokasi yang sesuai
if (!file_exists($font_path)) {
    die('File font tidak ditemukan. Pastikan "arial.ttf" ada di folder yang benar.');
}

// Add the text
imagettftext($image, 20, 0, 150, 100, $black, $font_path, "Telah Terima Dari: $nama_pelanggan");
imagettftext($image, 20, 0, 150, 150, $black, $font_path, "Uang Sejumlah: Rp $nominal_bayar");
imagettftext($image, 20, 0, 150, 200, $black, $font_path, "Terbilang: $terbilang");
imagettftext($image, 20, 0, 150, 250, $black, $font_path, "Untuk Pembayaran: $untuk_pembayaran");
imagettftext($image, 20, 0, 600, 300, $black, $font_path, "Tanggal: $tanggal_pembayaran");

// Output the image
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
