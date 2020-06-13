<?php

require_once '../baglan.php';
require 'mail/src/PHPMailer.php';
require 'mail/src/Exception.php';
require 'mail/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

   if($_POST){
           $eposta=trim($_POST['eposta']);


      $seposta = openssl_encrypt($eposta,$encrypt_method, $key, false, $iv);


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

           if(!$eposta) {
               $hata = 'boş alan bırakmayın...';
           }else{

               if(!filter_var($eposta,FILTER_VALIDATE_EMAIL)){
                   $hata = 'E Posta yanlış girildi...';
               }else{

                   $varmi = $db->prepare("SELECT ad,soyad,eposta FROM yoneticiler WHERE eposta=:e");
                   $varmi->execute([':e'=>$seposta]);

                   if ($varmi->rowCount()){

                       $row =$varmi->fetch (PDO::FETCH_ASSOC);
                       $sifirlamakodu=uniqid("kutuphane_");
                       $sifirlamlinki="http://kutuphane.ihsankeskin.org/yonetici/sifremisifirla.php?kod=".$sifirlamakodu;

                       $sifirlamakodunuekle = $db->prepare("UPDATE yoneticiler set sifirlama_kodu=:k WHERE eposta=:e" );
                       $sifirlamakodunuekle ->execute([':k'=>$sifirlamakodu,':e' => $seposta]);

                       $mail=new PHPMailer();
                       try {

                           //server ayarları
                           //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                           $mail->isSMTP();                                            // Send using SMTP
                           $mail->Host       = 'smtp.yandex.com';                    // Set the SMTP server to send through
                           $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                           $mail->Username   = 'ihsankeskin4@yandex.com';                     // SMTP username
                           $mail->Password   = '159ter428';                               // SMTP password
                           $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                           $mail->Port       = 587;                                       // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                           $mail->Subject ="Kutuphane sifre sifirlama linki";
                           $mail->Charset='UTF-8';
                           $mail->FromName="sifremi unuttum";
                           $mail->setLanguage('tr', 'mail/language');

                           //alıcı göndereici
                           $mail->setFrom('ihsankeskin4@yandex.com', '-KUTUPHANE-');
                           $mail->addAddress($eposta,);               // Name is optional
                           $mail->addReplyTo('hello@ihsankeskin.org', 'noreply');

                           $ad_cozuldu = openssl_decrypt($row['ad'],$encrypt_method, $key, false, $iv);
                           $soyad_cozuldu = openssl_decrypt($row['soyad'],$encrypt_method, $key, false, $iv);

                           $mail->isHTML(true);                                  // Set email format to HTML
                           $mail->Body = " <div style='font-size:20px'>Sayın : ".$ad_cozuldu." ".$soyad_cozuldu." şifre sıfırlama linkiniz : ".$sifirlamlinki." mailde hata oldugunu düşünüyorsanız lütfen sistem yöneticisi ile iletişime geçiniz</div>";

                           $mail->send();
                           $hata = 'şifre sıfırlama linkiniz belirtmiş oldugunuz mail adresine gönderilmiştir...';

                       } catch (Exception $e) {
                           $hata = "hata oluştu: {$mail->ErrorInfo}...";

                       }

                      }else{
                       $hata = 'girilen eposta adresi sistemde mevcut degildir';

                   }
               }

          }
              else:
                 $hata = 'Lütfen insan olduğunuzu doğrulayın.<br> Hata Kodu: '.$result['error-codes'][0];
              endif;
              endif;
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

    <title>Kutuphane - Şifre Sıfırlama</title>

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
                                    <h1 class="h4 text-gray-900 mb-4">Şifre Sıfırlama!</h1>
                                </div>





                                <form action="" method="post" class="user">
                                    <div class="form-group">
                                        <input type="email"   required class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Mail Adresinizi Giriniz Giriniz ..." name="eposta">
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
                                    <a class="small" href="index.php">Geri Dön !</a>
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