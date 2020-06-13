<?php
/**
 * Created by PhpStorm.
 * User: ihsan
 * Date: 2.05.2020
 * Time: 04:09
 */

$string ='ihsankeskin8@gmail.com';

$encrypt_method = 'AES-256-CBC'; //sifreleme yontemi
$secret_key = '26*_43'; //sifreleme anahtari
$secret_iv = '55-=**_'; //gerekli sifreleme baslama vektoru
$key = hash('sha256', $secret_key); //anahtar hast fonksiyonu ile sha256 algoritmasi ile sifreleniyor
$iv = substr(hash('sha256', $secret_iv), 0, 16);

$sifrelendi = openssl_encrypt($string,$encrypt_method, $key, false, $iv);


echo $sifrelendi; //V55yt+eoXX8GE4/dhlda6Q==
echo '<br>';


$sifre_cozuldu = openssl_decrypt($sifrelendi,$encrypt_method, $key, false, $iv);


echo $sifre_cozuldu; //denemeYazi

