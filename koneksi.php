<?php

$koneksi = mysqli_connect("localhost", "root", "" ,"pilarapp");

$conn = new mysqli("localhost", "root", "", "pilarapp");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM pembayaran WHERE pelanggan_id='$pelanggan_id'";
$result = $conn->query($sql);

?>