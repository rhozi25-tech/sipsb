<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "sekolahimpian");

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $whatsapp = $_POST["whatsapp"];

    // Query SQL untuk memeriksa apakah nomor WhatsApp sudah terdaftar
    $checkQuery = "SELECT id FROM santris WHERE whatsapp = '$whatsapp'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Nomor WhatsApp sudah terdaftar
        echo "exists";
    } else {
        // Nomor WhatsApp belum terdaftar
        echo "not_exists";
    }
}

$conn->close();
?>
