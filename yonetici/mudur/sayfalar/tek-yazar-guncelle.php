<?php
if(!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php');
	exit;
}


$sorgu = $db -> prepare(' SELECT * FROM yazarlar WHERE id = ? ');
$sorgu -> execute( [$_GET['id']] );
$yazarlar = $sorgu -> fetch(PDO::FETCH_ASSOC);

if (!$yazarlar) {
	header('Location:index.php?sayfa=yazar-update');
	exit;
}



if(isset($_POST['submit'])){
	if(isset($_POST['submit'])){

		$isim 		= isset($_POST['isim']) 	  ? $_POST['isim'] 			: $mudur['ad'];			
		$hata 		= '';

		if(!$isim){

			#isim boşmu
			$hata.= 'İsim Soyisim alanı boş bırakılamaz<br>';

		}else{

			# güncelleme işlemi
			$sorgu = $db -> prepare(' UPDATE yazarlar SET yazaradsoyad = ? WHERE id 	= ?' );
			$guncelle = $sorgu -> execute([
				$isim,
				$_GET['id']
			]);

			if ($guncelle) {
				header('Location:index.php?sayfa=yazar-update&yazar-guncelleme-is=true');
			}else{
				echo 'güncelleme işlemi başarısız...';
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
						Müdür Güncelle
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
						    <label for="isim">İsim</label>
						    <input type="text" required="" name="isim"  class="form-control" id="isim" placeholder="İsim" value="<?php echo isset($_POST['isim']) ? $_POST['isim'] : $yazarlar['yazaradsoyad']?>">
						    
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