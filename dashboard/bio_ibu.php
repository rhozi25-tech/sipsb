<?php
include "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $namaIbu = mysqli_real_escape_string($conn, trim($_POST['nama_ibu']));
    $profesiIbu = mysqli_real_escape_string($conn, trim($_POST['profesi_ibu']));
    $namaInstansiIbu = mysqli_real_escape_string($conn, trim($_POST['nama_instansi_ibu']));
    $penghasilanIbu = mysqli_real_escape_string($conn, trim($_POST['penghasilan_ibu']));
    $sosialMediaIbu = mysqli_real_escape_string($conn, trim($_POST['sosial_media_ibu']));
    $namaSosialMediaIbu = mysqli_real_escape_string($conn, trim($_POST['nama_sosial_media_ibu']));
    $alamatIbu = mysqli_real_escape_string($conn, trim($_POST['alamat_ibu']));

    // Query SQL untuk mengupdate data berdasarkan ID sesi
    $sql = "UPDATE detail_ibu SET 
            nama_ibu='$namaIbu',
            profesi_ibu='$profesiIbu',
            tempat_bekerja_ibu='$namaInstansiIbu',
            penghasilan_ibu='$penghasilanIbu',
            sosial_media_ibu='$sosialMediaIbu',
            nama_sosial_media_ibu='$namaSosialMediaIbu',
            alamat_ibu='$alamatIbu'
            WHERE santri_id=$santri_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


require_once "partials/header.php";
?>
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>


