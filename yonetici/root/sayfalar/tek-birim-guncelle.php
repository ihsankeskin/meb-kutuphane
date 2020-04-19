<?php

if(!isset($_GET['id']) || empty($_GET['id'])){
	header('Location:index.php');
	exit;
}

$sorgu = $db -> prepare('SELECT * FROM birimler WHERE id = ?');

$sorgu -> execute( [$_GET['id']] );

$birim = $sorgu -> fetch(PDO::FETCH_ASSOC);

if (!$birim) {
	header('Location:index.php?sayfa=b_update');
	exit;
}



if(isset($_POST['submit'])){
	if(isset($_POST['submit'])){
		$birim_adi 	= isset($_POST['birim_adi']) ? $_POST['birim_adi'] 	: $birim['birimadi'];
		$adres 		= isset($_POST['adres'])	 ? $_POST['adres'] 		: $birim['adres'];
		$iletisim   = isset($_POST['iletisim'])  ? $_POST['iletisim'] 	: $birim['iletisim'];

		if(!$birim_adi){
		echo 'birim adı belirleyin';
		}else if(!$adres){
			echo 'adres belirleyin';
		}else if(!$iletisim){
			echo 'iletişim bilgisi belirleyin';
		}else{
			$sorgu = $db -> prepare('UPDATE birimler SET
				birimadi 	= ?,
				adres 		= ?,
				iletisim 	= ?
				WHERE id 	= ?'
			);

			$guncelle = $sorgu -> execute([
				$birim_adi,
				$adres,
				$iletisim,
				$birim['id']
			]);

			if ($guncelle) {
				header('Location:index.php?sayfa=b_update&guncelleme-is=true');
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
						Birim Güncelle
					</h6>
				</div>
				<div class="card-body">
					
					<form action="" method="post">
						<div class="form-group">
						    <label for="b_adi">Birim Adı</label>
						    <input type="text" name="birim_adi" required="" class="form-control" id="b_adi"
						    value="<?php echo isset($_POST['birim_adi']) ? $_POST['birim_adi'] : $birim['birimadi']?>">
					  	</div>
					 	<div class="form-group">
					    	<label for="adres">Adres</label>
					    	<input type="text" name="adres" required=""  class="form-control" id="adres"
					    	value="<?php echo isset($_POST['adres']) ? $_POST['adres'] : $birim['adres']?>">
					  	</div>
					  	<div class="form-group">
					    	<label for="iletisim">İletişim</label>
					    	<input type="text" name="iletisim" required="" class="form-control" id="iletisim"
					    	value="<?php echo isset($_POST['iletisim']) ? $_POST['iletisim'] : $birim['iletisim']?>">
					  	</div>
					  	<div>
					  		<input type="hidden" name="submit" value="1">
					  	</div>			 					  
					  	<div class="form-group">
							<button type="submit" class="btn btn-danger form-control">Güncelle</button>
						</div>
						<input type="hidden" name="submit">
					</form>

				</div>
			</div>
		</div>
	</div>
</div>