<?php
include "session.php";
require_once "partials/header.php";

// Fungsi untuk memeriksa apakah data lengkap
function isDataComplete($conn, $santri_id)
{
    $query = "SELECT * FROM detail_santri
              LEFT JOIN detail_ayah ON detail_santri.santri_id = detail_ayah.santri_id
              LEFT JOIN detail_ibu ON detail_santri.santri_id = detail_ibu.santri_id
              WHERE detail_santri.santri_id = $santri_id";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Memeriksa apakah ada kolom yang NULL dalam hasil gabungan tabel
        foreach ($row as $key => $value) {
            if ($value === null) {
                return false;
            }
        }

        return true;
    }

    return false;
}


if (isDataComplete($conn, $santri_id)) {
    // Data sudah lengkap, tampilkan card jadwal
    $showJadwalCard = true;
} else {
    // Data belum lengkap, sembunyikan card jadwal
    $showJadwalCard = false;
}

?>

<div class="page-container">
    <?php require_once "partials/nav.php"; ?>
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
            <!-- Card lain jika data belum lengkap -->
            <div class="col-sm-4">
                <div class="card" id="biodata">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Langkah 1 : Isi Biodata</h5>
                        <p class="text-justify">Silahkan melengkapi biodata terlebih dahulu sebelum memilih jadwal ujian pada yang sudah disediakan, Jika ada pertanyaan bisa menghubungi kami. </p>
                        <a href="../dashboard/bio_santri.php" class="btn btn-primary d-block">Mulai Mengisi</a>
                    </div>
                </div>
            </div>
            <?php if ($showJadwalCard) : ?>
                <!-- Card jadwal -->
                <div class="col-sm-4">
                    <div class="card" id="jadwal">
                        <div class="card-body">
                            <h5 class="card-title">Langkah 2 : Jadwal Ujian</h5>
                            <p class="card-text text-justify">Jika sudah mengisi biodata secara lengkap, silahkan <b>pilih jadwal ujian</b> sesuai yang diinginkan. Jika sudah memilih, kami akan menghubungi anda melalui whatsapp.</p>
                            <a href="jadwal_ujian.php" class="btn btn-primary d-block">Pilih Jadwal Ujian</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <!-- Card lainnya
            <div class="col-sm-4">
                <div class="card" id="berkas">
                    <div class="card-body">
                        <h5 class="card-title">Langkah 3 : Upload Berkas</h5>
                        <p class="card-text">Siapkan upload berkas seperti yang diminta dan upload melalui website, Kami akan mengecek data anda.</p>
                        <a href="#" class="btn btn-primary d-block">Upload Berkas</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <?php require_once "partials/footer.php"; ?>
</div>