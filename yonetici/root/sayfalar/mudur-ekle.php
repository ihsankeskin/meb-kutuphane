<?php 

$birimler = $db -> query('SELECT * FROM birimler ORDER BY birimadi ASC') -> fetchAll(PDO::FETCH_ASSOC);

?>

<?php 

	if(isset($_POST['submit'])){

		$isim 		= isset($_POST['isim']) 	  ? $_POST['isim'] 			: null;
		$soyisim 	= isset($_POST['soyisim']) 	  ? $_POST['soyisim']	 	: null;
		$tcno		= isset($_POST['tcno']) 	  ? $_POST['tcno'] 			: null;
		$kadi		= isset($_POST['kadi']) 	  ? $_POST['kadi'] 			: null;
		$sifre		= isset($_POST['sifre']) 	  ? $_POST['sifre'] 		: null;   
		$telno 		= isset($_POST['telno']) 	  ? $_POST['telno'] 		: null;
		$email 		= isset($_POST['email']) 	  ? $_POST['email'] 		: null;	
		$birim_id 	= isset($_POST['birim_id'])   ? $_POST['birim_id'] 		: null;	
		$hata 		= '';
	

		if(!$isim){

			#isim boşmu
			$hata.= 'İsim alanı boş bırakılamaz<br>';

		}else if(!$soyisim){

			#soyisim boşmu
			$hata.= 'Soyisim alanı boş bırakılamaz<br>';

		}else if(!$tcno){

			# tcno boşmu
			$hata.= 'Tcno alanı boş bırakılamaz<br>';

		}else if(!ctype_digit($tcno)){

			# tcno sayısal değermi
			$hata.= 'Tcno alanı sayısal değer olmalıdır<br>';

		}else if (!(strlen($tcno) == 11)) {

			# tcno 11 haneden mi oluşuyor?
			$hata.= 'Tcno alanı 11 haneden oluşmalıdır<br>';

		}else if(!$kadi){

			# tcno boşmu
			$hata.= 'Kullanıcı adı alanı boş bırakılamaz<br>';

		 }else if(!$sifre){

			# tcno boşmu
			$hata.= 'Şifre alanı boş bırakılamaz<br>';

		 }else if(!$telno){

			# tcno boşmu
			$hata.= 'Telefon numarası alanı boş bırakılamaz<br>';

		 }else if(!ctype_digit($telno)){

			# telno sayısal değermi
			$hata.= 'Telefon numarası alanı sayısal değer olmalıdır<br>';

		}else if (!(strlen($telno) == 10)) {

			# telno 10 haneden mi oluşuyor?
			$hata.= 'Telefon numarası alanı 10 haneden oluşmalıdır, lütfen 0 olmadan boşluksuz 10 haneli değer girin<br>';

		}else if(!$email){

			# tcno boşmu
			$hata.= 'Email alanı boş bırakılamaz<br>';

		}else if($birim_id == 'gecersiz'){

		 	# birim seçilmişmi
		 	$hata.= 'Birim Adı seçilmelidir';

		}else{

			//ekleme işlemi
			$sorgu_ekle = 
				$db -> prepare('INSERT INTO yoneticiler SET
					ad 			= ?,
					soyad 		= ?,
					tcno 		= ?,
					username 	= ?,
					sifre 		= ?,
					telefon 	= ?,
					eposta 		= ?,
					birim_id 	= ?,
					yetki 		= ?
				') ;

		$adsifrelendi = openssl_encrypt($isim,$encrypt_method, $key, false, $iv);
        $soyadsifrelendi = openssl_encrypt($soyisim,$encrypt_method, $key, false, $iv);
        $epostasifrelendi = openssl_encrypt($email,$encrypt_method, $key, false, $iv);
        $sifrelendi = openssl_encrypt($sifre,$encrypt_method, $key, false, $iv);
        $usernamesifre = openssl_encrypt($kadi,$encrypt_method, $key, false, $iv);

			$ekle = $sorgu_ekle -> execute(
				[
			    $adsifrelendi,
                $soyadsifrelendi,
                $epostasifrelendi,
                $sifrelendi,
                $usernamesifre,
				$tcno,
				$telno,
				$birim_id,
				'2'
				]
			);

			if($ekle){
				// başarıyla eklenmişse
				header('Location: index.php?sayfa=m_select&mudur-ek-is=true');
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
						Birim Sorumlusu Ekle
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
						    <label for="isim">İsim</label>
						    <input type="text" required="" name="isim"  class="form-control" id="isim" placeholder="İsim" value="<?php echo isset($_POST['isim']) ? $_POST['isim'] : '' ?>">
					  	</div>
					 	<div class="form-group">
					    	<label for="soyisim">Soyisim</label>
					    	<input type="text" required="" name="soyisim"  class="form-control" id="soyisim" placeholder="Soyisim" value="<?php echo isset($_POST['soyisim']) ? $_POST['soyisim'] : '' ?>">
					  	</div>
					  	<div class="form-group">
					    	<label for="tckimlik">Tc. Kimlik No</label>
					    	<input type="text" required="" name="tcno"  class="form-control" id="tckimlik" placeholder="11 haneli tc kimlik no" maxlength="11" value="<?php echo isset($_POST['tcno']) ? $_POST['tcno'] : '' ?>">
					  	</div>
					  	<div class="form-group">
					    	<label for="kadi">Kullanıcı Adı</label>
					    	<input type="text" required="" name="kadi"  class="form-control" id="kadi" placeholder="Kullanıcı Adı" value="<?php echo isset($_POST['kadi']) ? $_POST['kadi'] : '' ?>">
					  	</div>
					  	<div class="form-group">
					    	<label for="sifre">Şifre</label>
					    	<input type="text" required="" name="sifre"  class="form-control" id="sifre" placeholder="Şifre" value="<?php echo isset($_POST['sifre']) ? $_POST['sifre'] : '' ?>">
					  	</div>
					  	<div class="form-group">
					    	<label for="tel">Telefon No</label>
					    	<input type="text" required="" name="telno"  class="form-control" id="tel" placeholder="5XX XXX XX XX (10 haneli boşluksuz yazınız)" maxlength="10" value="<?php echo isset($_POST['telno']) ? $_POST['telno'] : '' ?>">
					  	</div>
					  	<div class="form-group">
					    	<label for="mail">Email</label>
					    	<input type="email" required="" name="email"  class="form-control" id="mail" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
					  	</div>	

					  	<div class="form-group">
							<label class="my-1 mr-2" for="birim">Birim</label>
						  	<select class="custom-select my-1 mr-sm-2" name="birim_id" id="birim">
						  		<option value="gecersiz">-- birim seçin -- </option>

						  		<?php foreach ($birimler as $birim):?>
						  		<option value="<?php echo $birim['id']; ?>">
						  			<?php echo $birim['birimadi']; ?>
								</option>
								<?php endforeach; ?>
						    	
						  	</select>				  
					  	</div>	
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