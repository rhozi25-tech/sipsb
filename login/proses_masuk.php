<?php
session_start(); // Mulai sesi
include '../conn.php'; // Sertakan file koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $whatsapp = $_POST['whatsapp'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah pengguna dengan nomor WhatsApp yang diberikan ada dalam database
    $query = "SELECT * FROM santris WHERE whatsapp = '$whatsapp'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Memeriksa kata sandi
        if (password_verify($password, $row['password'])) {
            // Memeriksa status_bayar
            if ($row['status_bayar'] === 'PAID') {
                // Kata sandi cocok dan status_bayar adalah "paid", masukkan pengguna ke sesi
                $_SESSION['id'] = $row['id'];
                $_SESSION['nama_santri'] = $row['nama_santri'];

                // Redirect ke halaman setelah login berhasil
                header("Location: ../dashboard/");
                exit();
            } else {
                // Status_bayar bukan "paid", tampilkan pesan kesalahan
                echo "Akun ini belum dibayar. Silakan selesaikan pembayaran terlebih dahulu.";
            }
        } else {
            // Kata sandi salah, tampilkan pesan kesalahan
            echo "Kata sandi salah. Silakan coba lagi.";
        }
    } else {
        // Nomor WhatsApp tidak ditemukan dalam database, tampilkan pesan kesalahan
        echo "Akun dengan nomor WhatsApp tersebut tidak ditemukan.";
    }
}

// Tutup koneksi ke database
$conn->close();
