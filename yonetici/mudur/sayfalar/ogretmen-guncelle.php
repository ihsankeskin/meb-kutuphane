<?php 

  $sorgu = $db -> prepare('SELECT 
    yoneticiler.id as yoneticiID,
    yoneticiler.ad,
    yoneticiler.soyad,
    yoneticiler.tcno,
    yoneticiler.username,
    yoneticiler.sifre,
    yoneticiler.telefon,
    yoneticiler.eposta, 
    yoneticiler.birim_id,
    yoneticiler.yetki,
    birimler.id as birimID, 
    birimler.birimadi 
    FROM yoneticiler INNER JOIN birimler 
    ON yoneticiler.birim_id = birimler.id WHERE yoneticiler.yetki = 3
    ');

  $sorgu -> execute();

  $mudurler = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);


?>  
<!-- Basic Card Example -->
<div class="container-fluid">
  <!-- data table -->
    <div class="card shadow mb-4 col-xl-12 px-0">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
              Öğretmen Bilgileri Düzenleme
            </h6>
        </div>
            <div class="card-body">

              <?php 

                // öğretmen silme işlemi başarılı ise başarılı alert ekle

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
                  $url ="index.php?sayfa=ogr_update"; 
                  $time_out = 3;
                  header("refresh: $time_out; url=$url");
                }
                
                ?>

              <div class="table-responsive">              

                <?php 

                // öğretmen güncelleme işlemi başarılı ise başarılı alert ekle

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
                  $url ="index.php?sayfa=ogr_update"; 
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
                      <th>E-posta</th>
                      <th>Birimi</th>
                      <th>İşlemler</th>
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
                      <th>E-posta</th>
                      <th>Birimi</th>
                      <th>İşlemler</th>
                    </tr>
                  </tfoot>
                  <tbody>                    
                    
                    <?php foreach ($mudurler as $mudur): ?>
                    <tr>
                      <td><?php $adsifrem= $mudur['ad']; echo $sifre_cozuldu = openssl_decrypt($adsifrem,$encrypt_method, $key, false, $iv); ?></td>
                      <td><?php $adsifrem= $mudur['soyad']; echo $sifre_cozuldu = openssl_decrypt($adsifrem,$encrypt_method, $key, false, $iv); ?></td>
                      <td><?php echo $mudur['tcno']; ?></td>
                      <td><?php $adsifrem= $mudur['username']; echo $sifre_cozuldu = openssl_decrypt($adsifrem,$encrypt_method, $key, false, $iv); ?></td>
                      <td title="<?php echo $mudur['sifre']; ?>">
                        <details>
                          <summary></summary>
                          <?php $adsifrem= $mudur['sifre']; echo $sifre_cozuldu = openssl_decrypt($adsifrem,$encrypt_method, $key, false, $iv); ?>
                        </details>
                      </td>
                      <td><?php echo $mudur['telefon']; ?></td>
                      <td><?php $adsifrem= $mudur['eposta']; echo $sifre_cozuldu = openssl_decrypt($adsifrem,$encrypt_method, $key, false, $iv); ?></td>
                      <td><?php echo $mudur['birimadi']; ?></td>  
                      <td>
                        <a href="index.php?sayfa=tek-ogr-guncelle&id=<?php echo $mudur['yoneticiID']; ?>">
                          <button type="button" class="btn btn-warning">
                            Güncelle
                          </button>
                        </a> 
                        <a href="index.php?sayfa=tek-ogr-sil&id=<?php echo $mudur['yoneticiID']; ?>">
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