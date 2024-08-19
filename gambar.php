<?php
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$pelanggan_id = $_GET['id'];

// Ambil data pembayaran dan pelanggan berdasarkan ID
$sql = $conn->prepare("SELECT pembayaran.*, pelanggan.nama_pelanggan 
                       FROM pembayaran 
                       JOIN pelanggan ON pembayaran.pelanggan_id = pelanggan.id 
                       WHERE pembayaran.id = ?");
$sql->bind_param("i", $pelanggan_id);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    die("Data tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .kwitansi-container {
            position: relative;
            width: 85%;
            margin: 0 auto;
            background-image: url('Kwitansi.png');
            background-size: cover;
            background-position: center;
            height: 600px; /* Adjust height as needed */
        }
        .kwitansi-text {
            position: absolute;
            font-family: Arial, sans-serif;
            color: #000;
        }
        .nama-pelanggan {
            top: 120px;
            left: 50px;
            font-size: 18px;
        }
        .nominal-bayar {
            top: 180px;
            left: 50px;
            font-size: 18px;
        }
        .terbilang {
            top: 210px;
            left: 50px;
            font-size: 18px;
        }
        .untuk-pembayaran {
            top: 270px;
            left: 50px;
            font-size: 18px;
        }
        .tanggal {
            top: 120px;
            right: 50px;
            font-size: 18px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="kwitansi-container">
        <div class="kwitansi-text nama-pelanggan">
            Telah diterima dari: <?php echo htmlspecialchars($data['nama_pelanggan']); ?>
        </div>
        <div class="kwitansi-text nominal-bayar">
            Uang Sejumlah: Rp. <?php echo number_format($data['nominal_bayar'], 0, ',', '.'); ?>
        </div>
        <div class="kwitansi-text terbilang">
            <?php echo htmlspecialchars($data['terbilang']); ?>
        </div>
        <div class="kwitansi-text untuk-pembayaran">
            Untuk Pembayaran: <?php echo htmlspecialchars($data['untuk_pembayaran']); ?>
        </div>
        <div class="kwitansi-text tanggal">
            <?php echo date('d-m-Y', strtotime($data['tanggal_pembayaran'])); ?>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>

<?php
if ($conn) {
    $conn->close();
}
?>
