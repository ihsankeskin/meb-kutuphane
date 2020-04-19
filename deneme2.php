<?php 

session_start();

$time = time();

// 1

echo $kalan = (time() - $_SESSION['zaman']) / 60  . ' dakika++ oldu.. <br>';
echo (time() - $_SESSION['zaman'])  > 20 ? '20 saniye oldu' : '20 saniye dolmadı';



?>


