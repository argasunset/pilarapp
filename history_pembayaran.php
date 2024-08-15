<?php
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$pelanggan_id = $_GET['id'];

// Ambil nama pelanggan
$sql_nama = "SELECT nama_pelanggan FROM pelanggan WHERE id='$pelanggan_id'";
$result_nama = $conn->query($sql_nama);
if ($result_nama->num_rows > 0) {
    $nama_pelanggan = $result_nama->fetch_assoc()['nama_pelanggan'];
} else {
    $nama_pelanggan = "Tidak diketahui";
}

// Ambil data pembayaran
$sql = "SELECT * FROM pembayaran WHERE pelanggan_id='$pelanggan_id'";
$result = $conn->query($sql);
if (!$result) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pembayaran - <?php echo $nama_pelanggan; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .kwitansi-container {
            position: relative;
            width: 1000px;
            height: 600px;
            margin: 0 auto;
            background-image: url('Kwitansi.png'); /* Path ke file Kwitansi.png */
            background-size: cover;
            background-position: center;
        }
        .kwitansi-text {
            position: absolute;
            font-family: Arial, sans-serif;
            color: #000;
        }
        .tanggal {
            top: 180px;
            left: 750px;
            font-size: 18px;
        }
        .nama-pelanggan {
            top: 250px;
            left: 200px;
            font-size: 18px;
        }
        .nominal-bayar {
            top: 320px;
            left: 200px;
            font-size: 18px;
        }
        .terbilang {
            top: 390px;
            left: 200px;
            font-size: 18px;
        }
        .untuk-pembayaran {
            top: 460px;
            left: 200px;
            font-size: 18px;
        }
    </style>
    <script>
        function printKwitansi(rowId) {
            var divToPrint = document.getElementById(rowId);
            var newWin = window.open('');
            newWin.document.write('<html><head><title>Cetak Kwitansi</title>');
            newWin.document.write('<style>' + document.querySelector('style').innerHTML + '</style>');
            newWin.document.write('</head><body>');
            newWin.document.write(divToPrint.outerHTML);
            newWin.document.close();
            newWin.print();
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>History Pembayaran - <?php echo $nama_pelanggan; ?></h2>
        
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <th>Nama Pelanggan</th>
                    <th>Nominal Bayar</th>
                    <th>Kurang Bayar</th>
                    <th>Bukti Transfer</th>
                    <th>Terbilang</th>
                    <th>Untuk Pembayaran</th>
                    <th>Cetak</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $rowId = 1; // Menambahkan ID untuk setiap baris
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr id='row$rowId'>
                                <td>" . $row['tanggal_pembayaran'] . "</td>
                                <td>" . $nama_pelanggan . "</td>
                                <td>" . $row['nominal_bayar'] . "</td>
                                <td>" . $row['kurang_bayar'] . "</td>
                                <td><a href='uploads/" . $row['bukti_tf'] . "' target='_blank'>Lihat Bukti</a></td>
                                <td>" . $row['terbilang'] . "</td>
                                <td>" . $row['untuk_pembayaran'] . "</td>
                                <td>
                                    <button onclick='printKwitansi(\"kwitansi$rowId\")' class='btn btn-primary'>Cetak</button>
                                </td>
                            </tr>";
                        
                        echo "<div id='kwitansi$rowId' class='kwitansi-container' style='display:none;'>
                                <div class='kwitansi-text tanggal'>" . $row['tanggal_pembayaran'] . "</div>
                                <div class='kwitansi-text nama-pelanggan'>" . $nama_pelanggan . "</div>
                                <div class='kwitansi-text nominal-bayar'>" . $row['nominal_bayar'] . "</div>
                                <div class='kwitansi-text terbilang'>" . $row['terbilang'] . "</div>
                                <div class='kwitansi-text untuk-pembayaran'>" . $row['untuk_pembayaran'] . "</div>
                            </div>";
                        
                        $rowId++;
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data pembayaran yang ditemukan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>

<?php
if ($conn) {
    $conn->close();
}
?>
