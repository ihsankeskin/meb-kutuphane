<?php 

  // $sorgu = $db -> prepare('SELECT * FROM ogrenciler WHERE birim_id');

  // $sorgu -> execute();

  // $mudurler = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);



$birim_id = $_SESSION["birim_id"];

$sorgu = $db -> prepare('SELECT * FROM ogrenciler WHERE birim_id = ?');

$sorgu -> execute([
	$birim_id
]);

$ogrenciler = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);



?>  
<!-- Basic Card Example -->
<div class="container-fluid">
  <!-- data table -->
    <div class="card shadow mb-4 col-xl-12 px-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
              Öğrenci Bilgileri Düzenleme
            </h6>
        </div>
            <div class="card-body">

              <?php 

                // öğrenci silme işlemi başarılı ise başarılı alert ekle

                $alert = <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>İşlem Yapıldı!</strong> Silme İşlemi Başarılı.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                HTML;

                if(@$_GET['silme-is'] && $_GET['silme-is']=='true'){
                  //get ten gelen silme-is varsa ve bu true ise
                  echo $alert;
                  //3 saniye sonra alert ü sil
                  //bunu index.php?sayfa=b_update
                  $url ="index.php?sayfa=ogrenci-update"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }
                
                ?>

              <div class="table-responsive">              

                <?php 

                // öğrenci güncelleme işlemi başarılı ise başarılı alert ekle

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
                  $url ="index.php?sayfa=ogrenci-update"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }
                
                ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-active">
                      <th>İsim</th>
                      <th>Soyisim</th>
                      <th>Tc No</th>
                      <th>Şifre</th>
                      <th>Telefon</th>
                      <th>E-posta</th>
                      <th>İşlemler</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr class="table-active">
                      <th>İsim</th>
                      <th>Soyisim</th>
                      <th>Tc No</th>
                      <th>Şifre</th>
                      <th>Telefon</th>
                      <th>E-posta</th>
                      <th>İşlemler</th>
                    </tr>
                  </tfoot>
                  <tbody>                    
                    
                    <?php foreach ($ogrenciler as $ogrenci): ?>
                    <tr>
                      <td>	<?php echo $ogrenci['ad']; 		?></td>
                      <td>	<?php echo $ogrenci['soyad']; 	?></td>
                      <td>	<?php echo $ogrenci['tcno']; 	?></td>
                      <td>	<?php echo $ogrenci['sifre']; 	?></td>
                      <td>	<?php echo $ogrenci['telefon']; ?></td>
                      <td>	<?php echo $ogrenci['eposta']; 	?></td>
                      <td>
                        <a href="index.php?sayfa=tek-ogrenci-guncelle&id=<?php echo $ogrenci['id']; ?>">
                          <button type="button" class="btn btn-warning">
                            Güncelle
                          </button>
                        </a> 
                        <a href="index.php?sayfa=tek-ogrenci-sil&id=<?php echo $ogrenci['id']; ?>">
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
































