<?php
if(!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php');
	exit;
}


$sorgu = $db -> prepare(' SELECT * FROM kategoriler WHERE id = ? ');
$sorgu -> execute( [$_GET['id']] );
$kategoriler = $sorgu -> fetch(PDO::FETCH_ASSOC);

if (!$kategoriler) {
	header('Location:index.php?sayfa=kategori-update');
	exit;
}



if(isset($_POST['submit'])){
	if(isset($_POST['submit'])){

		$isim 		= isset($_POST['isim']) 	  ? $_POST['isim'] 			: $kategoriler['ad'];			
		$hata 		= '';

		if(!$isim){

			#isim boşmu
			$hata.= 'Kategori İsmi alanı boş bırakılamaz<br>';

		}else{

			# güncelleme işlemi
			$sorgu = $db -> prepare(' UPDATE kategoriler SET kategori_isim = ? WHERE id 	= ?' );
			$guncelle = $sorgu -> execute([
				$isim,
				$_GET['id']
			]);

			if ($guncelle) {
				header('Location:index.php?sayfa=kategori-update&kategori-guncelleme-is=true');
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
						Kategori Güncelle
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
						    <label for="isim">Kategori İsmi</label>
						    <input type="text" required="" name="isim"  class="form-control" id="isim" placeholder="Kategori İsmi" value="<?php echo isset($_POST['isim']) ? $_POST['isim'] : $kategoriler['kategori_isim']?>">
						    
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