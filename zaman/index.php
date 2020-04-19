<?php 

require_once '../baglan.php';

if (@$_POST['zaman']) {

	$sorgu = $db -> prepare('SELECT * FROM zaman WHERE kitap_id = ?');
	$sorgu -> execute(['3']);
	$zaman = $sorgu -> fetch(PDO :: FETCH_ASSOC);

	echo ceil($fark = ( $zaman['last_time'] - time() ) / 86400) . ' gün kaldı..';
 
}
?>


<form action="" method="post">
	<input type="hidden" name="zaman" value="1">
	<input type="submit" value="Gönder">
</form>