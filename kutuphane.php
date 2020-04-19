<?php 

require_once 'baglan.php';

?>

<?php

$sorgu = $db -> prepare(' SELECT * FROM baglantili_kitaplar ');
$sorgu -> execute();
$kitaplar = $sorgu -> fetchAll(PDO :: FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Kütüphane Otomasyonu</title>
  
  <link rel="shortcut icon" type="image/png" href="favicon.ico"/>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <div class="container">                 
            <a class="navbar-brand" href="#">
            <img src="img/logo.png" class="d-inline-block align-top" width="210" height="110" alt="">
            
          </a>
          <!-- Topbar Search 
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-danger" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
          -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
             
            
            <!-- Nav Item - Search Dropdown (Visible Only XS) 
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              -->
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li> 

            

            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Giriş Yap</span>
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">                                        
                <a class="dropdown-item" href="ogrenci/">
                  <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-500"></i>
                  Öğrenci Girişi
                </a>
              </div>
            </li>

          </ul>
        </div>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kütüphane Otomasyonu Hakkında Bilgi</h1>        
          </div>

          <p>
            Kütüphane Otomasyonu Dumlupınar Üniversitesi Tavşanlı Meslek Yüksek Okulu ögrencileri tarafından 2018 yılında projelendirilmiş 2019 yılında yapılmaya başlanmış 2020 yılında güvenlik testlerinin bitmesi ile kullanıma sunulmuştur php yazılım dilind kodlanmış mysql veri tabanı kullanmaktadır açık kaynak kodludur CC BY NC ile lisanslanmıştır .
          </p>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Kitaplar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        
                        <?php 

                        $sorgu = $db->prepare("SELECT COUNT(*) FROM baglantili_kitaplar");
                        $sorgu->execute();
                        $say = $sorgu->fetchColumn();
                        echo $say;

                        ?>
        
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kayıtlı Öğrenci</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        
                        <?php 

                        $sorgu = $db->prepare("SELECT COUNT(*) FROM ogrenciler");
                        $sorgu->execute();
                        $say = $sorgu->fetchColumn();
                        echo $say;

                        ?>

                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ödünç Verilen Kitaplar</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                          
                          <?php 

                          $sorgu = $db->prepare(" SELECT COUNT(*) FROM kitaplar WHERE odunc_durum = ? ");
                          $sorgu->execute(['1']);
                          $say = $sorgu->fetchColumn();
                          echo $say;

                          ?>

                          </div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
            
            <!-- data table -->
            <div class="card shadow mb-4 col-xl-12 px-0">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Kitaplar</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive table-hover">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kitap Adı</th>
                      <th>Yayın Evi</th>
                      <th>Kategori</th>
                      <th>Basım Yılı</th>
                      <th>Yazar</th>                  
                    </tr>
                  </thead>
                  <tfoot>
                     <tr>
                      <th>Kitap Adı</th>
                      <th>Yayın Evi</th>
                      <th>Kategori</th>
                      <th>Basım Yılı</th>
                      <th>Yazar</th> 
                    </tr>
                  </tfoot>
                  <tbody>


                    <?php foreach ($kitaplar as $kitap): ?>
                    
                      <tr>
                        <td><?= $kitap['kitap_ad'];         ?></td>
                        <td><?= $kitap['kitap_yayin_evi'];  ?></td>
                        <td><?= $kitap['kategori_isim'];    ?></td>
                        <td><?= $kitap['kitap_yil'];        ?></td>
                        <td><?= $kitap['yazar_ad_soyad'];   ?></td>
                      </tr>

                    <?php endforeach; ?>
                    
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
            <!-- /data table -->

          </div>

          <!-- Content Row -->

          

         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons License" style="border-width:0; padding-bottom: 10px;"  src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png"  /></a><br />Aksi belirtilmedikçe , bu sitedeki içerik <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/">Creative Commons Atıf-Ticari Olmayan 4.0 Uluslararası Lisansı ile lisanslanmıştır.</a> &copy; Kütüphane Otomasyonu 2018-2020</a>
       </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
  -->
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
