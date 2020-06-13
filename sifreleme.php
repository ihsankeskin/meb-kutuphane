<?php
/**
 * Created by PhpStorm.
 * User: ihsan
 * Date: 2.05.2020
 * Time: 01:30
 */

$encrypt_method = 'AES-256-CBC'; //sifreleme yontemi
$secret_key = '26*_43'; //sifreleme anahtari
$secret_iv = '55-=**_'; //gerekli sifreleme baslama vektoru
$key = hash('sha256', $secret_key); //anahtar hast fonksiyonu ile sha256 algoritmasi ile sifreleniyor
$iv = substr(hash('sha256', $secret_iv), 0, 16);

?>