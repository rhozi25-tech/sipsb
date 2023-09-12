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
    <title>Login Santri Baru</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



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
                                <div class="logo-box"><a href="#" class="logo-text">Login Santri
                                        Baru</a></div>
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
                                    

                                    <button type="submit" class="btn btn-primary btn-block btn-submit">Masuk
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



    <!-- Javascripts -->
    <script src="../assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="../assets/plugins/bootstrap/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/connect.min.js"></script>
</body>

</html>