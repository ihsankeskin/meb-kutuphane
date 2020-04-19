<?php 
// $birim_id = $_SESSION["birim_id"];

$sorgu = $db -> prepare('
	SELECT 
		kitaplar.id 				      as kitap_id,
		kitaplar.ISBN_no 			    as kitap_ISBN_no,
		kitaplar.kitap_ad 		  	as kitap_ad,
		kitaplar.yayin_evi 		   	as kitap_yayin_evi,
		kitaplar.yili				      as kitap_yil,
		kitaplar.odunc_durum		  as kitap_odunc_durum,
		yazarlar.yazaradsoyad 		as yazar_ad_soyad,
		kategoriler.kategori_isim	as kategori_isim,
		birimler.birimadi			    as birim_adi
		FROM kitaplar
		INNER JOIN yazarlar 	    ON kitaplar.yazar_id = yazarlar.id
		INNER JOIN kategoriler 	  ON kitaplar.kategori_id = kategoriler.id
		INNER JOIN birimler 	    ON kitaplar.birim_id = birimler.id
		ORDER BY kitap_id DESC
');

$sorgu -> execute();

$kitaplar = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);



?>  
<!-- Basic Card Example -->
<div class="container-fluid">
  <!-- data table -->
    <div class="card shadow mb-4 col-xl-12 px-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
              Kitap Bilgileri Düzenleme
            </h6>
        </div>
            <div class="card-body">

              <?php 

                // kitap silme işlemi başarılı ise başarılı alert ekle

                $alert = <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>İşlem Yapıldı!</strong> Silme İşlemi Başarılı.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                HTML;

                if(@$_GET['kitap-silme-is'] && $_GET['kitap-silme-is']=='true'){
                  //get ten gelen kitap-silme-is varsa ve bu true ise
                  echo $alert;
                  //3 saniye sonra alert ü sil
                  //bunu index.php?sayfa=b_update
                  $url ="index.php?sayfa=kitap-update"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }
                
                ?>

              <div class="table-responsive">              

                <?php 

                // kitap güncelleme işlemi başarılı ise başarılı alert ekle

                $alert = <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>İşlem Yapıldı!</strong> Güncelleme İşlemi Başarılı.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                HTML;

                if(@$_GET['guncelleme-is'] && $_GET['guncelleme-is']=='true'){
                  //get ten gelen guncelleme-is varsa ve bu true ise
                  echo $alert;
                  //3 saniye sonra alert ü sil
                  //bunu index.php?sayfa=m_update
                  $url ="index.php?sayfa=kitap-update"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }
                
                ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-active">
                      <th>ISBN No</th>
                      <th>Kitap Adı</th>
                      <th>Kategori</th>
                      <th>Yayın Evi</th>
                      <th>Basım Yılı</th>
                      <th>Ödünç Durumu</th>
                      <th>Yazar</th>
                      <th>İşlemler</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr class="table-active">
                      <th>ISBN No</th>
                      <th>Kitap Adı</th>
                      <th>Kategori</th>
                      <th>Yayın Evi</th>
                      <th>Basım Yılı</th>
                      <th>Ödünç Durumu</th>
                      <th>Yazar</th>
                      <th>İşlemler</th>
                    </tr>
                  </tfoot>
                  <tbody>                    
                    
                    <?php foreach ($kitaplar as $kitap): ?>

                    <tr>
                      <td>	<?= $kitap['kitap_ISBN_no']; ?>		</td>
                      <td>	<?= $kitap['kitap_ad']; ?>			</td>
                      <td>	<?= $kitap['kategori_isim']; ?>		</td>
                      <td>	<?= $kitap['kitap_yayin_evi']; ?>	</td>
                      <td>	<?= $kitap['kitap_yil']; ?>			</td>
                      <td>	<?= $kitap['kitap_odunc_durum'] == '0' ? 'ödünç durumu yok' : 'ödünç alınmış'; ?>	</td>
                      <td>	<?= $kitap['yazar_ad_soyad']; ?>	</td>
                      <td>
                        <a href="index.php?sayfa=tek-kitap-guncelle&id=<?= $kitap['kitap_id']; ?>">
                          <button type="button" class="btn btn-warning">
                            Güncelle
                          </button>
                        </a> 
                        <a href="index.php?sayfa=tek-kitap-sil&id=<?= $kitap['kitap_id']; ?>">
                          <button type="button" class="btn btn-danger">
                          Sil
                          </button>
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
































