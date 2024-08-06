<?php
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$pelanggan_id = $_GET['id'];

// Ambil nama pelanggan
$sql_nama = "SELECT nama_pelanggan FROM pelanggan WHERE id='$pelanggan_id'";
$result_nama = $conn->query($sql_nama);
$nama_pelanggan = $result_nama->fetch_assoc()['nama_pelanggan'];

// Ambil data pembayaran
$sql = "SELECT * FROM pembayaran WHERE pelanggan_id='$pelanggan_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pembayaran - <?php echo $nama_pelanggan; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['tanggal_pembayaran'] . "</td>
                                <td>" . $nama_pelanggan . "</td>
                                <td>" . $row['nominal_bayar'] . "</td>
                                <td>" . $row['kurang_bayar'] . "</td>
                                <td><a href='uploads/" . $row['bukti_tf'] . "' target='_blank'>Lihat Bukti</a></td>
                                <td>" . $row['terbilang'] . "</td>
                                <td>" . $row['untuk_pembayaran'] . "</td>
                            </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
