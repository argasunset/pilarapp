<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="container">
        <h2>Data Pelanggan</h2>
        <div class="mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPelangganModal">Tambah Pelanggan</button>
            <button class="btn btn-secondary" data-toggle="modal" data-target="#inputPembayaranModal">Input Pembayaran</button>
        </div>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>No WA</th>
                    <th>Alamat</th>
                    <th>Paket Wifi</th>
                    <th>Tanggal Aktivasi</th>
                    <th>Status</th>
                    <th>History Pembayaran</th>
                </tr>
            </thead>
            <tbody>
            <?php
$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pelanggan_id = $_POST['pelanggan_id'];
    $tanggal_pembayaran = $_POST['tanggalPembayaran'];
    $nominal_bayar = $_POST['nominalBayar'];
    $kurang_bayar = $_POST['kurangBayar'];
    $terbilang = $_POST['terbilang'];
    $untuk_pembayaran = $_POST['untukPembayaran'];
    
    // Upload file bukti transfer
    $bukti_tf = $_FILES['buktiTf']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["buktiTf"]["name"]);
    
    if (move_uploaded_file($_FILES["buktiTf"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO pembayaran (pelanggan_id, tanggal_pembayaran, nominal_bayar, kurang_bayar, terbilang, untuk_pembayaran, bukti_tf) 
                VALUES ('$pelanggan_id', '$tanggal_pembayaran', '$nominal_bayar', '$kurang_bayar', '$terbilang', '$untuk_pembayaran', '$bukti_tf')";
                
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Gagal mengupload file']);
    }
    exit();
}
?>

            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Pelanggan -->
    <div class="modal fade" id="tambahPelangganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="tambah_pelanggan.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="no_wa">No WA</label>
                            <input type="text" class="form-control" id="no_wa" name="no_wa" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="paket_wifi">Paket Wifi</label>
                            <input type="text" class="form-control" id="paket_wifi" name="paket_wifi" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_aktivasi">Tanggal Aktivasi</label>
                            <input type="date" class="form-control" id="tanggal_aktivasi" name="tanggal_aktivasi" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Input Pembayaran -->
    <div class="modal fade" id="inputPembayaranModal" tabindex="-1" role="dialog" aria-labelledby="inputPembayaranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputPembayaranLabel">Input Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="savepembayaran.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nominalBayar">Nominal Bayar</label>
                            <input type="number" class="form-control" id="nominalBayar" name="nominalBayar" required>
                        </div>
                        <div class="form-group">
                            <label for="kurangBayar">Kurang Bayar</label>
                            <input type="number" class="form-control" id="kurangBayar" name="kurangBayar" required>
                        </div>
                        <div class="form-group">
                            <label for="buktiTf">Bukti Transfer</label>
                            <input type="file" class="form-control" id="buktiTf" name="buktiTf" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<script>
function toggleStatus(userId, currentStatus) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                var button = document.getElementById('status-button-' + userId);
                if (currentStatus == 'Aktif') {
                    button.classList.remove('btn-success');
                    button.classList.add('btn-danger');
                    button.textContent = 'Tidak Aktif';
                    button.setAttribute('onclick', 'toggleStatus(' + userId + ', "Tidak Aktif")');
                } else {
                    button.classList.remove('btn-danger');
                    button.classList.add('btn-success');
                    button.textContent = 'Aktif';
                    button.setAttribute('onclick', 'toggleStatus(' + userId + ', "Aktif")');
                }
            } else {
                alert('Gagal mengubah status: ' + response.error);
            }
        }
    };
    xhr.send("toggle_status=1&id=" + userId + "&current_status=" + currentStatus);
}
</script>
</body>
</html>
