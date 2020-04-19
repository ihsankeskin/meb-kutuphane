<?php 

	if(isset($_POST['submit'])){

		$isim 		= isset($_POST['isim']) 	  ? $_POST['isim'] 			: null;
		$hata 		= '';
	

		if(!$isim){

			#isim boşmu
			$hata.= 'İsim Soyisim alanı boş bırakılamaz<br>';

		}else{

			//ekleme işlemi
			$sorgu_ekle = 
				$db -> prepare(' INSERT INTO yazarlar SET yazaradsoyad	= ? ') ;

			$ekle = $sorgu_ekle -> execute(
				[
					$isim					
				]
			);

			if($ekle){
				// başarıyla eklenmişse
				header('Location: index.php?sayfa=yazar-select&yazar-ek-is=true');
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
						Yazar Ekle
					</h6>
				</div>
				<div class="card-body">

					<!-- formdan gelen hata varsa -->
					<?php if (@$hata && $hata != ''): ?>
					<!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
  						<strong>Hata!</strong> <?php echo $hata; ?>
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
  						</button>
					</div>
					<hr> -->
					<?php endif; ?>	

					<form action="" method="post">
						<div class="form-group">
						    <label for="isim">Yazar İsim Soyisim</label>
						    <input type="text" required="" name="isim"  class="form-control" id="isim" placeholder="İsim Soyisim" value="<?php echo isset($_POST['isim']) ? $_POST['isim'] : '' ?>">
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