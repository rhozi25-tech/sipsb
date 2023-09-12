<?php
include "session.php";
// Cek apakah ada permintaan POST dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $namaAyah = $_POST['nama_ayah'];
    $profesi = $_POST['profesi'];
    $namaInstansi = $_POST['nama_instansi'];
    $penghasilan = $_POST['penghasilan'];
    $sosialMediaAyah = $_POST['sosial_media_ayah'];
    $namaSosialMediaAyah = $_POST['nama_sosial_media_ayah'];
    $alamatAyah = $_POST['alamat_ayah'];

    // Query SQL untuk mengupdate data berdasarkan ID sesi
    $sql = "UPDATE detail_ayah SET 
            nama_ayah='$namaAyah',
            profesi_ayah='$profesi',
            tempat_bekerja='$namaInstansi',
            penghasilan_ayah='$penghasilan',
            sosial_media_ayah='$sosialMediaAyah',
            nama_sosial_media='$namaSosialMediaAyah',
            alamat_ayah='$alamatAyah'
            WHERE santri_id=$santri_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: " . $_SERVER['PHP_SELF']);
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
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Biodata Ayah</h3>
                        <form method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_ayah">Nama Lengkap Ayah</label>
                                    <input type="text" value="<?= $row['nama_ayah'] ?>" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Masukan Nama Ayah ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="profesi">Profesi</label>
                                    <select class="form-control" id="profesi" name="profesi" required>
                                        <option value="">Pilih Profesi</option>
                                        <option value="PNS" <?= ($row['profesi_ayah'] == 'PNS') ? 'selected' : ''; ?>>PNS</option>
                                        <option value="Dokter" <?= ($row['profesi_ayah'] == 'Dokter') ? 'selected' : ''; ?>>Dokter</option>
                                        <option value="Guru" <?= ($row['profesi_ayah'] == 'Guru') ? 'selected' : ''; ?>>Guru</option>
                                        <option value="Wiraswasta" <?= ($row['profesi_ayah'] == 'Wiraswasta') ? 'selected' : ''; ?>>Wiraswasta</option>
                                        <option value="Programmer" <?= ($row['profesi_ayah'] == 'Programmer') ? 'selected' : ''; ?>>Programmer</option>
                                        <option value="Polisi" <?= ($row['profesi_ayah'] == 'Polisi') ? 'selected' : ''; ?>>Polisi</option>
                                        <option value="Pengusaha" <?= ($row['profesi_ayah'] == 'Pengusaha') ? 'selected' : ''; ?>>Pengusaha</option>
                                        <option value="Pengacara" <?= ($row['profesi_ayah'] == 'Pengacara') ? 'selected' : ''; ?>>Pengacara</option>
                                        <option value="Pilot" <?= ($row['profesi_ayah'] == 'Pilot') ? 'selected' : ''; ?>>Pilot</option>
                                        <!-- Tambahkan pilihan profesi lainnya sesuai kebutuhan -->
                                    </select>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_instansi">Nama Instansi/Perusahaan (jika ada)</label>
                                    <input type="text" value="<?= $row['tempat_bekerja'] ?>" class="form-control" id="nama_instansi" name="nama_instansi" placeholder="Contoh: PT ABC">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="penghasilan">Penghasilan</label>
                                    <select class="form-control" name="penghasilan" id="penghasilan" required>
                                        <option value="">Pilih Penghasilan</option>
                                        <option value="< Rp. 2.000.000" <?= ($row['penghasilan_ayah'] == '< Rp. 2.000.000') ? 'selected' : ''; ?>>
                                            < Rp. 2.000.000 </option>
                                        <option value="Rp. 2.100.000 – Rp. 3.000.000" <?= ($row['penghasilan_ayah'] == 'Rp. 2.100.000 – Rp. 3.000.000') ? 'selected' : ''; ?>>
                                            Rp. 2.100.000 – Rp. 3.000.000
                                        </option>
                                        <option value="Rp. 3.100.000 – Rp. 5.000.000" <?= ($row['penghasilan_ayah'] == 'Rp. 3.100.000 – Rp. 5.000.000') ? 'selected' : ''; ?>>
                                            Rp. 3.100.000 – Rp. 5.000.000
                                        </option>
                                        <option value="Rp. 5.100.000 – Rp. 7.500.000" <?= ($row['penghasilan_ayah'] == 'Rp. 5.100.000 – Rp. 7.500.000') ? 'selected' : ''; ?>>
                                            Rp. 5.100.000 – Rp. 7.500.000
                                        </option>
                                        <option value="Rp. 7.600.000 – Rp. 10.000.000" <?= ($row['penghasilan_ayah'] == 'Rp. 7.600.000 – Rp. 10.000.000') ? 'selected' : ''; ?>>
                                            Rp. 7.600.000 – Rp. 10.000.000
                                        </option>
                                        <option value="> Rp. 10.000.000" <?= ($row['penghasilan_ayah'] == '> Rp. 10.000.000') ? 'selected' : ''; ?>>
                                            > Rp. 10.000.000
                                        </option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sosial_media_ayah">Sosial Media Ayah</label>
                                    <select class="form-control" id="sosial_media_ayah" name="sosial_media_ayah" required>
                                        <option value="">Pilih Sosial Media</option>
                                        <option value="Facebook" <?= ($row['sosial_media_ayah'] == 'Facebook') ? 'selected' : ''; ?>>
                                            Facebook
                                        </option>
                                        <option value="Instagram" <?= ($row['sosial_media_ayah'] == 'Instagram') ? 'selected' : ''; ?>>
                                            Instagram
                                        </option>
                                        <option value="Twitter" <?= ($row['sosial_media_ayah'] == 'Twitter') ? 'selected' : ''; ?>>
                                            Twitter
                                        </option>
                                    </select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_sosial_media_ayah">Nama Sosial Media Ayah</label>
                                    <input type="text" class="form-control" value="<?= $row['nama_sosial_media'] ?>" id="nama_sosial_media_ayah" name="nama_sosial_media_ayah" placeholder="Contoh: Sekolah Impian" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_ayah">Alamat Ayah</label>
                                <textarea class="form-control" id="alamat_ayah" name="alamat_ayah" rows="3" placeholder="Contoh: Jl. Ahmad Yani No. 123, Kota ABC" required><?= $row['alamat_ayah'] ?></textarea>
                            </div>
                            <div class="d-flex bd-highlight mb-3">
                                <div class="mr-auto p-2 bd-highlight"><button type="submit" class="btn btn-primary btn-sm">Simpan</button></div>
                                <div class="p-2 bd-highlight">
                                    <a class="btn btn-secondary btn-sm" href="../dashboard/bio_santri.php">Kembali</a>
                                    <a class="btn btn-secondary btn-sm" href="../dashboard/bio_ibu.php">Lanjut</a>
                                </div>
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