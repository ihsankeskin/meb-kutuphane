<?php 

$sorgu = $db -> prepare('SELECT * FROM birimler ORDER BY id DESC');
$sorgu -> execute();
$birimler = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);

?>
<!-- Basic Card Example -->
<div class="container-fluid">
	<!-- data table -->
    <div class="card shadow mb-4 col-xl-12 px-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            	Birim Düzenleme
            </h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">

                <?php 

                // birim güncelleme işlemi başarılı ise başarılı alert ekle

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
                  //bunu index.php?sayfa=b_update
                  $url ="index.php?sayfa=b_update"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }
                
                ?>

                <?php 

                // birim silme işlemi başarılı ise başarılı alert ekle

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
                  $url ="index.php?sayfa=b_update"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }
                
                ?>
                
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-active">
                      <th>Birim Adı</th>
                      <th>Adres</th>
                      <th>İletişim</th>  
                      <th>İşlemler</th>                    
                    </tr>
                  </thead>
                  <tfoot>
                     <tr class="table-active">
                      <th>Birim Adı</th>
                      <th>Adres</th>
                      <th>İletişim</th>
                      <th>İşlemler</th>                     
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php if ($birimler):?>
                  <?php foreach ($birimler as $birim): ?>
                    <tr>
                      <td><?php echo $birim['birimadi']; ?></td>
                      <td><?php echo $birim['adres']; ?></td>
                      <td><?php echo $birim['iletisim']; ?></td>
                      <td>
                        <a href="index.php?sayfa=tek-birim-guncelle&id=<?php echo $birim['id']; ?>">
                          <button type="button" class="btn btn-warning">
                            Güncelle
                          </button>
                        </a> 
                        <a href="index.php?sayfa=tek-birim-sil&id=<?php echo $birim['id']; ?>">
                          <button type="button" class="btn btn-danger">
                          Sil
                          </button>
                        </a>                     	                      	
                      </td>
                    </tr>
                  <?php endforeach; ?> 

                  <?php else: ?>
                  <!-- kayıtlı ders yoksa -->  
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Hata!</strong> Kayıtlı Birim Bulunmuyor...
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <hr>
                  <?php endif; ?>                            
                  </tbody>
                </table>
              </div>
            </div>
    </div>
    <!-- /data table -->
</div>
<!-- end container-fluid -->