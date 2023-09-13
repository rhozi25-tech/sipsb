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
<style>
    .card-body h4 {
        font-size: 13pt;
    }

    @media (max-width: 576px) {

        /* Mengubah lebar kartu hanya untuk ukuran smartphone (lebar maksimum 576px) */
        .card {
            width: 250px;
            height: 300px;
        }

        #salam.card {
            width: 100%;
            height: 200px;
        }

        .card-body h4 {
            font-size: 13pt;
        }

        #salam .card-body h4 {
            font-size: 17pt;
        }
    }
</style>
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
            <div class="col-sm-12">
                <div class="card card-selected" id="salam">
                    <div style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" class="card-body d-flex flex-column justify-content-center align-items-center" style="height: 200px;">
                        <h4 class="text-center">Assalamualaikum <?= $row['nama_santri']; ?></h4>
                    </div>
                </div>


            </div>
        </div>
        <div class="row overflow-x-auto" style="overflow-x: auto;">
            <!-- Kartu Kontainer -->
            <div class="d-flex flex-nowrap">
                <!-- Card Langkah 1 -->
                
                <div class="col-sm-4">
                    <div class="card" id="biodata">
                        <div style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" class="card-body d-flex align-content-between flex-wrap">
                            <h4 class="font-weight-bold">Langkah 1 : <br>Isi Biodata</h4>
                            <p class="text-justify">Silahkan melengkapi biodata terlebih dahulu sebelum memilih jadwal ujian pada yang sudah disediakan, Jika ada pertanyaan bisa menghubungi kami. </p>
                            <a href="../dashboard/bio_santri.php" class="btn card-selected d-block">Mulai Mengisi</a>
                        </div>
                    </div>
                </div>

                <!-- Card Langkah 2 -->
                <?php if ($showJadwalCard) : ?>
                    <div class="col-sm-4">
                        <div class="card" id="jadwal">
                            <div style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" class="card-body d-flex align-content-between flex-wrap">
                                <h4 class="font-weight-bold">Langkah 2 : <br>Jadwal Ujian</h4>
                                <p class="card-text text-justify">Jika sudah mengisi biodata secara lengkap, silahkan <b>pilih jadwal ujian</b> sesuai yang diinginkan. Jika sudah memilih, kami akan menghubungi anda melalui whatsapp.</p>
                                <a href="jadwal_ujian.php" class="btn card-selected d-block">Pilih Jadwal Ujian</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Card Langkah 3 dan lainnya -->
            <!--
    <div class="col-sm-4">
        <div class="card" id="berkas">
            <div class="card-body">
                <h5 class="card-title">Langkah 3 : Upload Berkas</h5>
                <p class="card-text">Siapkan upload berkas seperti yang diminta dan upload melalui website, Kami akan mengecek data anda.</p>
                <a href="#" class="btn btn-primary d-block">Upload Berkas</a>
            </div>
        </div>
    </div>
    -->
        </div>

    </div>
    <?php require_once "partials/footer.php"; ?>
</div>