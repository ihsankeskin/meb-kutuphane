<?php 

$yazarlar 		= $db -> query('SELECT * FROM yazarlar ORDER BY yazaradsoyad ASC') -> fetchAll(PDO::FETCH_ASSOC);
$kategoriler 	= $db -> query('SELECT * FROM kategoriler ORDER BY kategori_isim ASC') -> fetchAll(PDO::FETCH_ASSOC);

?>

<?php 

	if(isset($_POST['submit'])){

		$isbn_no 		= isset($_POST['isbn_no']) 	  		? $_POST['isbn_no'] 		: null;
		$kitap_isim 	= isset($_POST['kitap_isim']) 	  	? $_POST['kitap_isim']	 	: null;
		$yayin_evi		= isset($_POST['yayin_evi']) 	  	? $_POST['yayin_evi'] 		: null;
		$basim_yili		= isset($_POST['basim_yili']) 	  	? $_POST['basim_yili'] 		: null;
		$yazar_id		= isset($_POST['yazar_id']) 	  	? $_POST['yazar_id'] 		: null;   
		$kategori_id 	= isset($_POST['kategori_id']) 	  	? $_POST['kategori_id']		: null;
		$adres 			= isset($_POST['adres']) 	  		? $_POST['adres'] 			: null;	
		$birim_id 		= $_SESSION['birim_id'];	
		$hata 			= '';
	
echo $adres;
		if(!$isbn_no){

			#isbn no boşmu
			$hata.= 'ISBN no alanı boş bırakılamaz<br>';

		}else if(!$kitap_isim){

			#kitap ismi boşmu
			$hata.= 'Kitap isim alanı boş bırakılamaz<br>';

		}else if(!$yayin_evi){

			# yayın evi boşmu
			$hata.= 'Yayın Evi alanı boş bırakılamaz<br>';

		}else if(!ctype_digit($basim_yili)){

			# basım yılı sayısal değermi
			$hata.= 'Basım yılı alanı sayısal değer olmalıdır<br>';

		}else if(!(strlen($basim_yili) == 4)){

			# basım yılı 4 haneli bir sayısal değermi
			$hata.= 'Basım yılı alanı 4 haneli bir değer olmalıdır<br>';

		}else if(!ctype_digit($isbn_no)){

			# isbn no sayısal değermi
			$hata.= 'ISBN no alanı sayısal değer olmalıdır<br>';

		}else if (!(strlen($isbn_no) == 13)) {

			# isbn_no 13 haneden mi oluşuyor?
			$hata.= 'ISBN no alanı 13 haneden oluşmalıdır<br>';

		}else if($yazar_id == 'gecersiz'){

			# yazar seçilmiş mi?
			$hata.= 'Yazar seçilmeden işlem yapılamaz<br>';

		 }else if($kategori_id == 'gecersiz'){

			# kategori seçilmiş mi?
			$hata.= 'Kategori seçilmeden işlem yapılamaz<br>';

		 }else if(!$adres){

			# adres boşmu
			$hata.= 'Adres seçilmelidir<br>';

		 }else if( $adres != 'okul_adres' && $adres != 'sahis_adres' ){

		 	#bir çakallık dönüyor gibi
		 	$hata .= 'Ters giden bir şeyler var<br>';

		 }else{

			#adres belirleme
		 	if ($adres == 'okul_adres') {

		 		$adres = 'okul adresi';

		 	}else if($adres == 'sahis_adres'){

		 		$adres = 'kişisel adres';

		 	}

			//ekleme işlemi
			$sorgu_ekle = 
				$db -> prepare('INSERT INTO kitaplar SET
					ISBN_no 	= ?,
					kitap_ad 	= ?,
					yayin_evi 	= ?,
					yili 		= ?,
					adres 		= ?,
					yazar_id 	= ?,
					kategori_id	= ?,
					birim_id 	= ?					
				') ;

			$ekle = $sorgu_ekle -> execute(
				[
					$isbn_no,
					$kitap_isim,
					$yayin_evi,
					$basim_yili,
					$adres,
					$yazar_id,
					$kategori_id,
					$birim_id					
				]
			);


			if($ekle){
				// başarıyla eklenmişse
				header('Location: index.php?sayfa=kitap-select&kitap-ek-is=true');
			}else{
				echo $sorgu_ekle -> errorInfo();
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
						Kitap Ekle
					</h6>
				</div>
				<div class="card-body">

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

					<form action="" method="post">
						<div class="form-group">
						    <label for="for1">ISBN No</label>
						    <input type="text" required="" name="isbn_no"  class="form-control" id="for1" placeholder="isbn no" maxlength="13" value="<?php echo isset($_POST['isbn_no']) ? $_POST['isbn_no'] : '' ?>">
					  	</div>
					 	<div class="form-group">
					    	<label for="for2">Kitap İsim</label>
					    	<input type="text" required="" name="kitap_isim"  class="form-control" id="for2" placeholder="kitap isim" value="<?php echo isset($_POST['kitap_isim']) ? $_POST['kitap_isim'] : '' ?>">
					  	</div>
					  	<div class="form-group">
					    	<label for="for3">Yayın Evi</label>
					    	<input type="text" required="" name="yayin_evi"  class="form-control" id="for3" placeholder="yayin evi" value="<?php echo isset($_POST['yayin_evi']) ? $_POST['yayin_evi'] : '' ?>">
					  	</div>
					  	<div class="form-group">
					    	<label for="for4">Basım Yılı</label>
					    	<input type="text" required="" maxlength="4" name="basim_yili"  class="form-control" id="for4" placeholder="basım yılı" value="<?php echo isset($_POST['basim_yili']) ? $_POST['basim_yili'] : '' ?>">
					  	</div>
					  	<div class="form-group">
							<label class="my-1 mr-2" for="for5">Yazar</label>
						  	<select class="custom-select my-1 mr-sm-2" name="yazar_id" id="for5">
						  		<option value="gecersiz">-- yazar seçin --</option>
								
						  		<?php foreach ($yazarlar as $yazar):?>
						  		<option value="<?= $yazar['id']; ?>">
						  			<?= $yazar['yazaradsoyad']; ?>
								</option>
								<?php endforeach; ?>

						  	</select>				  
					  	</div>
					  	<div class="form-group">
							<label class="my-1 mr-2" for="for5">Kategori</label>
						  	<select class="custom-select my-1 mr-sm-2" name="kategori_id" id="for5">
						  		<option value="gecersiz">-- kategori seçin --</option>

						  		<?php foreach ($kategoriler as $kategori):?>
						  		<option value="<?= $kategori['id']; ?>">
						  			<?= $kategori['kategori_isim']; ?>
								</option>
								<?php endforeach; ?>
						    	
						  	</select>				  
					  	</div>
					  	<hr>
					  	<div class="form-grop">
					  		<p>Adres Seçimi</p>
					  		<input type="radio" name="adres" value="okul_adres" checked="" id="adres1">
					  		<label for="adres1">Okulumun Adresini Ver</label>
					  		<br>
					  		<input type="radio" name="adres" value="sahis_adres" id="adres2">
					  		<label for="adres2" title="kayıt edeceğiniz kitap şahsi kütüphanenize dahil ise ve kitabı elden ödünç vermek istiyorsanız profil bilgileri kısmından adres alanınızı boş bırakmayınız">Bana Ait Olan Adresi Ver</label>
					  	</div>					  	
					  	<hr>
					  	<div>
					  		<input type="hidden" name="submit" value="1">
					  	</div>	
					  	<div class="form-group">
							<button type="submit" class="btn btn-danger form-control">Ekle</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>