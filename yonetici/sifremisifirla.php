<?php
/**
 * Created by PhpStorm.
 * User: ihsan
 * Date: 18.04.2020
 * Time: 22:24
 */

require_once '../baglan.php';
$kod = trim($_GET['kod']);
if(!$kod){
    $hata = 'Sıfırlama Kodu Hatalı Girildi...';

}else{
    if($_POST){
        $eposta =trim($_POST['email']);
        $sifre =trim($_POST['sifre']);
        $sifre2 =trim($_POST['sifre2']);

        if(!$eposta || !$sifre || !$sifre2){
            $hata = 'Boş Alan Bırakmayınız...';
        }else{

            if($sifre != $sifre2){
                $hata = 'Şifreler Uyuşmuyor...';
            }else {
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
                $seposta = openssl_encrypt($eposta,$encrypt_method, $key, false, $iv);

                $varmi = $db->prepare("SELECT *FROM yoneticiler WHERE sifirlama_kodu=:k AND eposta=:e");
                $varmi->execute ([':k' =>$kod, ':e'=>$seposta]);
                if($varmi->rowCount()){
                  $s_sifre = openssl_encrypt($sifre,$encrypt_method, $key, false, $iv);
                    $sifreguncelle = $db->prepare( "UPDATE yoneticiler SET sifirlama_kodu=:sifirla , sifre=:s WHERE sifirlama_kodu=:k AND eposta=:e");
                    $sifreguncelle->execute([':sifirla'=>"",':s'=>$s_sifre,':k'=>$kod,':e'=>$seposta]);
                    if($sifreguncelle){
                        $hata = 'Şifreniz başarıyla güncellendi...';

                    }else{
                        $hata = 'hata oluştu...';

                    }


                }else{
                    $hata = 'Girilen bilgilere göre bir kayıt bulunamadı...';

                }
               else:
                 $hata = 'Lütfen insan olduğunuzu doğrulayın.<br> Hata Kodu: '.$result['error-codes'][0];
              endif;
              endif;
            }

        }
    }

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

    <title>Kutuphane - Şifremi Sıfırla</title>

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
                                    <h1 class="h4 text-gray-900 mb-4">Şifre Sıfırlama Son Adım !</h1>
                                </div>





                                <form action="" method="post" class="user">
                                    <div class="form-group">
                                        <input type="email"   required class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Mail Adresinizi Giriniz Giriniz ..." name="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password"   required class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Şifrenizi Giriniz ..." name="sifre">
                                    </div>
                                    <div class="form-group">
                                        <input type="password"   required class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Tekrar Şifrenizi Giriniz ..." name="sifre2">
                                    </div>
                                          <!--chapta-->
                                     <div class="form-group">
                                         <div class="g-recaptcha" data-sitekey="6LdhlPEUAAAAACBxL_UgLTG06rPGMbitgQyhBR2N"></div>
                                    </div>
                                          <!--chapta-->
                                    <input type="hidden" name="submit" value="1">
                                    <input type="submit" value="Şifremi Sıfırla" class="btn btn-primary btn-user btn-block">

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
                                    <a class="small" href="index.php">Vazgeç !</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="index.php">Ana Sayfaya Dön !</a>
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
<script src='https://www.google.com/recaptcha/api.js?hl=tr'></script>

</body>

</html>
