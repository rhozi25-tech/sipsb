<?php
include "session.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $namaPanggilan = mysqli_real_escape_string($conn, trim($_POST['nama_panggilan']));
    $tempatLahir = mysqli_real_escape_string($conn, trim($_POST['tempat_lahir']));
    $tanggalLahir = mysqli_real_escape_string($conn, trim($_POST['tanggal_lahir']));
    $jenisKelamin = mysqli_real_escape_string($conn, trim($_POST['jenis_kelamin']));
    $sekolahAsal = mysqli_real_escape_string($conn, trim($_POST['sekolah_asal']));
    $jumlahHafalan = mysqli_real_escape_string($conn, trim($_POST['jumlah_hafalan']));
    $anakKe = mysqli_real_escape_string($conn, trim($_POST['anak_ke']));
    $jumlahSaudara = mysqli_real_escape_string($conn, trim($_POST['jumlah_saudara']));
    $penyakitDiderita = mysqli_real_escape_string($conn, trim($_POST['penyakit_diderita']));
    $alamatSosialMedia = mysqli_real_escape_string($conn, trim($_POST['alamat_sosial_media']));



    // Query SQL untuk mengupdate data
    $sql = "UPDATE detail_santri SET 
            nama_panggilan='$namaPanggilan',
            tempat_lahir='$tempatLahir',
            tanggal_lahir='$tanggalLahir',
            jenis_kelamin='$jenisKelamin',
            sekolah_asal='$sekolahAsal',
            jumlah_hafalan='$jumlahHafalan',
            anak_ke='$anakKe',
            jumlah_saudara='$jumlahSaudara',
            penyakit_diderita='$penyakitDiderita',
            alamat_sosial_media='$alamatSosialMedia'
            WHERE santri_id=$santri_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: bio_ayah.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}




require_once "partials/header.php";
?>
<div class="page-container">
    <?php
    require_once "partials/nav.php";
    ?>
    <div class="page-content">
        <div class="row">
            <div class="col-xl">
                <div class="card card-selected" id="salam">
                    <div style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" class="card-body d-flex flex-column justify-content-center align-items-center" style="height: 200px;">
                        <h4 class="text-center">Biodata Santri</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="namaLengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" value="<?= $row['nama_santri'] ?>" placeholder="Masukkan Nama Lengkap" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="namaPanggilan">Nama Panggilan</label>
                                    <input type="text" name="nama_panggilan" class="form-control" value="<?= $row['nama_panggilan'] ?>" id="namaPanggilan" placeholder="Masukkan Nama Panggilan" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tempatLahir">Tempat Lahir</label>
                                    <input type="text" value="<?= $row['tempat_lahir'] ?>" name="tempat_lahir" class="form-control" id="tempatLahir" placeholder="Masukkan Tempat Lahir" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tanggalLahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" value="<?= $row['tanggal_lahir'] ?>" class="form-control" id="tanggalLahir" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenisKelamin">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin" id="jenisKelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" <?php if ($row['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php if ($row['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sekolahAsal">Sekolah Asal</label>
                                <input type="text" name="sekolah_asal" value="<?= $row['sekolah_asal'] ?>" class="form-control" id="sekolahAsal" placeholder="Masukkan Nama Sekolah Asal" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="jumlahHafalan">Jumlah Hafalan</label>
                                    <input type="text" name="jumlah_hafalan" value="<?= $row['jumlah_hafalan'] ?>" class="form-control" id="jumlahHafalan" placeholder="Masukkan Jumlah Hafalan" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="anakKe">Anak ke</label>
                                    <input name="anak_ke" value="<?= $row['anak_ke'] ?>" type="number" class="form-control" id="anakKe" placeholder="Masukkan Anak ke" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="jumlahSaudara">Jumlah Saudara</label>
                                    <input name="jumlah_saudara" value="<?= $row['jumlah_saudara'] ?>" type="number" class="form-control" id="jumlahSaudara" placeholder="Masukkan Jumlah Saudara" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="penyakit">Penyakit yang Pernah Diderita</label>
                                    <input name="penyakit_diderita" value="<?= $row['penyakit_diderita'] ?>" type="text" class="form-control" id="penyakit" placeholder="Masukkan Penyakit yang Pernah Diderita" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamatSosialMedia">Alamat Sosial Media</label>
                                <input name="alamat_sosial_media" value="<?= $row['alamat_sosial_media'] ?>" type="text" class="form-control" id="alamatSosialMedia" placeholder="Masukkan Alamat Sosial Media" required>
                            </div>
                            <div class="d-flex bd-highlight mb-3">
                                <div class="mr-auto p-2 bd-highlight"><button type="submit" class="btn card-selected">Lanjut</button></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once "partials/footer.php";
    ?>