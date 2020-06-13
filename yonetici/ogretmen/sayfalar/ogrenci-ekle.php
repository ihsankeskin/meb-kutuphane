<?php 

if(isset($_POST['submit'])){

	$isim 		= isset($_POST['isim']) 	  ? $_POST['isim'] 			: null;
	$soyisim 	= isset($_POST['soyisim']) 	  ? $_POST['soyisim']	 	: null;
	$tcno		= isset($_POST['tcno']) 	  ? $_POST['tcno'] 			: null;
	$sifre		= isset($_POST['sifre']) 	  ? $_POST['sifre'] 		: null;   
	$telno 		= isset($_POST['telno']) 	  ? $_POST['telno'] 		: null;
	$email 		= isset($_POST['email']) 	  ? $_POST['email'] 		: null;	
	$k_adi 		= isset($_POST['k_adi']) 	  ? $_POST['k_adi'] 		: null;	
	$birim_id	= $_SESSION['birim_id'];
	$hata 		= '';


	$sorgu = $db -> prepare('SELECT * FROM ogrenciler WHERE tcno = ?');

	$sorgu -> execute([
		$tcno
	]);

	$tc_no_uyumsuz = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);

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

	}else if($tc_no_uyumsuz){

		# veritabanında böyle bir Öğrenci no varmı varsa reddet
		$hata.= 'Böyle bir Ögrenci numarasına sahip öğrenci zaten kayıtlı';

	}else if(!$sifre){

		# sifre boşmu
		$hata.= 'Şifre alanı boş bırakılamaz<br>';

	}else if(!$telno){

		# telno boşmu
		$hata.= 'Telefon numarası alanı boş bırakılamaz<br>';

	}else if(!ctype_digit($telno)){

		# telno sayısal değermi
		$hata.= 'Telefon numarası alanı sayısal değer olmalıdır<br>';

	}else if (!(strlen($telno) == 10)) {

		# telno 10 haneden mi oluşuyor?
		$hata.= 'Telefon numarası alanı 10 haneden oluşmalıdır, lütfen 0 olmadan boşluksuz 10 haneli değer girin<br>';

	}else if(!$email){

		# email boşmu
		$hata.= 'Email alanı boş bırakılamaz<br>';

	}else{

		//ekleme işlemi

		$sorgu_ekle = 
			$db -> prepare('INSERT INTO ogrenciler SET
				ad 			= ?,
				soyad 		= ?,
				tcno 		= ?,
				sifre 		= ?,
				telefon 	= ?,
				eposta 		= ?,
				k_adi 		= ?,
				birim_id 	= ?
		') ;
        $adsifrelendi = openssl_encrypt($isim,$encrypt_method, $key, false, $iv);
        $soyadsifrelendi = openssl_encrypt($soyisim,$encrypt_method, $key, false, $iv);
        $epostasifrelendi = openssl_encrypt($email,$encrypt_method, $key, false, $iv);
        $sifrelendi = openssl_encrypt($sifre,$encrypt_method, $key, false, $iv);
        $sifrek_adi = openssl_encrypt($tcno,$encrypt_method, $key, false, $iv);
		$ekle = $sorgu_ekle -> execute(
			[
                $adsifrelendi,
                $soyadsifrelendi,
                $tcno,
                $sifrelendi,
                $telno,
                $epostasifrelendi,
                $sifrek_adi,
				$birim_id
			]
		);

		if($ekle){
				// başarıyla eklenmişse
				header('Location: index.php?sayfa=ogrenci-select&ogrenci-ek-is=true');
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
						Öğrenci Ekle
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
						    <input type="text" name="isim" required="" class="form-control" id="isim" placeholder="İsim"
						    value="<?php echo isset($_POST['isim']) ? $_POST['isim'] : '' ?>"
						    >
					  	</div>
					 	<div class="form-group">
					    	<label for="soyisim">Soyisim</label>
					    	<input type="text" name="soyisim" required="" class="form-control" id="soyisim" placeholder="Soyisim" 
					    	value="<?php echo isset($_POST['soyisim']) ? $_POST['soyisim'] : '' ?>"
					    	>
					  	</div>
					  	<div class="form-group">
					    	<label for="tckimlik">Tc. Kimlik No</label>
					    	<input type="text" name="tcno" required="" class="form-control" id="tckimlik" placeholder="11 haneli tc kimlik no" maxlength="11" 
					    	value="<?php echo isset($_POST['tcno']) ? $_POST['tcno'] : '' ?>" 
					    	>
					  	</div>					  	
					  	<div class="form-group">
					    	<label for="sifre">Şifre</label>
					    	<input type="text" name="sifre" required="" class="form-control" id="sifre" placeholder="Şifre"
							value="<?php echo isset($_POST['sifre']) ? $_POST['sifre'] : '' ?>"
					    	>
					  	</div>
					  	<div class="form-group">
					    	<label for="tel">Telefon No</label>
					    	<input type="text" name="telno" required="" class="form-control" id="tel" placeholder="5XX XXX XX XX (en fazla 10 karakter)" maxlength="10"
							value="<?php echo isset($_POST['telno']) ? $_POST['telno'] : '' ?>"
					    	>
					  	</div>
					  	<div class="form-group">
					    	<label for="mail">Email</label>
					    	<input type="email" name="email" required="" class="form-control" id="mail" placeholder="Email"
							value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"
					    	>
					  	</div>	
					  	<div>
					  		<input type="hidden" name="submit">
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




