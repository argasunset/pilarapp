<?php
// Input data to be filled in the receipt
$tanggal = "2024-08-15";  // Example date
$nama_pelanggan = "John Doe";  // Example customer name
$nominal_bayar = "1.500.000";  // Example amount
$terbilang = "Satu Juta Lima Ratus Ribu Rupiah";  // Amount in words
$untuk_pembayaran = "Pembayaran Layanan Internet";  // Reason for payment

// Check if the Kwitansi image file exists
$imagePath = __DIR__ . '/Kwitansi.png';
if (file_exists($imagePath)) {
    $image = imagecreatefrompng($imagePath);
} else {
    die('Gambar Kwitansi tidak ditemukan.');
}

// Set the color for the text (black)
$textColor = imagecolorallocate($image, 0, 0, 0);

// Load the TrueType font file
$fontPath = __DIR__ . '/font.ttf';  // Make sure you have the font file in this path
if (!file_exists($fontPath)) {
    die('Font tidak ditemukan.');
}

// Font size
$fontSize = 20;  // Adjust this size as per your design

// Place the text at specific coordinates
// Adjust these coordinates based on your Kwitansi.png template

imagettftext($image, $fontSize, 0, 220, 220, $textColor, $fontPath, $nama_pelanggan);  // Name
imagettftext($image, $fontSize, 0, 220, 300, $textColor, $fontPath, $nominal_bayar);  // Amount
imagettftext($image, $fontSize, 0, 220, 380, $textColor, $fontPath, $terbilang);  // Amount in words
imagettftext($image, $fontSize, 0, 220, 460, $textColor, $fontPath, $untuk_pembayaran);  // Reason
imagettftext($image, $fontSize, 0, 900, 220, $textColor, $fontPath, $tanggal);  // Date

// Output the final image
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
