<?php
session_start(); // Memulai sesi jika belum dimulai

// Menghapus semua data sesi
session_unset();

// Mengakhiri sesi
session_destroy();

// Redirect ke halaman login atau halaman lain yang sesuai
header("Location: ../../login/"); // Ganti "login.php" dengan halaman login yang sesuai
exit();
