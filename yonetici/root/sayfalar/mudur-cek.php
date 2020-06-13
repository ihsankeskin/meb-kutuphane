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
    ON yoneticiler.birim_id = birimler.id WHERE yoneticiler.yetki = 2
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
            	Birim Sorumluları Bilgileri
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
                
                if(@$_GET['mudur-ek-is'] && $_GET['mudur-ek-is']=='true'){
                  //get ten gelen ekleme_is varsa ve bu true ise
                  echo $alert;
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
                    </tr>
                  </tfoot>
                  <tbody>                    
                    
                    <?php foreach ($mudurler as $mudur): ?>
                    <tr>

                      <td><?php $sifrem= $mudur['ad']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?></td>
                      <td><?php $sifrem= $mudur['soyad']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?></td>
                      <td><?php echo $mudur['tcno']; ?></td>
                      <td><?php $sifrem= $mudur['username']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?></td>
                      <td title="<?php echo $mudur['sifre']; ?>">
                        <details>
                          <summary></summary>
                          <?php $sifrem= $mudur['sifre']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?>
                        </details>
                      </td>
                      <td><?php echo $mudur['telefon']; ?></td>
                      <td><?php $sifrem= $mudur['eposta']; echo $sifre_cozuldu = openssl_decrypt($sifrem,$encrypt_method, $key, false, $iv); ?></td>
                      <td><?php echo $mudur['birimadi']; ?></td>                                    
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