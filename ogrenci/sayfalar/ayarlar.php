<?php 

#oturum açmış olan öğrenci
$sorguS = $db -> prepare(' SELECT * FROM ogrenciler WHERE tcno = ? ');
$sorguS -> execute( [ $_SESSION['kullanici_adi'] ] );
$ogrenci = $sorguS -> fetch(PDO :: FETCH_ASSOC);

#oturum açmış öğrencinin ödünç aldığı kitap id ve öğrencinin id si
$odunc_alinan_kitap_id = $ogrenci['odunc_alinan_kitap_id'];
$ogrenci_id = $ogrenci['id'];


#öğrenciye ait varsa ödünç alınan kitap
$sorguB = $db -> prepare(' SELECT * FROM kitaplar WHERE odunc_durum_ogrenci_id = ? ');
$sorguB -> execute( [ $ogrenci_id ] );
$kitap = $sorguB -> fetch(PDO :: FETCH_ASSOC);
$kitapAskidami = $kitap['odunc_durum'];
$kitap_id = $kitap['id'];


#baglantili_kitaplar
$sorguBK = $db -> prepare(' SELECT * FROM baglantili_kitaplar WHERE kitap_id = ? ');
$sorguBK -> execute( [ $kitap_id ] );
$baglantili_kitaplar = $sorguBK -> fetch(PDO :: FETCH_ASSOC);


