<?php 



?>

<!-- Begin Page Content -->
<div class="container-fluid">

	 <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">İstatistikler</h1>
          </div>

          <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kitap Sayısı</div>
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

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kullanıcı Sayısı</div>
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
                      <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ödünç Verilmiş Kitap Sayısı</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                      <?php 

                        $sorgu = $db->prepare("SELECT COUNT(*) FROM odunc");
                        $sorgu->execute();
                        $say = $sorgu->fetchColumn();
                        echo $say;

                        ?>
                          
                        </div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ögretmen Sayısıs</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php 

                        $sorgu = $db->prepare("SELECT COUNT(*) FROM yoneticiler");
                        $sorgu->execute();
                        $say = $sorgu->fetchColumn();
                        echo $say;

                        ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Content Row -->
          <div class="row">

            <div  class="col-xl-12 col-lg-7">

              <!-- Area Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Sisteme Kayıtlı Kullanıcı Sayısı </h6>
                </div>
                <div id="rapor" class="card-body">
                    <div id="kayitli_kullanici" style="width: 100%px; height: 100%px;"></div>
                </div>
              </div>

              <!-- Bar Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Kullanıcı Aktivitesi (Ödünç Alma Durumu) </h6>
                </div>
                <div class="card-body">
                    <div id="kullanici_aktivite" style="width: 100%px; height: 100%px;"></div>
                </div>
              </div>

              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                      <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                          <a class="navbar-collapse text-primary font-weight-bold ">Kullanıcıların Ödünç Kitap Alma Durumu </a>
                          <ul class="navbar-nav ml-auto">
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle text-danger font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Filtreleme
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right animated--grow-in" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item text-info font-weight-bold" href="#">Yıllık</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item text-success font-weight-bold" href="#">6 Aylık</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item text-primary font-weight-bold" href="#">Aylık</a>
                                  </div>
                              </li>
                          </ul>
                      </nav>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                              <tr>
                                  <th>İsim</th>
                                  <th>Soyisim</th>
                                  <th>Ögrenci Numarası</th>
                                  <th>Ödünç Aldıgı Kitap Sayısı</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td>Tiger Nixon</td>
                                  <td>System Architect</td>
                                  <td>Edinburgh</td>
                                  <td>61</td>
                              </tr>
                              <tr>
                                  <td>Garrett Winters</td>
                                  <td>Accountant</td>
                                  <td>Tokyo</td>
                                  <td>63</td>
                              </tr>
                              <tr>
                                  <td>Ashton Cox</td>
                                  <td>Junior Technical Author</td>
                                  <td>San Francisco</td>
                                  <td>66</td>
                              </tr>
                              <tr>
                                  <td>Cedric Kelly</td>
                                  <td>Senior Javascript Developer</td>
                                  <td>Edinburgh</td>
                                  <td>22</td>
                              </tr>
                              <tr>
                                  <td>Michael Bruce</td>
                                  <td>Javascript Developer</td>
                                  <td>Singapore</td>
                                  <td>29</td>
                              </tr>
                              <tr>
                                  <td>Donna Snider</td>
                                  <td>Customer Support</td>
                                  <td>New York</td>
                                  <td>27</td>
                              </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>


          </div>
</div>
        <!-- /.container-fluid -->
          <!-- Page level plugins -->

