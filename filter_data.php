<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pilarapp");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$filterMonth = isset($_POST['filterMonth']) ? $_POST['filterMonth'] : '';
$filterDate = isset($_POST['filterDate']) ? $_POST['filterDate'] : '';

$filterQuery = "";

if (!empty($filterMonth)) {
    $filterQuery .= " AND DATE_FORMAT(tanggal, '%Y-%m') = '$filterMonth'";
}

if (!empty($filterDate)) {
    $filterQuery .= " AND DATE(tanggal) = '$filterDate'";
}

// Query untuk menghitung total pemasukan berdasarkan filter
$query_pemasukan = "SELECT SUM(nominal_bayar) as total_pemasukan FROM pembayaran WHERE 1=1 $filterQuery";
$result_pemasukan = $conn->query($query_pemasukan);
$total_pemasukan = ($result_pemasukan->num_rows > 0) ? $result_pemasukan->fetch_assoc()['total_pemasukan'] : 0;

// Query untuk menghitung total pengeluaran berdasarkan filter
$query_pengeluaran = "SELECT SUM(total_harga) as total_pengeluaran FROM barang WHERE 1=1 $filterQuery";
$result_pengeluaran = $conn->query($query_pengeluaran);
$total_pengeluaran = ($result_pengeluaran->num_rows > 0) ? $result_pengeluaran->fetch_assoc()['total_pengeluaran'] : 0;

$conn->close();

// Hasilkan output HTML baru untuk dashboard
echo "
<div class='col-xl-3 col-md-6 mb-4'>
    <div class='card border-left-success shadow h-100 py-2'>
        <div class='card-body'>
            <div class='row no-gutters align-items-center'>
                <div class='col mr-2'>
                    <div class='text-xs font-weight-bold text-success text-uppercase mb-1'>
                        Pemasukan Keuangan</div>
                    <div class='h5 mb-0 font-weight-bold text-gray-800'>Rp " . number_format($total_pemasukan, 0, ',', '.') . "</div>
                </div>
                <div class='col-auto'>
                    <i class='fas fa-dollar-sign fa-2x text-gray-300'></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='col-xl-3 col-md-6 mb-4'>
    <div class='card border-left-danger shadow h-100 py-2'>
        <div class='card-body'>
            <div class='row no-gutters align-items-center'>
                <div class='col mr-2'>
                    <div class='text-xs font-weight-bold text-danger text-uppercase mb-1'>
                        Pengeluaran Keuangan</div>
                    <div class='h5 mb-0 font-weight-bold text-gray-800'>Rp " . number_format($total_pengeluaran, 0, ',', '.') . "</div>
                </div>
                <div class='col-auto'>
                    <i class='fas fa-money-bill-wave fa-2x text-gray-300'></i>
                </div>
            </div>
        </div>
    </div>
</div>
";
?>
