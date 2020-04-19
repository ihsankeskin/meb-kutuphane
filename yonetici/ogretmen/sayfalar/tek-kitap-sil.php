<?php 

// DELETE FROM tablo_adi WHERE id = 5

if(!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php');
	exit;
}

$sorgu = $db -> prepare('DELETE FROM kitaplar WHERE id = ?');

$sorgu -> execute([
	$_GET['id']
]);

header('Location:index.php?sayfa=kitap-update&kitap-silme-is=true');

?>