<?php 


if(!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php?sayfa=kitaplar-cek');
	exit;
}

$sorgu = $db -> prepare('SELECT * FROM kitaplar WHERE id = ?');
$sorgu -> execute( [ $_GET['id'] ] );
$kitaplar = $sorgu -> fetch(PDO :: FETCH_ASSOC);

#böyle bir kitap yoksa
if (!$kitaplar) {
	header('Location:index.php?sayfa=kitaplar-cek');
	exit;
}

echo '<pre>';
print_r($kitaplar);
echo '</pre>';

if( $kitaplar['odunc_durum'] == '0' && $kitaplar['odunc_durum_ogrenci_id'] == '0') {
	#kitap ödünç alınabilir

	$sorguOgrenciCek = $db -> prepare('SELECT * FROM ogrenciler WHERE tcno = ? ');
	$sorguOgrenciCek -> execute( [$_SESSION['kullanici_adi']] );
	$ogrenci = $sorguOgrenciCek -> fetch(PDO :: FETCH_ASSOC);

	if ($ogrenci['odunc_alinan_kitap_id'] == '0' && $kitaplar['odunc_durum_ogrenci_id'] == '0' ) {
		#kitap alınabilir

		# kitap güncelleme işlemi
			$sorgu = $db -> prepare('UPDATE kitaplar SET
				odunc_durum 			= ?,
				odunc_durum_ogrenci_id 	= ?
				WHERE id 	= ?'
			);

			$guncelle = $sorgu -> execute([
				'2',
				$ogrenci['id'],
				$_GET['id']
			]);

			# ogrenci güncelleme işlemi
			$sorguS = $db -> prepare('UPDATE ogrenciler SET
				odunc_alinan_kitap_id 	= ?
				WHERE id 	= ?'
			);

			$guncelleS = $sorguS -> execute([
				$_GET['id'],
				$ogrenci['id']
			]);

			if ($guncelle && $guncelleS) {
				header('Location: index.php?sayfa=kitaplar-cek&kitap-odunc-aski-al=true');
				die();
			}

	}else{
		#kitap alınamaz
		header('Location: index.php?sayfa=kitaplar-cek&odunc-kitap-var=true');
		die();
	}

}else if($kitaplar['odunc_durum'] == '2'){
	#kitap askıda
	header('Location: index.php?sayfa=kitaplar-cek&kitap-aski=true');
	die();
}else if($kitaplar['odunc_durum'] == '1'){
	#kitap zaten ödünç istenmiş yada alınmış
	header('Location: index.php?sayfa=kitaplar-cek&kitap-alinmis=true');
	die();
}


?>