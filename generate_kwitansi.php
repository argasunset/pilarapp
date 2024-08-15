<?php
// Mendapatkan data dari URL
$tanggal = $_GET['tanggal'];
$nama_pelanggan = $_GET['nama_pelanggan'];
$nominal_bayar = $_GET['nominal_bayar'];
$terbilang = $_GET['terbilang'];
$untuk_pembayaran = $_GET['untuk_pembayaran'];

// Memeriksa apakah gambar Kwitansi ada
if (file_exists('Kwitansi.png')) {
    $image = imagecreatefrompng('Kwitansi.png');
} else {
    die('Gambar Kwitansi tidak ditemukan.');
}

// Warna teks hitam
$textColor = imagecolorallocate($image, 0, 0, 0);

// Koordinat penempatan teks pada gambar
$fontPath = './path/to/your/font.ttf'; // Ganti dengan path font TTF yang sesuai
$fontSize = 20;

// Menambahkan teks pada gambar
imagettftext($image, $fontSize, 0, 220, 220, $textColor, $fontPath, $nama_pelanggan);
imagettftext($image, $fontSize, 0, 220, 300, $textColor, $fontPath, $nominal_bayar);
imagettftext($image, $fontSize, 0, 220, 380, $textColor, $fontPath, $terbilang);
imagettftext($image, $fontSize, 0, 220, 460, $textColor, $fontPath, $untuk_pembayaran);
imagettftext($image, $fontSize, 0, 900, 220, $textColor, $fontPath, $tanggal);

// Menampilkan gambar
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
