<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan parameter tanggal dari URL
$startDate = $_GET['startDate'] ?? null;
$endDate = $_GET['endDate'] ?? null;

// Query untuk mengambil data
if ($startDate && $endDate) {
    $sql_select = "SELECT * FROM barang WHERE tanggal BETWEEN ? AND ? ORDER BY tanggal DESC";
    $stmt = $conn->prepare($sql_select);
    $stmt->bind_param("ss", $startDate, $endDate); // Bind parameter untuk menghindari SQL injection
} else {
    $sql_select = "SELECT * FROM barang ORDER BY tanggal DESC";
    $stmt = $conn->prepare($sql_select);
}

$stmt->execute();
$result = $stmt->get_result();

// Load PHPSpreadsheet
require __DIR__ . '/vendor/autoload.php'; // Sesuaikan path jika perlu

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Buat objek Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header kolom
$headers = ['No', 'Tanggal', 'Nama Barang', 'Harga Satuan', 'Qty', 'Total Harga', 'Deskripsi'];
$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '1', $header);
    $col++;
}

// Isi data
$row = 2; // Mulai dari baris kedua
if ($result->num_rows > 0) {
    $no = 1;
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $data['tanggal']);
        $sheet->setCellValue('C' . $row, $data['nama_barang']);
        $sheet->setCellValue('D' . $row, $data['harga_satuan']);
        $sheet->setCellValue('E' . $row, $data['qty']);
        $sheet->setCellValue('F' . $row, $data['total_harga']);
        $sheet->setCellValue('G' . $row, $data['deskripsi']);
        $row++;
    }
}

// Set nama file
$filename = 'Data_Barang_' . date('Ymd') . '.xlsx';

// Atur header untuk unduh file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Simpan ke output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Tutup koneksi
$stmt->close();
$conn->close();
exit;
?>
