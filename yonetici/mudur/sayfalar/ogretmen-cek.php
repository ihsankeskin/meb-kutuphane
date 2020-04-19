<?php 

$sorgu = $db -> prepare('SELECT * FROM yoneticiler WHERE yetki = ? AND birim_id = ? ');
$sorgu -> execute([
  '3', 
  $_SESSION['birim_id']
]);
$ogretmenler = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);

?>
<!-- Basic Card Example -->
<div class="container-fluid">
	<!-- data table -->
    <div class="card shadow mb-4 col-xl-12 px-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            	Öğretmen Bilgileri
            </h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">

              <?php 

                // öğretmen ekleme işlemi başarılı ise başarılı alert ekle

                $alert = <<<HTML
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>İşlem Yapıldı!</strong> Ekleme İşlemi Başarılı.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <hr>
                HTML;
                
                if(@$_GET['ogr-ek-is'] && $_GET['ogr-ek-is']=='true'){
                  //get ten gelen ogr-ekleme_is varsa ve bu true ise
                  echo $alert;
                  //3 saniye sonra alert ü sil
                  //bunu index.php?sayfa=b_update
                  $url ="index.php?sayfa=ogr_select"; 
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
                      <th>Kullanıcı Adı</th>
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
                      <th>Kullanıcı Adı</th>
                      <th>Şifre</th>
                      <th>Telefon</th>
                      <th>Eposta</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    <?php foreach($ogretmenler as $ogretmen): ?>

                    <tr>
                      <td> <?php echo $ogretmen['ad'];        ?> </td>
                      <td> <?php echo $ogretmen['soyad'];     ?> </td>
                      <td> <?php echo $ogretmen['tcno'];      ?> </td>
                      <td> <?php echo $ogretmen['username'];  ?> </td>
                      <td>
                        <details>
                          <summary></summary>
                          <?php echo $ogretmen['sifre']; ?> 
                        </details>
                      </td>
                      <td> <?php echo $ogretmen['telefon'];   ?> </td>
                      <td> <?php echo $ogretmen['eposta'];    ?> </td>
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