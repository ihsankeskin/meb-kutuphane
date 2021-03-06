<?php 
if(!isset($_GET['k_id']) || empty($_GET['k_id'])){
	header('Location:index.php');
	exit;
}
$sorgu = $db -> prepare(' 
	SELECT 
	kitaplar.id 			    as k_id,
	kitaplar.ISBN_no 		  as k_ISBN_no,
	kitaplar.kitap_ad 		as k_ad,
	kitaplar.yayin_evi 		as k_yayin_evi,
	kitaplar.odunc_durum 	as k_odunc_durum,
	kitaplar.adres 			  as k_adres,
	kitaplar.birim_id 		as k_birim_id,
	ogrenciler.id 			  as o_id,
	ogrenciler.ad 			  as o_ad,
	ogrenciler.soyad 		  as o_soyad,
	ogrenciler.tcno 		  as o_tc,
	ogrenciler.telefon 		as o_telefon,
	ogrenciler.birim_id 	as o_birim_id,
	birimler.birimadi 		as o_birim_ad,
  zaman.last_time       as z_last_time,
  zaman.id              as z_id

	FROM kitaplar
	INNER JOIN ogrenciler 	ON kitaplar.odunc_durum_ogrenci_id = ogrenciler.id
	INNER JOIN birimler 	  ON ogrenciler.birim_id = birimler.id
  INNER JOIN zaman        ON kitaplar.id = zaman.kitap_ID 
	
	WHERE kitaplar.odunc_durum = ? AND kitaplar.id = ?
');

$sorgu = $db -> prepare(' SELECT * FROM baglantili_kitaplar WHERE kitap_id = ? ');
$sorgu -> execute( [$_GET['k_id']] );
$kitap = $sorgu -> fetch(PDO::FETCH_ASSOC);

$onaylanmis_kitaplar = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);


?>
<!-- Basic Card Example -->
<div class="container-fluid">
	<!-- data table -->
    <div class="card shadow mb-4 col-xl-12 px-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            	Kitap Bilgileri
            </h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">

                <h3 class="text-info text-center h3  mb-4"><?= $kitap['kitap_ad']; ?></h3>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                
               <thead>
                    <tr class="table-active">
                      <th>Ödünç Alan Adı</th>
                      <th>Ödüç Alma Tarihi</th>
                      <th>Teslim Tarihi</th>
                    </tr>
               </thead>



                  <tbody>
         <?php foreach ($onaylanmis_kitaplar as $kitap): ?>
                    <tr>
                      <td> <?= $kitap['o_ad'];        ?>    </td>
                      <td> <?= $kitap['o_soyad'];     ?>    </td>
                      <td>

                        <?php $zaman = ceil( ($kitap['z_last_time'] - time()) / 86400  ) . ' Gün'; ?>
                        <button type="button" class="btn <?= $zaman < '1' ? 'btn-danger' : 'btn-info';  ?>">
                        <?= $zaman < '1' ? 'Zaman Tükendi' : $zaman;  ?>                        
                        </button>
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


<!--                  
                  <thead>

                  <tr class="table-active">
                  <th>ISBN No</th>
                  </tr>

                    <tr class="table-active">
                      <th>ISBN No</th>
                      <th>Kitap Adı</th>
                      <th>Kategori</th>
                    </tr>
                  </thead>





<tfoot>
                  	<tr class="table-active">
                  	  <th>ISBN No</th>
                      <th>Kitap Adı</th>
                      <th>Kategori</th>
                    </tr>
                  </tfoot> 





                  -->