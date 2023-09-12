<?php
// Mulai session
session_start();

// Cek apakah session santri_id sudah ada
if (isset($_SESSION['id'])) {
    // Ambil ID santri dari session
    $santri_id = $_SESSION['id'];

    // Koneksi ke database
    include '../conn.php'; // Sesuaikan dengan nama file koneksi database Anda

    // Query untuk mengambil data santri dan detail_santri berdasarkan santri_id
    $sql = "SELECT s.*, ds.*, da.*, di.*
        FROM santris s
        LEFT JOIN detail_santri ds ON s.id = ds.santri_id
        LEFT JOIN detail_ayah da ON s.id = da.santri_id
        LEFT JOIN detail_ibu di ON s.id = di.santri_id
        WHERE s.id = $santri_id";


    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Sekarang $row berisi data dari tabel santris dan detail_santri yang telah digabungkan
        // Anda dapat mengakses data sesuai kebutuhan, misalnya $row['nama_santri'] atau $row['nama_instansi']
    } else {
        echo "Gagal menjalankan query: " . mysqli_error($conn);
    }
    
} else {
    header('location: ../login');
}
