<?php
$conn = new mysqli("localhost", "root", "", "pilarapp");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT id, nama_pelanggan FROM pelanggan";
$result = $conn->query($sql);

$customers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}

$conn->close();
echo json_encode($customers);
?>
