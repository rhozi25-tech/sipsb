<?php
include "session.php";
require_once "partials/header.php";

// Fungsi untuk menyimpan data jadwal ujian ke dalam database
function insertJadwal($conn, $nama, $tahfidz, $it, $santri_id)
{
    $query = "INSERT INTO jadwal_tes (nama, tahfidz, it, santri_id) VALUES ('$nama', '$tahfidz', '$it', '$santri_id')";

    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return false;
    }
}

// Tambahkan variabel untuk memeriksa apakah data jadwal sudah tersimpan atau belum
$dataJadwalTersimpan = false;

// Tambahkan logika untuk memeriksa apakah data jadwal sudah ada di tabel jadwal_tes
$queryCekData = "SELECT COUNT(*) AS jml_data FROM jadwal_tes WHERE santri_id = $santri_id";
$resultCekData = mysqli_query($conn, $queryCekData);

if ($resultCekData) {
    $rowCekData = mysqli_fetch_assoc($resultCekData);
    if ($rowCekData['jml_data'] > 0) {
        $dataJadwalTersimpan = true;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !$dataJadwalTersimpan) {
    // Mendapatkan data yang dikirimkan melalui formulir

    $tahfidz = $_POST["tahfidz"];
    $it = $_POST["it"];


    // Mengubah angka Tahfidz menjadi tanggal dengan format yang sesuai dengan database ("YYYY-MM-DD")
    $tanggalTahfidz = date('Y-m-d', strtotime(date('Y-m-') . $tahfidz));

    // Mengubah angka IT menjadi tanggal dengan format yang sesuai dengan database ("YYYY-MM-DD")
    $tanggalIT = date('Y-m-d', strtotime(date('Y-m-') . $it));

    // Memasukkan data jadwal ke dalam database
    if (insertJadwal($conn, $row['nama_santri'], $tanggalTahfidz, $tanggalIT, $santri_id)) {
        $dataJadwalTersimpan = true;
    } else {
        echo "Gagal menyimpan data jadwal ke database.";
    }
}
?>

<div class="page-container">
    <?php
    require_once "partials/nav.php";
    ?>
    <div class="page-content">
        <div class="page-info">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Apps</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <?php if (!$dataJadwalTersimpan) { ?>
                <div class="col-sm-4">
                    <div class="card" id="card1">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-center">Form Konfirmasi</h5>
                            <hr>
                            <form method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="nama_ayah">Nama Santri</label>
                                        <input type="text" value="<?= $row['nama_santri'] ?>" class="form-control" id="nama_santri" name="nama_santri" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="pilih_jadwal" class="font-weight-bold">Pilih Tanggal Ujian Tiap Sabtu</label>
                                        <div class="row">
                                            <div class="col">Tahfidz</div>
                                            <?php
                                            // Mendapatkan tanggal hari ini
                                            $currentDate = date('Y-m-d');
                                            $targetDates = array();

                                            // Loop untuk mendapatkan tanggal-tanggal yang jatuh pada hari Sabtu dalam 3 bulan ke depan
                                            for ($i = 0; $i < 2; $i++) {
                                                $nextSaturday = strtotime('next Saturday', strtotime($currentDate));
                                                $currentDate = date('Y-m-d', $nextSaturday);

                                                // Memeriksa apakah tanggal berada dalam bulan ini
                                                if (date('Y-m', strtotime($currentDate)) === date('Y-m')) {
                                                    $targetDates[] = date('d', $nextSaturday);
                                                }
                                            }

                                            // Loop melalui tanggal-tanggal yang didapatkan
                                            foreach ($targetDates as $date) {
                                                // Tampilkan kode yang Anda inginkan di sini
                                                echo '<div class="col">
        <div class="custom-control custom-radio">
            <input required class="custom-control-input" type="radio" name="tahfidz" id="tahfidz' . $date . '" value="' . $date . '">
            <label class="custom-control-label" for="tahfidz' . $date . '">
                ' . $date . '
            </label>
        </div>
    </div>';
                                            }

                                            ?>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="pilih_jadwal" class="font-weight-bold">Pilih Tanggal Ujian Tiap Ahad</label>
                                        <div class="row">
                                            <div class="col">IT</div>
                                            <?php
                                            // Mendapatkan tanggal hari ini
                                            $currentDate = date('Y-m-d');
                                            $targetDates = [];

                                            // Loop untuk mendapatkan tanggal-tanggal yang jatuh pada hari Minggu dalam 3 bulan ke depan
                                            for ($i = 0; $i < 2; $i++) {
                                                $nextSunday = strtotime('next Sunday', strtotime($currentDate));
                                                $currentDate = date('Y-m-d', $nextSunday);

                                                // Memeriksa apakah tanggal berada dalam bulan ini
                                                if (date('Y-m', strtotime($currentDate)) === date('Y-m')) {
                                                    $targetDates[] = date('d', $nextSunday);
                                                }
                                            }

                                            // Loop melalui tanggal-tanggal yang didapatkan
                                            foreach ($targetDates as $date) {
                                                // Tampilkan kode yang Anda inginkan di sini
                                                echo '<div class="col">
                                                      <div class="custom-control custom-radio">
                                                          <input required class="custom-control-input" type="radio" name="it" id="it' . $date . '" value="' . $date . '">
                                                          <label class="custom-control-label" for="it' . $date . '">
                                                              ' . $date . '
                                                          </label>
                                                      </div>
                                                  </div>';
                                            }

                                            ?>


                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary d-block">Ambil Jadwal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } else { // Tampilkan card2 jika data sudah tersimpan 
            ?>
                <div class="col-sm-4">
                    <div class="card" id="card2">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-center">Informasi Jadwal Ujian</h5>
                            <hr>
                            <p class="text-justify">Terima kasih sudah memilih jadwal ujian penemeriaan santri baru sekolah impian, berikut adalah jadwal yang kamu pilih : </p>
                            <?php
                            // Fungsi untuk mengubah nama hari dalam bahasa Inggris menjadi bahasa Indonesia
                            function translateDayToIndonesian($day)
                            {
                                $daysInEnglish = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                $daysInIndonesian = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

                                return str_replace($daysInEnglish, $daysInIndonesian, $day);
                            }

                            // Query ke database untuk mengambil tanggal Tahfidz dan IT
                            $query = "SELECT tahfidz, it FROM jadwal_tes WHERE santri_id = $santri_id"; // Sesuaikan dengan kondisi pengambilan data yang sesuai
                            $result = mysqli_query($conn, $query);

                            // Inisialisasi tanggal Tahfidz dan IT
                            $tanggalTahfidz = "";
                            $tanggalIT = "";

                            // Memeriksa apakah query berhasil dieksekusi
                            if ($result) {
                                // Memeriksa apakah ada hasil data dari query
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $tanggalTahfidz = $row["tahfidz"];
                                    $tanggalIT = $row["it"];

                                    // Ubah format tanggal ke format Indonesia (nama hari, tanggal bulan tahun)
                                    $tanggalTahfidz = translateDayToIndonesian(date('l', strtotime($tanggalTahfidz))) . ', ' . date('d F Y', strtotime($tanggalTahfidz));
                                    $tanggalIT = translateDayToIndonesian(date('l', strtotime($tanggalIT))) . ', ' . date('d F Y', strtotime($tanggalIT));
                                }
                            }

                            // Tampilkan tanggal yang dipilih dalam format yang diinginkan
                            echo '
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td>Tahfidz</td>
                                                                            <td>:</td>
                                                                            <th>' . $tanggalTahfidz . '</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>IT</td>
                                                                            <td>:</td>
                                                                            <th>' . $tanggalIT . '</th>
                                                                        </tr>
                                                                    </table>';
                            ?>

                            <p class="text-justify mt-3">Kami akan menghubungi melalui whatsapp untuk jam lebih lanjutnya</p>

                            <a href="index.php" class="btn btn-primary d-block">Kembali ke Dashboard</a>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php
    require_once "partials/footer.php";
    ?>
</div>