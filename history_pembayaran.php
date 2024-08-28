<?php
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$pelanggan_id = $_GET['id'];

// Ambil nama pelanggan dengan prepared statement
$sql_nama = $conn->prepare("SELECT nama_pelanggan FROM pelanggan WHERE id = ?");
$sql_nama->bind_param("i", $pelanggan_id);
$sql_nama->execute();
$result_nama = $sql_nama->get_result();

if ($result_nama->num_rows > 0) {
    $nama_pelanggan = $result_nama->fetch_assoc()['nama_pelanggan'];
} else {
    $nama_pelanggan = "Tidak diketahui";
}

// Ambil data pembayaran
$sql = $conn->prepare("SELECT * FROM pembayaran WHERE pelanggan_id = ?");
$sql->bind_param("i", $pelanggan_id);
$sql->execute();
$result = $sql->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pembayaran - <?php echo htmlspecialchars($nama_pelanggan); ?></title>
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
</head>
<body>
    <div class="container mt-5">
        <h2>History Pembayaran - <?php echo htmlspecialchars($nama_pelanggan); ?></h2>
        
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
                    <th>Action</th> <!-- Kolom Action baru -->
                    <th>Cetak</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $rowId = 1; // Inisialisasi variabel rowId
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['tanggal_pembayaran']) . "</td>
                                <td>" . htmlspecialchars($nama_pelanggan) . "</td>
                                <td>" . htmlspecialchars($row['nominal_bayar']) . "</td>
                                <td>" . htmlspecialchars($row['kurang_bayar']) . "</td>
                                <td><a href='uploads/" . htmlspecialchars($row['bukti_tf']) . "' target='_blank'>Lihat Bukti</a></td>
                                <td>" . htmlspecialchars($row['terbilang']) . "</td>
                                <td>" . htmlspecialchars($row['untuk_pembayaran']) . "</td>
                                <td>
                                    <a href='delete.php?id=" . $row['id'] . "&pelanggan_id=" . $pelanggan_id . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Delete</a>
                                </td>
                                <td>
                                    <button onclick=\"window.location.href='printkwitansi.php?id=" . $row['id'] . "'\" class='btn btn-primary'>Cetak</button>
                                </td>
                            </tr>";
                        
                        echo "<div class='kwitansi-container' data-id='$rowId' style='display:none;'>
                                <div class='kwitansi-text tanggal'>" . htmlspecialchars($row['tanggal_pembayaran']) . "</div>
                                <div class='kwitansi-text nama-pelanggan'>" . htmlspecialchars($nama_pelanggan) . "</div>
                                <div class='kwitansi-text nominal-bayar'>" . htmlspecialchars($row['nominal_bayar']) . "</div>
                                <div class='kwitansi-text terbilang'>" . htmlspecialchars($row['terbilang']) . "</div>
                                <div class='kwitansi-text untuk-pembayaran'>" . htmlspecialchars($row['untuk_pembayaran']) . "</div>
                            </div>";
                        
                        $rowId++; // Increment rowId
                    }
                } else {
                    echo "<tr><td colspan='9'>Tidak ada data pembayaran yang ditemukan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="internet_home.php" class="btn btn-secondary">Kembali</a>

    </div>
</body>
</html>

<?php
if ($conn) {
    $conn->close();
}
?>
