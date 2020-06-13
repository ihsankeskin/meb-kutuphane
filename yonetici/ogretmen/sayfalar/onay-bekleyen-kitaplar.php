<?php 

$sorgu = $db -> prepare(' 
	SELECT 
	kitaplar.id 			as k_id,
	kitaplar.ISBN_no 		   as k_ISBN_no,
	kitaplar.kitap_ad 		 as k_ad,
	kitaplar.yayin_evi 		  as k_yayin_evi,
	kitaplar.odunc_durum 	 as k_odunc_durum,
	kitaplar.adres 			   as k_adres,
	kitaplar.birim_id 		as k_birim_id,
	ogrenciler.id 			as o_id,
	ogrenciler.ad 			as o_ad,
	ogrenciler.soyad 		as o_soyad,
	ogrenciler.tcno 		as o_tc,
	ogrenciler.telefon 		as o_telefon,
	ogrenciler.birim_id 	as o_birim_id,
	birimler.birimadi 		as o_birim_ad

	FROM kitaplar
	INNER JOIN ogrenciler 	ON kitaplar.odunc_durum_ogrenci_id = ogrenciler.id
	INNER JOIN birimler 	ON ogrenciler.birim_id = birimler.id
	
	WHERE kitaplar.odunc_durum = ? AND kitaplar.birim_id = ?
');

$sorgu -> execute([
	'2',
	$_SESSION['birim_id']
]);

$onaylanmis_kitaplar = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);

?>
<!-- Basic Card Example -->
<div class="container-fluid">
	<!-- data table -->
    <div class="card shadow mb-4 col-xl-12 px-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            	Onay Bekleyen Kitaplar
            </h6>
        </div>
            <div class="card-body">

            <?php 

                // kitap onaylama işlemi başarılı ise başarılı alert ekle

                $alert = <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>İşlem Yapıldı!</strong> Onaylama İşlemi Başarılı.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                HTML;

                if(@$_GET['onaylama-islemi'] && $_GET['onaylama-islemi']=='true'){                
                  echo $alert;
                  //3 saniye sonra alert ü sil                  
                  $url ="index.php?sayfa=kitap-onay-bekleyen"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }


                ?>

              <div class="table-responsive">              
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-active">
                  	  <th>ISBN No</th>
                      <th>Kitap Adı</th>                      
                      <th>Yayın Evi</th>                   
          					  <th>Öğrenci Ad</th>
          					  <th>Öğrenci Soyad</th>
          					  <th>Ögrenci No</th>
          					  <th>Telefon</th>
          					  <th>Birim Adı</th>
          					  <th>Süre</th>                                        
                    </tr>
                  </thead>
                  <tfoot>
                  	<tr class="table-active">
                  	  <th>ISBN No</th>
                      <th>Kitap Adı</th>                      
                      <th>Yayın Evi</th>                   
          					  <th>Öğrenci Ad</th>
          					  <th>Öğrenci Soyad</th>
          					  <th>Ögrenci No</th>
          					  <th>Telefon</th>
          					  <th>Birim Adı</th>
          					  <th>Süre</th>                                
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach ($onaylanmis_kitaplar as $kitap): ?>
                    <tr>
                      <td> <?= $kitap['k_ISBN_no']; ?> 		</td>
                      <td> <?= $kitap['k_ad']; ?>      		</td>
                      <td> <?= $kitap['k_yayin_evi']; ?> 	</td>
                      <td>  <?php $sifrem= $kitap['o_ad']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?> </td>
                      <td> <?php $sifrem= $kitap['o_soyad']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?></td>
                      <td> <?= $kitap['o_tc']; ?> 			</td>
                      <td> <?= $kitap['o_telefon']; ?> 		</td>
                      <td> <?= $kitap['o_birim_ad']; ?> 	</td>
                      <td>
                        <a href="index.php?sayfa=kitap-onay-bekleyen&kitap-onayla=true&kitap=<?= $kitap['k_id']; ?>">
                          <button type="button" class="btn btn-success">Onayla</button>  
                        </a>
                      	
                      </td>
                                          
                    </tr>
                  <?php endforeach; ?>                               
                  </tbody>
                </table>
              </div>
            </div>
    </div>
    <!-- /data table -->
</div>
<!-- end container-fluid -->

<?php  

#kitap odunc_durum u 2 den 1 e güncelleme (kitap onaylama)

if(@$_GET['kitap-onayla'] && $_GET['kitap-onayla']=='true'){

  
  $sorgu = $db -> prepare(' UPDATE kitaplar SET odunc_durum = ? WHERE id  = ? ');

  $guncelle = $sorgu -> execute([
        '1',
        $_GET['kitap']    
  ]);


  #zaman tablosuna 14 gün lük süre ekle

  $on_dort_gun_sonra = time() + 1209600;

  $zaman_ekle = 
    $db -> prepare('INSERT INTO zaman SET
          last_time   = ?,
          kitap_id  = ?     
        ') ;

  $ekle = $zaman_ekle -> execute([
    $on_dort_gun_sonra,
    $_GET['kitap']
  ]);


  if($guncelle && $ekle){

    #güncelleme işlemi başarılı ise
    header('Location: index.php?sayfa=kitap-onay-bekleyen&onaylama-islemi=true');

  }

                  
}


?>