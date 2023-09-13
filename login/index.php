<?php 
require_once "partials/header.php";
?>

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
                                <div class="logo-box"><a href="#" style="color: #f6921f; font-weight: bold;">Login Santri Baru</a></div>
                                <form method="POST" action="proses_masuk.php">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" name="whatsapp" class="form-control" id="whatsapp" placeholder="Masukan No. Whatsapp" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukan kata sandi" required>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn card-selected btn-block btn-submit">Masuk
                                        Sekarang</button><br>
                                    <a href="../daftar/" class="text-info">Belum punya akun ? Daftar</a>

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

<?php 
require_once "partials/footer.php";


?>