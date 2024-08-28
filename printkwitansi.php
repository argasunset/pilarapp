<?php
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$pelanggan_id = $_GET['id'];

// Fungsi untuk mengubah angka menjadi teks terbilang
function terbilang($angka) {
    $angka = abs($angka);
    $bilangan = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    
    $terbilang = "";
    
    if ($angka < 12) {
        $terbilang = " " . $bilangan[$angka];
    } else if ($angka < 20) {
        $terbilang = terbilang($angka - 10) . " belas";
    } else if ($angka < 100) {
        $terbilang = terbilang(floor($angka / 10)) . " puluh" . terbilang($angka % 10);
    } else if ($angka < 200) {
        $terbilang = " seratus" . terbilang($angka - 100);
    } else if ($angka < 1000) {
        $terbilang = terbilang(floor($angka / 100)) . " ratus" . terbilang($angka % 100);
    } else if ($angka < 2000) {
        $terbilang = " seribu" . terbilang($angka - 1000);
    } else if ($angka < 1000000) {
        $terbilang = terbilang(floor($angka / 1000)) . " ribu" . terbilang($angka % 1000);
    } else if ($angka < 1000000000) {
        $terbilang = terbilang(floor($angka / 1000000)) . " juta" . terbilang($angka % 1000000);
    } else if ($angka < 1000000000000) {
        $terbilang = terbilang(floor($angka / 1000000000)) . " milyar" . terbilang(fmod($angka, 1000000000));
    } else if ($angka < 1000000000000000) {
        $terbilang = terbilang(floor($angka / 1000000000000)) . " triliun" . terbilang(fmod($angka, 1000000000000));
    }

    return ($terbilang);
}

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
    $nomor_seri = 'KW-' . date('Ymd') . '-' . str_pad($data['id'], 5, '0', STR_PAD_LEFT);
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
         @font-face {
                font-family: 'monotype'; /* The name you want to use for the font */
                src: url('font/Monotype-Corsiva-Regular.ttf') format('truetype'); /* Replace with the correct file path */
                font-weight: normal;
                font-style: normal;
            }
        .kwitansi-container {
            position: relative;
            width: 1000px; /* Sesuaikan dengan lebar gambar */
            height: 600px; /* Sesuaikan dengan tinggi gambar */
            margin: 0 auto;
        }
        .kwitansi-text {
            position: absolute;
            font-family: 'monotype', sans-serif;
            color: #000;
            font-size: 15pt;
        }
        .nama-pelanggan {
            top: 150px; /* Sesuaikan posisi vertical */
            left: 280px; /* Sesuaikan posisi horizontal */
        }
        .nominal-bayar {
            top: 185px; /* Sesuaikan posisi vertical */
            left: 280px; /* Sesuaikan posisi horizontal */
        }
        .terbilang {
            top: 215px; /* Sesuaikan posisi vertical */
            left: 280px; /* Sesuaikan posisi horizontal */
        }
        .untuk-pembayaran {
            top: 250px; /* Sesuaikan posisi vertical */
            left: 280px; /* Sesuaikan posisi horizontal */
        }
        .tanggal {
            top: 310px; /* Sesuaikan posisi vertical */
            right: 200px; /* Sesuaikan posisi horizontal */
            text-align: right;
            font-size: 15pt; /* Sesuaikan ukuran font */
        }
        .nomor-seri {
            top: 15px; /* Sesuaikan posisi vertical */
            right: 30px; /* Sesuaikan posisi horizontal */
            font-size: 14px; /* Sesuaikan ukuran font */
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="kwitansi-container">
        <img width="100%" src="uploads/Kwitansi.png" alt="">
        <div class="kwitansi-text nomor-seri">
            No. Seri: <?php echo $nomor_seri; ?>
        </div>
        <div class="kwitansi-text nama-pelanggan">
            <?php echo htmlspecialchars($data['nama_pelanggan']); ?>
        </div>
        <div class="kwitansi-text nominal-bayar">
            <?php echo number_format($data['nominal_bayar'], 0, ',', '.'); ?>
        </div>
        <div class="kwitansi-text terbilang">
            <?php echo htmlspecialchars(terbilang($data['nominal_bayar'])) . " rupiah"; ?>
        </div>
        <div class="kwitansi-text untuk-pembayaran">
            <?php echo htmlspecialchars($data['untuk_pembayaran']); ?>
        </div>
        <div class="kwitansi-text tanggal">
            <?php echo date('d-m-Y', strtotime($data['tanggal_pembayaran'])); ?>
        </div>
    </div>

    <script>
        window.print();
        // Event listener untuk mendeteksi selesai mencetak
        window.addEventListener("afterprint", function() {
            // Setelah pencetakan selesai, alihkan ke halaman sebelumnya
          window.history.back();
        });
    </script>
</body>
</html>

<?php
if ($conn) {
    $conn->close();
}
?>
