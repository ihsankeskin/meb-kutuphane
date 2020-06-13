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
                      <th>Ögrenci No</th>
                      <th>Şifre</th>
                      <th>Telefon</th>
                      <th>Eposta</th>
                      <th>Ödünç Geçmişi</th>
                    </tr>
                  </thead>
                  <tfoot>
                     <tr class="table-active">
                      <th>İsim</th>
                      <th>Soyisim</th>
                      <th>Ögrenci No</th>
                      <th>Şifre</th>
                      <th>Telefon</th>
                      <th>Eposta</th>
                      <th>Ödünç Geçmişi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($ogrenciler as $ogrenci): ?>
                    <tr>
                      <td> <?php $sifrem= $ogrenci['ad']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?> </td>
                      <td> <?php $sifrem= $ogrenci['soyad']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?> </td>
                      <td> <?php echo $ogrenci['tcno'];     ?> </td>
                      <td>
                        <details>
                          <summary></summary>
                          <?php $sifrem= $ogrenci['sifre']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?>
                        </details>
                      </td>
                      <td> <?php echo $ogrenci['telefon'];	?> </td>
                      <td> <?php $sifrem= $ogrenci['eposta']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?></td>
                     <td>
                       <a href="index.php?sayfa=tek-ogrenci-goruntule&k_id=<?= $ogrenci['id']; ?>">
                          <button type="button" class="btn btn-primary">
                            Görüntüle
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

