<?php 

if(isset($_POST['submit'])){

		$birim_adi  = 
			isset($_POST['birim_adi']) ? 
			htmlspecialchars(trim($_POST['birim_adi'])) :
			 null;

		$adres 		= 
			isset($_POST['adres']) ? 
			htmlspecialchars(trim($_POST['adres'])) : 
			null;

		$iletisim   = 
			isset($_POST['iletisim']) ? 
			htmlspecialchars(trim($_POST['iletisim'])) : 
			null;

		if(!$birim_adi){
			#birim adı boşsa
			$hata = 'birim adı boş bırakılamaz..!';
		}else if(!$adres){
			#adres boşsa
			$hata = 'adres boş bırakılamaz..!';
		}else if(!$iletisim){
			#iletişim boşsa
			$hata = 'iletişim boş bırakılamaz..!';
		}else{

			//ekleme işlemi
			$sorgu = 
				$db -> prepare('INSERT INTO birimler SET
					birimadi = ?,
					adres = ?,
					iletisim = ?
				')
			;

			$ekle = $sorgu -> execute(
				[
					$birim_adi,
					$adres,
					$iletisim
				]
			);

			if($ekle){
				// başarıyla eklenmişse
				header('Location: index.php?sayfa=b_select&ekleme_is=true');
			}else{
				echo $sorgu -> errorInfo();
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
						Birim Ekle
					</h6>
				</div>
				<div class="card-body">
					
					<form action="" method="post">
						<div class="form-group">
						    <label for="b_adi">Birim Adı</label>
						    <input type="text" name="birim_adi" required="" class="form-control" id="b_adi" placeholder="Birim Adı">
					  	</div>
					 	<div class="form-group">
					    	<label for="adres">Adres</label>
					    	<input type="text" name="adres" required=""  class="form-control" id="adres" placeholder="Adres">
					  	</div>
					  	<div class="form-group">
					    	<label for="iletisim">İletişim</label>
					    	<input type="text" name="iletisim" required="" class="form-control" id="iletisim" placeholder="İletişim">
					  	</div>							 

					  	<?php if (isset($hata)): ?>
					  	<div class="alert alert-danger alert-dismissible fade show" role="alert">
  							<strong>Yüksek oranda hata! </strong> 
  							<?php echo $hata; ?>
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    							<span aria-hidden="true">&times;</span>
  							</button>
						</div>
						<?php endif; ?>

					  	<div class="form-group">
							<button type="submit" class="btn btn-danger form-control">Ekle</button>
						</div>
						<input type="hidden" name="submit">
					</form>

				</div>
			</div>
		</div>
	</div>
</div>