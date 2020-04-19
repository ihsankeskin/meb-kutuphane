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
            	Birim Bilgileri
            </h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php 

                // birim ekleme işlemi başarılı ise başarılı alert ekle

                $alert = <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>İşlem Yapıldı!</strong> Ekleme İşlemi Başarılı.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                HTML;

                if(@$_GET['ekleme_is'] && $_GET['ekleme_is']=='true'){
                  //get ten gelen ekleme_is varsa ve bu true ise
                  echo $alert;
                }


                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="table-active">
                      <th>Birim Adı</th>
                      <th>Adres</th>
                      <th>İletişim</th>                      
                    </tr>
                  </thead>
                  <tfoot>
                     <tr class="table-active">
                      <th>Birim Adı</th>
                      <th>Adres</th>
                      <th>İletişim</th>                    
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach ($birimler as $birim): ?>
                    <tr>
                      <td><?php echo $birim['birimadi']; ?></td>
                      <td><?php echo $birim['adres']; ?></td>
                      <td><?php echo $birim['iletisim']; ?></td>
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