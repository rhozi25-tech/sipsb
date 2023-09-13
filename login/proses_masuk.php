<?php
session_start(); // Mulai sesi
include '../conn.php'; // Sertakan file koneksi ke database
include "partials/header.php";
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
                echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Login Berhasil",
                    text: "Selamat datang, ' . $row['nama_santri'] . '!",
                    timer: 2000, // Tampilkan pesan selama 1,5 detik,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = "../dashboard/"; // Redirect ke halaman setelah login berhasil
                });
              </script>';
                exit();
            } else {
                // Status_bayar bukan "paid", tampilkan pesan kesalahan
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Akun ini belum dibayar",
                    text: "Silakan selesaikan pembayaran terlebih dahulu.",
                }).then(function() {
                    window.location.href = "index.php"; // 
                });
              </script>';
            }
        } else {
            // Kata sandi salah, tampilkan pesan kesalahan
            echo '<script>
    Swal.fire({
        icon: "error",
        title: "Kata sandi salah",
        text: "Silakan coba lagi.",
    }).then(function() {
        window.location.href = "index.php"; // 
    });
  </script>';
        }
    } else {
        // Nomor WhatsApp tidak ditemukan dalam database, tampilkan pesan kesalahan
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Akun tidak ditemukan",
                    text: "Akun dengan nomor WhatsApp tersebut tidak ditemukan.",
                }).then(function() {
                    window.location.href = "index.php"; // 
                });
              </script>';
    }
}

// Tutup koneksi ke database
$conn->close();
