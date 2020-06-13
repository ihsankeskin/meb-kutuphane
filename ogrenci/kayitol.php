<?php
require_once '../baglan.php';
    //chapta

     //chapta
if(isset($_POST['submit'])){

    $isim       = isset($_POST['isim'])       ? $_POST['isim']          : null;
    $soyisim    = isset($_POST['soyisim'])    ? $_POST['soyisim']       : null;
    $tcno       = isset($_POST['tcno'])       ? $_POST['tcno']          : null;
    $sifre      = isset($_POST['sifre'])      ? $_POST['sifre']         : null;   
    $telno      = isset($_POST['telno'])      ? $_POST['telno']         : null;
    $email      = isset($_POST['email'])      ? $_POST['email']         : null; 
    $k_adi      = isset($_POST['k_adi'])      ? $_POST['k_adi']         : null; 
    $birim_id   = isset($_POST['birim_id'])   ? $_POST['birim_id']      : null; 
    $hata       = '';
    $basarili   = '';


    $sorgu = $db -> prepare('SELECT * FROM ogrenciler WHERE tcno = ?');

    $sorgu -> execute([
        $tcno
    ]);

    $tc_no_uyumsuz = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);

    if(!$isim){

        #isim boşmu
        $hata.= 'İsim alanı boş bırakılamaz<br>';

    }else if(!$soyisim){

        #soyisim boşmu
        $hata.= 'Soyisim alanı boş bırakılamaz<br>';

    }else if(!$tcno){

        # tcno boşmu
        $hata.= 'tcno alanı boş bırakılamaz<br>';

    }else if(!ctype_digit($tcno)){

        # tcno sayısal değermi
        $hata.= 'tcno alanı sayısal değer olmalıdır<br>';

    }else if (!(strlen($tcno) == 11)) {

        # tcno 11 haneden mi oluşuyor?
        $hata.= 'tcno alanı 11 haneden oluşmalıdır<br>';

    }else if($tc_no_uyumsuz){

        # veritabanında böyle bir ogr no varmı varsa reddet
        $hata.= 'Böyle bir Ögrenci numarasına sahip öğrenci zaten kayıtlı';

    }else if(!$sifre){

        # sifre boşmu
        $hata.= 'Şifre alanı boş bırakılamaz<br>';

    }else if(!$telno){

        # telno boşmu
        $hata.= 'Telefon numarası alanı boş bırakılamaz<br>';

    }else if(!ctype_digit($telno)){

        # telno sayısal değermi
        $hata.= 'Telefon numarası alanı sayısal değer olmalıdır<br>';

    }else if (!(strlen($telno) == 10)) {

        # telno 10 haneden mi oluşuyor?
        $hata.= 'Telefon numarası alanı 10 haneden oluşmalıdır, lütfen 0 olmadan boşluksuz 10 haneli değer girin<br>';

    }else if(!$email){

        # email boşmu
        $hata.= 'Email alanı boş bırakılamaz<br>';

    }else if(strlen($sifre) < 7) {
       // şifre gereksinimi
       $hata.= 'Şifreniz greksinimleri karşılamıyor içeriginde rakam ,özel karakter içermelidir ve minimum 8 karakter olmalıdır<br>';
  

    }else{
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


        //ekleme işlemi

        $sorgu_ekle = 
            $db -> prepare('INSERT INTO ogrenciler SET
                ad          = ?,
                soyad       = ?,
                tcno        = ?,
                sifre       = ?,
                telefon     = ?,
                eposta      = ?,
                k_adi       = ?,
                birim_id    = ?
        ') ;
        $adsifrelendi = openssl_encrypt($isim,$encrypt_method, $key, false, $iv);
        $soyadsifrelendi = openssl_encrypt($soyisim,$encrypt_method, $key, false, $iv);
        $epostasifrelendi = openssl_encrypt($email,$encrypt_method, $key, false, $iv);
        $sifrelendi = openssl_encrypt($sifre,$encrypt_method, $key, false, $iv);
        $sifrek_adi = openssl_encrypt($tcno,$encrypt_method, $key, false, $iv);
        $ekle = $sorgu_ekle -> execute(
            [
                $adsifrelendi,
                $soyadsifrelendi,
                $tcno,
                $sifrelendi,
                $telno,
                $epostasifrelendi,
                $sifrek_adi,
                $birim_id
            ]
        );

        if($ekle){
                // başarıyla eklenmişse
                $basarili.= 'Kayıt başarıyla tamamlandı. Giriş Yapabilirsiniz';
            }else{
                echo $sorgu_ekle -> errorInfo();
            }
            
  else:
    $hata = 'Lütfen insan olduğunuzu doğrulayın.<br> Hata Kodu: '.$result['error-codes'][0];
    endif;
  endif; 
    
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

                    <!-- formdan gelen hata varsa -->
                    <?php if (@$hata && $hata != ''): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Hata!</strong> <?php echo $hata; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <hr>
                    <?php endif; ?> 
                                     <?php if (@$basarili && $basarili != ''): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Tebrikler!</strong> <?php echo $basarili; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <hr>
                    <?php endif; ?> 

                                <form action="" method="post" class="user">
                                    <div class="form-group">
                                        <input type="input"   required class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Tc Kimlik Numaranızı Giriniz ..." name="tcno">
                                    </div>
                                    <div class="form-group">
                                        <input type="text"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Adınız" name="isim">
                                    </div>
                                    <div class="form-group">
                                        <input type="text"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Soyadınız" name="soyisim">
                                    </div>
                                    <div class="form-group">
                                        <input type="email"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Mail Adresiniz" name="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="tel"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Telefon Numaranız" name="telno">
                                    </div>
                                    <div class="form-group">
                                        <input type="text"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Kurumunuz Tarafından Verilen Şifre" name="birim_id">
                                    </div>
                                    <div class="form-group">
                                        <input type="password"  required class="form-control form-control-user" id="exampleInputPassword" placeholder="Şifreniz" name="sifre">
                                    </div>
                                         <!--chapta-->
                                     <div class="form-group">
                                         <div class="g-recaptcha" data-sitekey="6LdhlPEUAAAAACBxL_UgLTG06rPGMbitgQyhBR2N"></div>
                                    </div>
                                          <!--chapta-->
                                    <input type="hidden" value="reset">
                                    <input type="hidden" name="submit" value="1">
                                    <input type="reset"  value="Temizle" class="btn btn-primary btn-user btn-block">
                                    <hr>
                                    <input type="submit" value="Kayıt Ol" class="btn btn-primary btn-user btn-block">
                                </form>


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
 <script src='https://www.google.com/recaptcha/api.js?hl=tr'></script>

</body>

</html>

