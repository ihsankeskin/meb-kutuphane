<?php

require_once '../baglan.php';
require_once '../sifreleme.php';
session_start();
  ob_start();

  if(isset($_POST['submit'])){
    //form post edildi
    $k_adi_sifrele  = strip_tags ( htmlspecialchars(trim($_POST['kullanici_adi'])));
    $metinsifre    = strip_tags ( htmlspecialchars(trim($_POST['sifre'])));


      $sifrelendi = openssl_encrypt($metinsifre,$encrypt_method, $key, false, $iv);
      $kullanici_adi = openssl_encrypt($k_adi_sifrele,$encrypt_method, $key, false, $iv);
/*
//chapta

function postCaptcha($response){
    $fieldsArray = array(
      'secret'    => '6LdhlPEUAAAAAB_PJ7KmrbjwutVwQ0ZfaOTZON_q',
      'response'    => $response
    );
    $postFields = http_build_query($fieldsArray);
    $ch =     curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
          curl_setopt($ch, CURLOPT_POST, count($fieldsArray));
          curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result =   curl_exec($ch);
          curl_close($ch);
    return json_decode($result,true);
  }
  if($_POST):
    $result = postCaptcha($_POST['g-recaptcha-response']);
    if ($result['success']):
      $hata = 'Doğrulama tamamlandı....';
     //chapta
      */
      //veritabanından username password u çek eğer uyuyorsa girilenlerle
    $sorgu = $db -> prepare(' SELECT * FROM ogrenciler 
      WHERE k_adi = ? AND sifre = ? ');
    $sorgu -> execute( [$kullanici_adi,$sifrelendi] );
    $ogrenciler = $sorgu->fetch();

    if(!$ogrenciler){
      $hata = 'kullanıcı adı veya şifre hatalı...';
    }else{

      $_SESSION['kullanici_adi'] = $ogrenciler['tcno'];
      // doğru username pass girildiyse tcno ile session oluştur
      $k_adim = $ogrenciler['ad'];
      $_SESSION['isim'] = openssl_decrypt($k_adim,$encrypt_method, $key, false, $iv);
      
       // doğru username pass girildiyse isim soyisim ile session oluştur

	    $_SESSION['birim_id'] = $ogrenciler['birim_id'];

      header('Location:index.php');
    }
/*
    else:
      $hata = 'Lütfen insan olduğunuzu doğrulayın.<br> Hata Kodu: '.$result['error-codes'][0];
    endif;
  endif; 
  */
  }

?>
<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Kütüphane - Giriş</title>

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
                      <input type="input"   required class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ögrenci Numaranızı Giriniz ..." name="kullanici_adi">
                    </div>
                    <div class="form-group">
                      <input type="password"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Şifreniz" name="sifre">
                    </div>
                    <!--chapta-->
                  <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LdhlPEUAAAAACBxL_UgLTG06rPGMbitgQyhBR2N"></div>
                  </div>
                    <!--chapta-->
                    <input type="hidden" name="submit" value="1">
                    <input type="submit" value="Giriş Yap" class="btn btn-primary btn-user btn-block">
                    <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Google İle Giriş
                    </a>
                    <a href="fblogin.php" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Facebook ile giriş
                    </a>
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
                    <a class="small" href="sifresifirlama.php">Şifremi Unuttum ?</a>
                  </div>
                  <!--<div class="text-center">
                    <a class="small" href="kayitol.php">Hesap Oluştur !</a>
                  </div>-->
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

  <script src='https://www.google.com/recaptcha/api.js?hl=tr'></script>

</body>

</html>
