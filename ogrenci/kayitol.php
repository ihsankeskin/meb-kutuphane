<?php
/**
 * Created by PhpStorm.
 * User: ihsan
 * Date: 18.04.2020
 * Time: 23:40
 */


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-danger">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Hoşgeldiniz!</h1>
                                </div>





                                <form action="" method="post" class="user">
                                    <div class="form-group">
                                        <input type="input"   required class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Tc Kimlik Numaranızı Giriniz ..." name="kullanici_adi">
                                    </div>
                                    <div class="form-group">
                                        <input type="text"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Adınız" name="ad">
                                    </div>
                                    <div class="form-group">
                                        <input type="text"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Soyadınız" name="soyad">
                                    </div>
                                    <div class="form-group">
                                        <input type="email"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Mail Adresiniz" name="mail">
                                    </div>
                                    <div class="form-group">
                                        <input type="tel"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Telefon Numaranız" name="telefon">
                                    </div>
                                    <div class="form-group">
                                        <input type="text"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Kurumunuz Tarafından Verilen Şifre" name="kurumid">
                                    </div>
                                    <div class="form-group">
                                        <input type="password"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Şifreniz" name="sifre">
                                    </div>
                                    <input type="hidden" value="reset">
                                    <input type="hidden" name="submit" value="1">
                                    <input type="reset"  value="Temizle" class="btn btn-primary btn-user btn-block">
                                    <hr>
                                    <input type="submit" value="Kayıt Ol" class="btn btn-primary btn-user btn-block">
                                </form>


                                <?php if(isset($hata)): ?>
                                    <div class="p-3">
                                        <div class="text-center text-danger m-10">
                                            <?php  echo $hata; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>


                                <hr>
                                <div class="text-center">
                                    <a class="small" href="index.php">Ana Sayfaya Dön ?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

</body>

</html>