#zaman
$sorguZamanİcin = $db -> prepare(' SELECT 
	kitaplar.id 			as k_id,
	kitaplar.kitap_ad 		as k_ad,
  	zaman.last_time       	as z_last_time,
  	zaman.id              	as z_id

	FROM kitaplar	
  	INNER JOIN zaman        ON kitaplar.id = zaman.kitap_ID 
	
	WHERE zaman.kitap_id = ?
');

$sorguZamanİcin -> execute([
	$kitap_id
]);

$zamanZ = $sorguZamanİcin -> fetch(PDO :: FETCH_ASSOC);



?>
<!-- Basic Card Example -->
<div class="container-fluid">
	<!-- data table -->
    <div class="card shadow mb-4 col-xl-12 px-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            	Profil Bilgileri
            </h6>
        </div>

            <div class="card-body">

				<div class="row">
	            	<div class="col-md-6">

	            		<h4 class="mb-2">Avatar Resmi</h4>
	            		<img src="../img/avatar.jpg" alt="" class="mb-2 img-thumbnail rounded" width="150">


	            	</div>

	            	<div class="col-md-6">

	            		<h4 class="mb-4">Ödünç Kitap Bilgileri</h4>
						
		                <?php 
		               
		                // kitap iptal işlemi başarılı

$alert = <<<HTML
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Başarılı!</strong> Ödünç Alma İsteği İptal Edildi.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<hr>
HTML;

		                if(@$_GET['kitap-dus'] && $_GET['kitap-dus']=='true'){		                  
		                  echo $alert;
		                  //3 saniye sonra alert ü sil                  
		                  $url ="index.php?sayfa=profil"; 
		                  $time_out = 5;
		                  header("refresh: $time_out; url=$url");
		                }
		                
		                ?>		

<?php 
		               
// kitap iade et işlemi başarılı

$alert = <<<HTML
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Başarılı!</strong> Kitap İade İsteği İşlemi Alındı, Onaylanmasını Bekleyin.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<hr>
HTML;

		                if(@$_GET['kitap-iade-et'] && $_GET['kitap-iade-et']=='true'){		                  
		                  echo $alert;
		                  //3 saniye sonra alert ü sil                  
		                  $url ="index.php?sayfa=profil"; 
		                  $time_out = 5;
		                  header("refresh: $time_out; url=$url");
		                }
		                
?>			         				

		          		<table class="table table-hover">					  
					        <tbody>
					        	<tr>
					      			<th scope="row">Ödünç Alınan Kitap Durumu</th>
					                <td>
					                	<?php if ($kitapAskidami == '2'): #kitap askıda onay bekliyor ?>
					                	<button type="button" class="btn btn-warning">Onay Bekliyor</button>
					                	<a href="index.php?sayfa=profil&kitap-iptal=true">
					                		<button type="button" class="btn btn-danger">iptal et</button>
					                	</a>					                	
										<?php elseif($kitapAskidami == '1'): #ödünç alınmış ?>
										<button type="button" class="btn btn-success">Ödünç Alındı</button>	
										<a href="index.php?sayfa=profil&kitap-iade=true">
											<button type="button" class="btn btn-danger">İade Et</button>	
										</a>
										<?php elseif($kitapAskidami == '4'): #iade isteği gönderilmiş onay bekliyor ?>
										<button type="button" class="btn btn-warning">Kitap İade İçin Onay Bekliyor	</button>
										<?php else: ?>
					                	<button type="button" class="btn btn-danger">Ödünç Alınan Kitap Bulunmuyor</button>
					                	<?php endif; ?>					                
					                </td>					         
					    		</tr>
					    		<?php if($kitapAskidami == '1' || $kitapAskidami == '2' || $kitapAskidami == '4'): ?>
					        	<?php if($kitapAskidami == '1' || $kitapAskidami == '4'): ?>
					        	<?php if($kitapAskidami != '4'): #odunc_durum 4 ise gösterme #1523 ?>
					        	<tr>
					      			<th scope="row">Süre</th>
					                <td>
					                	<?php $zaman = ceil( ($zamanZ['z_last_time'] - time()) / 86400  ) . ' Gün'; ?>
				                      	<button type="button" class="btn <?= $zaman < '1' ? 'btn-danger' : 'btn-info';  ?>">
				                        <?= $zaman < '1' ? 'Zaman Tükendi' : $zaman;  ?>                        
				                        </button>
					                </td>					         
					    		</tr>
					    		<?php endif; #end of #1523?>
								<?php endif; ?>
					    		<tr>
					      			<th scope="row">Kitap ISBN No</th>
					                <td><?= $baglantili_kitaplar['kitap_isbn_no']; ?></td>					            
					    		</tr>
					        	<tr>
					      			<th scope="row">Kitap İsim</th>
					                <td><?= $baglantili_kitaplar['kitap_ad']; ?></td>					            
					    		</tr>
					    		<tr>
					      			<th scope="row">Yayın Evi</th>
					                <td><?= $baglantili_kitaplar['kitap_yayin_evi']; ?></td>					            
					    		</tr>
					    		<tr>
					      			<th scope="row">Kategori</th>
					                <td><?= $baglantili_kitaplar['kategori_isim']; ?></td>					            
					    		</tr>						    
					    		<tr>
					      			<th scope="row">Basım Yılı</th>
					                <td><?= $baglantili_kitaplar['kitap_yil']; ?></td>					            
					    		</tr>					    	
					    		<tr>
					      			<th scope="row">Yazar</th>
					                <td><?= $baglantili_kitaplar['yazar_ad_soyad']; ?></td>					            
					    		</tr>	
					    		<tr>
					      			<th scope="row">Okul</th>
					                <td><?= $baglantili_kitaplar['birim_adi']; ?></td>					            
					    		</tr>
					    		<tr>
					      			<th scope="row">Adres</th>
					                <td><?= $baglantili_kitaplar['kitap_adres']; ?></td>					            
					    		</tr>		
					    		<?php endif; ?>					    				    
					  		</tbody>
						</table>


	            	</div>
	            </div>

            </div>
    </div>
    <!-- /data table -->
</div>
<!-- end container-fluid -->


<?php 

#kitap iptal bölümü
if(@$_GET['kitap-iptal']){

	
	$sorguSt = $db -> prepare('UPDATE ogrenciler SET
		odunc_alinan_kitap_id = ?
		WHERE id 	= ?'
	);

	$Stguncelle = $sorguSt -> execute([
		'0',
		$ogrenci_id
	]);




	$sorguBkS = $db -> prepare('UPDATE kitaplar SET
		odunc_durum = ?,
		odunc_durum_ogrenci_id = ?
		WHERE id = ?
	');

	$BkguncelleS = $sorguBkS -> execute([
		'0',
		'0',
		$kitap_id
	]);

	if($Stguncelle && $BkguncelleS){
		#ogrenci den kitap_id ve kitaptan da öğrenci_id odunc_durum değişme olayı başarılı olursa
		#yönlendir
		header('Location: index.php?sayfa=profil&kitap-dus=true');
	}
	
}

?>

<?php 

#kitap iade bölümü
if(@$_GET['kitap-iade'] && @$_GET['kitap-iade'] == 'true'){

	
	$sorguIade = $db -> prepare('UPDATE kitaplar SET
		odunc_durum = ?
		WHERE id 	= ?'
	);

	$Ktguncelle = $sorguIade -> execute([
		'4',
		$kitap_id
	]);

	if($Ktguncelle){
		
		header('Location: index.php?sayfa=profil&kitap-iade-et=true');
	
	}
	
}

?>






