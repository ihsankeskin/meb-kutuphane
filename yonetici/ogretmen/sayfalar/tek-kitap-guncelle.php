<?php
if(!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php');
	exit;
}


$sorgu = $db -> prepare(' SELECT * FROM baglantili_kitaplar WHERE kitap_id = ? ');
$sorgu -> execute( [$_GET['id']] );
$kitap = $sorgu -> fetch(PDO::FETCH_ASSOC);


$sorgu_kategori = $db -> prepare(' SELECT * FROM kategoriler');
$sorgu_kategori -> execute();
$kategoriler = $sorgu_kategori -> fetchAll(PDO::FETCH_ASSOC);

$sorgu_yazar = $db -> prepare(' SELECT * FROM yazarlar');
$sorgu_yazar -> execute();
$yazarlar = $sorgu_yazar -> fetchAll(PDO::FETCH_ASSOC);

$secili_kategori_id = $kitap['kitap_kategori_id'];
$secili_yazar_id 	= $kitap['kitap_yazar_id'];



	if (!$kitap) {
		header('Location:index.php?sayfa=kitap-update');
		exit;
	}



if(isset($_POST['submit'])){
	if(isset($_POST['submit'])){

		$isbn 		= isset($_POST['isbn']) 	  ? $_POST['isbn'] 			: $kitap['kitap_isbn_no'];
		$kitap_ad 	= isset($_POST['kitap_ad'])   ? $_POST['kitap_ad']	 	: $kitap['kitap_ad'];
		$kategori	= isset($_POST['kategori'])   ? $_POST['kategori'] 		: $kitap['kategori_isim'];
		$yayin_ev	= isset($_POST['yayin_ev'])   ? $_POST['yayin_ev'] 		: $kitap['kitap_yayin_evi'];   
		$basim_yil 	= isset($_POST['basim_yil'])  ? $_POST['basim_yil'] 	: $kitap['kitap_yil'];		
		$yazar 		= isset($_POST['yazar']) 	  ? $_POST['yazar'] 		: $kitap['yazar_ad_soyad'];		
		$hata 		= '';


		if(!$isbn){

			#isbn no boşmu
			$hata.= 'ISBN no alanı boş bırakılamaz<br>';

		}else if(!$kitap_ad){

			#kitap ismi boşmu
			$hata.= 'Kitap isim alanı boş bırakılamaz<br>';

		}else if(!$yayin_ev){

			# yayın evi boşmu
			$hata.= 'Yayın Evi alanı boş bırakılamaz<br>';

		}else if(!ctype_digit($basim_yil)){

			# basım yılı sayısal değermi
			$hata.= 'Basım yılı alanı sayısal değer olmalıdır<br>';

		}else if(!(strlen($basim_yil) == 4)){

			# basım yılı 4 haneli bir sayısal değermi
			$hata.= 'Basım yılı alanı 4 haneli bir değer olmalıdır<br>';

		}else if(!ctype_digit($isbn)){

			# isbn no sayısal değermi
			$hata.= 'ISBN no alanı sayısal değer olmalıdır<br>';

		}else if (!(strlen($isbn) == 13)) {

			# isbn_no 13 haneden mi oluşuyor?
			$hata.= 'ISBN no alanı 13 haneden oluşmalıdır<br>';

		}else if($yazar == 'gecersiz'){

			# yazar seçilmiş mi?
			$hata.= 'Yazar seçilmeden işlem yapılamaz<br>';

		 }else if($kategori == 'gecersiz'){

			# kategori seçilmiş mi?
			$hata.= 'Kategori seçilmeden işlem yapılamaz<br>';

		 }else{

			// # güncelleme işlemi
			$sorgu_guncelle = $db -> prepare('UPDATE kitaplar SET
				ISBN_no		= ?,
				kitap_ad 	= ?,
				yayin_evi 	= ?,
				yili 		= ?,
				yazar_id 	= ?,
				kategori_id	= ?
				WHERE id 	= ?
			');

		
			$guncelle = $sorgu_guncelle -> execute([
				$isbn,
				$kitap_ad,
				$yayin_ev,
				$basim_yil,
				$yazar,
				$kategori,
				$_GET['id']
			]);

			if ($guncelle) {
				header('Location:index.php?sayfa=kitap-update&guncelleme-is=true');
			}else{
				$hata.= 'güncelleme işlemi başarısız...';
			}
		}	



	}
}






?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">
						Kitap Güncelle
					</h6>
				</div>
				<div class="card-body">

					<form action="" method="post">

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

						<div class="form-group">
						    <label for="for1">ISBN No</label>
						    <input type="text" required="" name="isbn"  maxlength="13" class="form-control" id="for1" placeholder="ISBN No" value="<?php echo isset($_POST['isbn']) ? $_POST['isbn'] : $kitap['kitap_isbn_no']?>">
						    
					  	</div>
					 	<div class="form-group">
					    	<label for="for2">Kitap Adı</label>
					    	<input type="text" required=""  name="kitap_ad"  class="form-control" id="for2" placeholder="Kitap Adı" 
					    	value="<?php echo isset($_POST['kita_ad']) ? $_POST['kita_ad'] : $kitap['kitap_ad']?>"
					    	>
					  	</div>											 
					  	<div class="form-group">
							<label class="my-1 mr-2" for="for3">Kategori</label>
						  	<select class="custom-select my-1 mr-sm-2" name="kategori" id="for3">
						  		<option value="gecersiz">-- kategori seçin --</option>
			
						  		<?php foreach ($kategoriler as $kategori):?>
						  		<option value="<?= $kategori['id']; ?>" 
						  		<?= $kategori['id'] == $secili_kategori_id ? 'selected' : '' ;  
						  			# seçili kategoriyi seç
						  		?>>
						  		<?= $kategori['kategori_isim']; ?>
								</option>
								<?php endforeach; ?>
						    	
						  	</select>				  
					  	</div>				  	
					  	<div class="form-group">
					    	<label for="for4">Yayın Evi</label>
					    	<input type="text" required=""  name="yayin_ev"  class="form-control" id="for4" placeholder="Yayın Evi" value="<?php echo isset($_POST['yayin_ev']) ? $_POST['yayin_ev'] : $kitap['kitap_yayin_evi']?>"
					    	>
					  	</div>
					  	<div class="form-group">
					    	<label for="for5">Basım Yılı</label>
					    	<input type="text" required=""  name="basim_yil"  class="form-control" id="for5" placeholder="XXXX (4 haneli boşluksuz yazınız)" maxlength="10" 
							value="<?php echo isset($_POST['basim_yil']) ? $_POST['basim_yil'] : $kitap['kitap_yil']?>"
					    	>
					  	</div>
					  	<div class="form-group">
							<label class="my-1 mr-2" for="for6">Yazar</label>
						  	<select class="custom-select my-1 mr-sm-2" name="yazar" id="for6">
						  		<option value="gecersiz">-- yazar seçin --</option>
			
						  		<?php foreach ($yazarlar as $yazar):?>
						  		<option value="<?= $yazar['id']; ?>" 
						  		<?= $yazar['id'] == $secili_yazar_id ? 'selected' : '' ;  
						  			# seçili yazarı seç
						  		?>>
						  		<?= $yazar['yazaradsoyad']; ?>
								</option>
								<?php endforeach; ?>
						    	
						  	</select>				  
					  	</div>											
					  	<div>
					  		<input type="hidden" name="submit" value="1">
					  	</div>	
					  	<div class="form-group">
							<button type="submit" class="btn btn-danger form-control">Güncelle</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div> 

<!-- if(!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php');
	exit;
}

$sorgu = $db -> prepare(' SELECT * FROM baglantili_kitaplar WHERE kitap_id = ? ');
$sorgu -> execute( [$_GET['id']] );
$kitaplar = $sorgu -> fetchAll(PDO::FETCH_ASSOC);

	if (!$kitaplar) {
		header('Location:index.php?sayfa=kitap-update');
		exit;
	}

 -->