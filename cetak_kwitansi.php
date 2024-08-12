<?php
// Gantilah 'root' dan 'password' dengan kredensial yang benar
$koneksi = new mysqli("localhost", "root", "", "pilarapp");

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil parameter dari URL
$tanggal = $_GET['tanggal'];
$nominal = $_GET['nominal'];
$kurang = $_GET['kurang'];
$bukti_tf = $_GET['bukti_tf'];

// Query untuk mengambil data pembayaran yang sesuai
$sql = "SELECT * FROM pembayaran WHERE tanggal='$tanggal' AND nominal_bayar='$nominal' AND kurang_bayar='$kurang' AND bukti_tf='$bukti_tf'";
$result = $koneksi->query($sql);

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cetak Kwitansi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .kwitansi-container {
            position: relative;
            width: 210mm; /* A4 width */
            height: 297mm; /* A4 height */
            background: url('Kwitansi.png') no-repeat center center;
            background-size: contain; /* or use background-size: 100% 100%; */
        }
        .field {
            position: absolute;
        }
        .tanggal {
            top: 100mm; /* Adjust the position according to your template */
            left: 50mm; /* Adjust the position according to your template */
        }
        .nominal {
            top: 110mm; /* Adjust the position according to your template */
            left: 50mm; /* Adjust the position according to your template */
        }
        .kurang {
            top: 120mm; /* Adjust the position according to your template */
            left: 50mm; /* Adjust the position according to your template */
        }
    </style>
</head>
<body onload="window.print()">
    <div class="kwitansi-container">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="field tanggal">Tanggal: <?php echo $row["tanggal"]; ?></div>
                <div class="field nominal">Nominal Bayar: <?php echo number_format($row["nominal_bayar"], 2); ?></div>
                <div class="field kurang">Kurang Bayar: <?php echo number_format($row["kurang_bayar"], 2); ?></div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="field">Data tidak ditemukan</div>
        <?php endif; ?>
    </div>
</body>
</html>