<div class="page-container">
    <?php
    require_once "partials/nav.php";
    ?>
    <div class="page-content">
        <div class="row">
            <div class="col-xl">
                <div class="card card-selected" id="salam">
                    <div style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" class="card-body d-flex flex-column justify-content-center align-items-center" style="height: 200px;">
                        <h4 class="text-center">Biodata Ibu</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input type="text" class="form-control" value="<?= $row['nama_ibu'] ?>" id="nama_ibu" name="nama_ibu" placeholder="Masukan Nama Ibu">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="profesi_ibu">Profesi Ibu</label>
                                    <select class="form-control" id="profesi_ibu" name="profesi_ibu" required>
                                        <option value="">Pilih Profesi Ibu</option>
                                        <option value="PNS" <?= ($row['profesi_ibu'] == 'PNS') ? 'selected' : ''; ?>>PNS</option>
                                        <option value="Dokter" <?= ($row['profesi_ibu'] == 'Dokter') ? 'selected' : ''; ?>>Dokter</option>
                                        <option value="Guru" <?= ($row['profesi_ibu'] == 'Guru') ? 'selected' : ''; ?>>Guru</option>
                                        <option value="Wiraswasta" <?= ($row['profesi_ibu'] == 'Wiraswasta') ? 'selected' : ''; ?>>Wiraswasta</option>
                                        <option value="Programmer" <?= ($row['profesi_ibu'] == 'Programmer') ? 'selected' : ''; ?>>Programmer</option>
                                        <option value="Polisi" <?= ($row['profesi_ibu'] == 'Polisi') ? 'selected' : ''; ?>>Polisi</option>
                                        <option value="Pengusaha" <?= ($row['profesi_ibu'] == 'Pengusaha') ? 'selected' : ''; ?>>Pengusaha</option>
                                        <option value="Pengacara" <?= ($row['profesi_ibu'] == 'Pengacara') ? 'selected' : ''; ?>>Pengacara</option>
                                        <option value="IRT" <?= ($row['profesi_ibu'] == 'IRT') ? 'selected' : ''; ?>>Ibu Rumah Tangga</option>
                                        <!-- Tambahkan pilihan profesi lainnya sesuai kebutuhan -->
                                    </select>
                                </div>


                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_instansi_ibu">Nama Instansi/Perusahaan (jika ada)</label>
                                    <input type="text" value="<?= $row['tempat_bekerja_ibu'] ?>" class="form-control" id="nama_instansi_ibu" name="nama_instansi_ibu" placeholder="Contoh: PT XYZ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="penghasilan_ibu">Penghasilan Ibu</label>
                                    <select class="form-control" id="penghasilan_ibu" name="penghasilan_ibu" required>
                                        <option value="">Pilih Penghasilan Ibu</option>
                                        <option value="< Rp. 2.000.000" <?= ($row['penghasilan_ibu'] == '< Rp. 2.000.000') ? 'selected' : ''; ?>>
                                            < Rp. 2.000.000</option>
                                        <option value="Rp. 2.100.000 – Rp. 3.000.000" <?= ($row['penghasilan_ibu'] == 'Rp. 2.100.000 – Rp. 3.000.000') ? 'selected' : ''; ?>>Rp. 2.100.000 – Rp. 3.000.000</option>
                                        <option value="Rp. 3.100.000 – Rp. 5.000.000" <?= ($row['penghasilan_ibu'] == 'Rp. 3.100.000 – Rp. 5.000.000') ? 'selected' : ''; ?>>Rp. 3.100.000 – Rp. 5.000.000</option>
                                        <option value="Rp. 5.100.000 – Rp. 7.500.000" <?= ($row['penghasilan_ibu'] == 'Rp. 5.100.000 – Rp. 7.500.000') ? 'selected' : ''; ?>>Rp. 5.100.000 – Rp. 7.500.000</option>
                                        <option value="Rp. 7.600.000 – Rp. 10.000.000" <?= ($row['penghasilan_ibu'] == 'Rp. 7.600.000 – Rp. 10.000.000') ? 'selected' : ''; ?>>Rp. 7.600.000 – Rp. 10.000.000</option>
                                        <option value="> Rp. 10.000.000" <?= ($row['penghasilan_ibu'] == '> Rp. 10.000.000') ? 'selected' : ''; ?>>> Rp. 10.000.000</option>
                                    </select>
                                </div>



                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sosial_media_ibu">Sosial Media Ibu</label>
                                    <select class="form-control" id="sosial_media_ibu" name="sosial_media_ibu" required>
                                        <option value="">Pilih Sosial Media Ibu</option>
                                        <option value="Facebook" <?= ($row['sosial_media_ibu'] == 'Facebook') ? 'selected' : ''; ?>>Facebook</option>
                                        <option value="Instagram" <?= ($row['sosial_media_ibu'] == 'Instagram') ? 'selected' : ''; ?>>Instagram</option>
                                        <option value="Twitter" <?= ($row['sosial_media_ibu'] == 'Twitter') ? 'selected' : ''; ?>>Twitter</option>
                                        <!-- Tambahkan pilihan sosial media lainnya sesuai kebutuhan -->
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_sosial_media_ibu">Nama Sosial Media Ibu</label>
                                    <input type="text" value="<?= $row['nama_sosial_media_ibu'] ?>" class="form-control" id="nama_sosial_media_ibu" name="nama_sosial_media_ibu" placeholder="Contoh: sekolah impian">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_ibu">Alamat Ibu</label>
                                <textarea class="form-control" id="alamat_ibu" name="alamat_ibu" rows="3" placeholder="Contoh: Jl. Ahmad Yani No. 456, Kota XYZ" required><?= $row['nama_sosial_media_ibu'] ?></textarea>
                            </div>
                            <div class="d-flex bd-highlight mb-3">
                                <div class="mr-auto p-2 bd-highlight"><button type="submit" class="btn card-selected btn-sm">Simpan</button></div>
                                <div class="p-2 bd-highlight">
                                    <a class="btn btn-secondary btn-sm" href="../dashboard/bio_ayah.php">kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");

            form.addEventListener("submit", function(event) {
                event.preventDefault();

                Swal.fire({
                    title: "<span style='font-size: 20px; color:#faae40 '>Terima kasih sudah mengisi!</span>",
                    icon: "success",
                    timer: 2000, // Tampilkan pesan selama 1,5 detik
                    showConfirmButton: false,
                }).then(() => {
                    // Setelah SweetAlert ditampilkan, submit formulir
                    form.submit();
                });
            });
        });
    </script>

    <?php
    require_once "partials/footer.php";
    ?>