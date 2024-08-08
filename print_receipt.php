<!DOCTYPE html>
<html>
<head>
    <title>Cetak Kwitansi</title>
    <style>
        /* Tambahkan CSS di sini untuk desain kwitansi */
    </style>
</head>
<body>
    <?php
    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'pilarapp');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data pembayaran berdasarkan ID
    $paymentId = $_GET['id'];
    $sql = "SELECT * FROM pembayaran WHERE id = $paymentId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Tampilkan kwitansi dengan data yang diambil
        echo "<h1>Kwitansi</h1>";
        echo "<p>Telah terima dari: " . $row['pelanggan_id'] . "</p>";
        echo "<p>Uang sejumlah: " . $row['nominal_bayar'] . "</p>";
        echo "<p>Terbilang: " . $row['terbilang'] . "</p>";
        echo "<p>Untuk pembayaran: " . $row['untuk_pembayaran'] . "</p>";
        echo "<p>Taggal pembayaran: " . $row['tanggal_pembayaran'] . "</p>";
        // Tambahkan elemen lainnya sesuai dengan desain kwitansi Anda
    } else {
        echo "Data tidak ditemukan.";
    }
    $conn->close();
    ?>
     <script>
        window.print();
    </script>
</body>
</html>
