<?php
include "payment_channel.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Pendaftaran Santri Baru</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css" integrity="sha512-TfKjEQnBZlLzKYeI2QjOhBtC+89y9D+H4x4M4R+cRzpHzJQH+hcfcUS8S/YpGlA+NTJY3OHXHvB8uUgV0ew1cg==" crossorigin="anonymous" />



    <!-- Theme Styles -->
    <link href="../assets/css/connect.min.css" rel="stylesheet">
    <link href="../assets/css/dark_theme.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">


</head>

<body class="auth-page sign-in">


    <div class="connect-container align-content-stretch d-flex flex-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="auth-form">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <img class="img-fluid" src="../assets/images/logo.png" width="200" height="200" alt="">
                                </center>
                                <div class="logo-box"><a href="#" style="color: #f6921f; font-weight: bold;">Pendaftaran Santri
                                        Baru</a></div>
                                <form method="POST" action="proses.php">
                                    <input type="hidden" name="biaya_daftar" value="600000" id="biaya_daftar">
                                    <input type="hidden" name="status_bayar" value="UNPAID" id="status_bayar">
                                    <input type="hidden" name="no_referensi" id="no_referensi">

                                    <div class="form-group">
                                        <small>Nama CaLon Santri</small>
                                        <div class="input-group">
                                            <input type="text" name="nama_santri" class="form-control" id="nama_santri" placeholder="Nama Lengkap Calon Santri" required>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <small>No. Whatsapp Wali</small>
                                        <div class="input-group">
                                            <input type="number" name="whatsapp" class="form-control" id="whatsapp" placeholder="Masukan No. Whatsapp" required>
                                        </div>
                                        <small id="whatsapp-error" class="text-danger"></small>
                                    </div>
                                    <div class="form-group">
                                        <small>Untuk Pembuatan Akun</small>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan kata sandi" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Program PSB*</label><br>
                                        <small>Silakan pilih salah satu di bawah ini</small>

                                        <!-- Opsi Program PSB 1 -->
                                        <div class="card mb-2" id="quadrantCard1">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="school" value="smp" id="smp">
                                                            <label class="form-check-label" for="smp"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-11">
                                                        <h5 class="card-text">Pendaftaran Santri Baru Tingkat SMP</h5>
                                                        <p>
                                                        <div class="row card-text">
                                                            <div class="col-sm-6">Biaya Pendaftaran</div>
                                                            <div class="col-sm-6">: <strong>Rp. 600.000</strong></div>
                                                        </div>
                                                        <div class="row card-text mt-2">
                                                            <div class="col-sm-6">Uang Pangkal</div>
                                                            <div class="col-sm-6">: <strong>Rp. 32.900.000</strong>
                                                            </div>
                                                        </div>
                                                        <div class="row card-text mt-2">
                                                            <div class="col-sm-6">SPP </div>
                                                            <div class="col-sm-6">: <strong>Rp. 2.800.000</strong>
                                                            </div>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Opsi Program PSB 2 -->
                                        <div class="card mb-2" id="quadrantCard2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="school" value="sma" id="sma">
                                                            <label class="form-check-label" for="sma"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11">
                                                        <h5 class="card-text">Pendaftaran Santri Baru Tingkat SMA</h5>
                                                        <p>
                                                        <div class="row card-text">
                                                            <div class="col-sm-6">Biaya Pendaftaran</div>
                                                            <div class="col-sm-6">: <strong>Rp. 600.000</strong></div>
                                                        </div>
                                                        <div class="row card-text mt-2">
                                                            <div class="col-sm-6">Uang Pangkal</div>
                                                            <div class="col-sm-6">: <strong>Rp. 32.900.000</strong>
                                                            </div>
                                                        </div>
                                                        <div class="row card-text mt-2">
                                                            <div class="col-sm-6">SPP </div>
                                                            <div class="col-sm-6">: <strong>Rp. 2.800.000</strong>
                                                            </div>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Opsi Program PSB 3 -->
                                        <div class="card mb-2" id="quadrantCard3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="school" value="dhuafa" id="dhuafa">
                                                            <label class="form-check-label" for="dhuafa"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11">
                                                        <h5 class="card-text">Pendaftaran Santri Baru 'Program Dhuafa'
                                                        </h5>
                                                        <p>
                                                        <div class="row card-text">
                                                            <div class="col-sm-6">Biaya Pendaftaran</div>
                                                            <div class="col-sm-6">: <strong>Rp. 600.000</strong></div>
                                                        </div>
                                                        <div class="row card-text mt-2">
                                                            <div class="col-sm-12">
                                                                <ol>
                                                                    <li>Full beasiswa 'lulus dengan kategori high'</li>
                                                                    <li>Kuota Terbatas</li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <label for="method">Metode Pembayaran:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                            </div>
                                            <select class="form-control" id="method" name="method">
                                                <?php
                                                // Looping untuk menghasilkan daftar opsi angka
                                                for ($i = 0; $i < count($data_channel['data']); $i++) {
                                                    $code = $data_channel['data'][$i]['code'];
                                                    $name = $data_channel['data'][$i]['name'];
                                                    echo "<option value='$code'>$name</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn card-selected btn-block btn-submit">Daftar
                                        Sekarang</button><br>
                                    <a href="../login/" class="text-info">Sudah punya akun ? Masuk</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block d-xl-block gambar-daftar">
                </div>
            </div>
        </div>
    </div>



    <!-- Javascripts -->
    <script src="../assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="../assets/plugins/bootstrap/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/connect.min.js"></script>

    <script>
        $('form').submit(function() {
            $('button[type=submit]').prop('disabled', true);
            $('button[type=submit]').html('Sending message...');
            swal({
                title: "Proses Mendaftar",
                text: "mohon menunggu, kami sedang proses data anda ....",
                icon: "info",
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,

            });
        });
        $(document).ready(function() {
            $('.card').click(function() {
                // Reset semua card ke warna default
                $('.card').removeClass('card-selected');

                // Reset semua radio button menjadi unchecked
                $('.form-check-input').prop('checked', false);

                // Mengubah warna card saat dipilih
                $(this).addClass('card-selected');

                // Mengatur radio button yang sesuai menjadi checked
                $(this).find('.form-check-input').prop('checked', true);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk memeriksa nomor WhatsApp
            function checkWhatsApp() {
                var whatsapp = $("#whatsapp").val(); // Ambil nomor WhatsApp dari input
                $.ajax({
                    url: "check_whatsapp.php", // Ganti dengan URL ke file PHP yang akan melakukan pemeriksaan nomor WhatsApp
                    type: "POST",
                    data: {
                        whatsapp: whatsapp
                    },
                    success: function(response) {
                        // Response dari server (file PHP)
                        if (response == "exists") {
                            $("#whatsapp-error").text("Nomor WhatsApp sudah terdaftar.");
                        } else {
                            $("#whatsapp-error").text("");
                        }
                    }
                });
            }

            // Event listener saat input nomor WhatsApp berubah
            $("#whatsapp").on("input", function() {
                checkWhatsApp(); // Panggil fungsi untuk memeriksa nomor WhatsApp
            });
        });
    </script>


</body>

</html>