<?php 

// DELETE FROM tablo_adi WHERE id = 5

if(!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php');
	exit;
}

$sorgu = $db -> prepare('DELETE FROM birimler WHERE id = ?');

$sorgu -> execute([
	$_GET['id']
]);

header('Location:index.php?sayfa=b_update&silme-is=true');

?>