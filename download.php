<?php
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan tanggal dari URL
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

// Query untuk mengambil data berdasarkan tanggal
$sql_select = "SELECT * FROM barang WHERE tanggal BETWEEN '$startDate' AND '$endDate' ORDER BY tanggal DESC";
$result = $conn->query($sql_select);

// Memulai pengunduhan file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="data_barang.xlsx"');

// Memasukkan library PHPExcel
require 'PHPExcel.php'; // Pastikan Anda telah mengunduh dan menyertakan library PHPExcel

// Membuat objek PHPExcel
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();

// Menambahkan header kolom
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Tanggal');
$sheet->setCellValue('C1', 'Nama Barang');
$sheet->setCellValue('D1', 'Harga Satuan');
$sheet->setCellValue('E1', 'Qty');
$sheet->setCellValue('F1', 'Total Harga');
$sheet->setCellValue('G1', 'Deskripsi');

// Mengisi data ke dalam file Excel
$row = 2; // Mulai dari baris kedua
if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $row - 1);
        $sheet->setCellValue('B' . $row, $data['tanggal']);
        $sheet->setCellValue('C' . $row, $data['nama_barang']);
        $sheet->setCellValue('D' . $row, $data['harga_satuan']);
        $sheet->setCellValue('E' . $row, $data['qty']);
        $sheet->setCellValue('F' . $row, $data['total_harga']);
        $sheet->setCellValue('G' . $row, $data['deskripsi']);
        $row++;
    }
}

// Menyimpan file Excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>