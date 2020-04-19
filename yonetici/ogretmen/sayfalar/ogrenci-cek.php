<?php 

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
            	Öğrenci Bilgileri 
            </h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">

              <?php 

                // öğrenci ekleme işlemi başarılı ise başarılı alert ekle

                $alert = <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>İşlem Yapıldı!</strong> Ekleme İşlemi Başarılı.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                HTML;
                
                if(@$_GET['ogrenci-ek-is'] && $_GET['ogrenci-ek-is']=='true'){
                  //get ten gelen ogrenci-ekleme_is varsa ve bu true ise
                  echo $alert;
                  //3 saniye sonra alert ü sil                  
                  $url ="index.php?sayfa=ogrenci-select"; 
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
                      <th>Eposta</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr class="table-active">
                      <th>İsim</th>
                      <th>Soyisim</th>
                      <th>Tc No</th>                      
                      <th>Şifre</th>
                      <th>Telefon</th>
                      <th>Eposta</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    <?php foreach($ogrenciler as $ogrenci): ?>

                    <tr>
                      <td> <?php echo $ogrenci['ad'];       ?> </td>
                      <td> <?php echo $ogrenci['soyad'];    ?> </td>
                      <td> <?php echo $ogrenci['tcno'];     ?> </td>
                      <td> 
                        <details>
                          <summary></summary>
                          <?php echo $ogrenci['sifre'];       ?>
                        </details>
                      </td>
                      <td> <?php echo $ogrenci['telefon'];	?> </td>
                      <td> <?php echo $ogrenci['eposta'];   ?> </td>                      
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