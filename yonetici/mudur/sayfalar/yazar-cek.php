<?php 

$sorgu = $db -> prepare('SELECT * FROM yazarlar ORDER by id DESC');
$sorgu -> execute();
$yazarlar = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);


?>
<!-- Basic Card Example -->
<div class="container-fluid">
	<!-- data table -->
    <div class="card shadow mb-4 col-xl-12 px-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            	Yazar Bilgileri
            </h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">
                
                <?php 

                // yazar ekleme işlemi başarılı ise başarılı alert ekle

                $alert = <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>İşlem Yapıldı!</strong> Ekleme İşlemi Başarılı.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                HTML;
                
                if(@$_GET['yazar-ek-is'] && $_GET['yazar-ek-is']=='true'){
                  //get ten gelen yazar-ek varsa ve bu true ise
                  echo $alert;
                  //3 saniye sonra alert ü sil
                  //bunu index.php?sayfa=yazar-select
                  $url ="index.php?sayfa=yazar-select"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }

                ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-active">
                      <th>Yazar İsim Soyisim</th>                    
                    </tr>
                  </thead>
                  <tfoot>
                     <tr class="table-active">
                      <th>Yazar İsim Soyisim</th>                    
                    </tr>
                  </tfoot>
                  <tbody>                    
                    
                    <?php foreach ($yazarlar as $yazar): ?>
                    <tr>
                      <td><?php echo $yazar['yazaradsoyad']; ?></td>                                                      
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