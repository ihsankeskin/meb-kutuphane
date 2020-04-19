<?php 

  $sorgu = $db -> prepare('SELECT * FROM kategoriler ORDER BY id DESC');

  $sorgu -> execute();

  $kategoriler = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);


?>  
<!-- Basic Card Example -->
<div class="container-fluid">
  <!-- data table -->
    <div class="card shadow mb-4 col-xl-12 px-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
              Kategori Bilgileri Düzenleme
            </h6>
        </div>
            <div class="card-body">

              <?php 

                // kategori silme işlemi başarılı ise başarılı alert ekle

                $alert = <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>İşlem Yapıldı!</strong> Silme İşlemi Başarılı.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                HTML;

                if(@$_GET['kategori-silme-is'] && $_GET['kategori-silme-is']=='true'){
                  //get ten gelen yazar-silme-is varsa ve bu true ise
                  echo $alert;
                  //3 saniye sonra alert ü sil
                  //bunu index.php?sayfa=kategori-update
                  $url ="index.php?sayfa=kategori-update"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }
                
                ?>

              <div class="table-responsive">              

                <?php 

                // kategori güncelleme işlemi başarılı ise başarılı alert ekle

                $alert = <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>İşlem Yapıldı!</strong> Güncelleme İşlemi Başarılı.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                HTML;

                if(@$_GET['kategori-guncelleme-is'] && $_GET['kategori-guncelleme-is']=='true'){
                  //get ten gelen kategori-guncelleme-is varsa ve bu true ise
                  echo $alert;
                  //3 saniye sonra alert ü sil
                  //bunu index.php?sayfa=kategori-update
                  $url ="index.php?sayfa=kategori-update"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }
                
                ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-active">
                      <th>Kategori İsmi</th>                      
                      <th>İşlemler</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr class="table-active">
                      <th>Kategori İsmi</th>                      
                      <th>İşlemler</th>
                    </tr>
                  </tfoot>
                  <tbody>                    
                    
                    <?php foreach ($kategoriler as $kategori): ?>
                    
                    <tr>
                      <td><?php echo $kategori['kategori_isim']; ?></td>               
                      <td>
                        <a href="index.php?sayfa=tek-kategori-guncelle&id=<?php echo $kategori['id']; ?>">
                          <button type="button" class="btn btn-warning">
                            Güncelle
                          </button>
                        </a> 
                        <a href="index.php?sayfa=tek-kategori-sil&id=<?php echo $kategori['id']; ?>">
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

