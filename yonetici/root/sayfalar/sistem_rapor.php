<?php 


?>

<!-- Begin Page Content -->
<div class="container-fluid">

	 <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sistem İstatistikleri</h1>
          </div>

          <div class="row">

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sistem Yükü</div>
                                  <div class="row no-gutters align-items-center">
                                      <div class="col-auto">
                                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                      </div>
                                      <div class="col">
                                          <div class="progress progress-sm mr-2">
                                              <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-auto">
                                  <i class="fas fa-cogs fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-danger shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">İşlemci Kullanımı</div>
                                  <div class="row no-gutters align-items-center">
                                      <div class="col-auto">
                                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                      </div>
                                      <div class="col">
                                          <div class="progress progress-sm mr-2">
                                              <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-auto">
                                  <i class="fas fa-rocket fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ram Kullanımı</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-microchip fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-success shadow h-100 py-2">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Disk Kullanımı</div>
                                  <div class="row no-gutters align-items-center">
                                      <div class="col-auto">
                                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                      </div>
                                      <div class="col">
                                          <div class="progress progress-sm mr-2">
                                              <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-auto">
                                  <i class="fas fa-hdd fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

          </div>


          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Detaylı İstatistik Görünümü</h1>
          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-12 col-lg-7">

              <!-- Area Chart -->
              <div class="card shadow mb-xl-5 ">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Çapraz İstatistik</h6>
                </div>
                <div class="card-body">
                    <div id="sistem" style="width: 100%px; height: 100%px;"></div>
                </div>
              </div>

            </div>

              <script>
                  google.charts.load('current', {'packages':['line']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                      var data = new google.visualization.DataTable();
                      data.addColumn('number', 'Satlik');
                      data.addColumn('number', 'Sistem Yükü');
                      data.addColumn('number', 'İşlemci Kullanımı');
                      data.addColumn('number', 'Ram Kullanımı');
                      data.addColumn('number', 'Disk Kullanımı');
                      data.addColumn('number', 'Uptime');

                      data.addRows([
                          [1,  37.8, 80.8, 41.8, 41.8, 41.8],
                          [2,  30.9, 69.5, 32.4, 41.8, 41.8],
                          [3,  25.4,   57, 25.7, 41.8, 41.8],
                          [4,  11.7, 18.8, 10.5, 41.8, 41.8],
                          [5,  11.9, 17.6, 10.4, 41.8, 41.8],
                          [6,   8.8, 13.6,  7.7, 41.8, 41.8],
                          [7,   7.6, 12.3,  9.6, 41.8, 41.8],
                          [8,  12.3, 29.2, 10.6, 41.8, 41.8],
                          [9,  16.9, 42.9, 14.8, 41.8, 41.8],
                          [10, 12.8, 30.9, 11.6, 41.8, 41.8],
                          [11,  5.3,  7.9,  4.7, 41.8, 41.8],
                          [12,  6.6,  8.4,  5.2, 41.8, 41.8],
                          [13,  4.8,  6.3,  3.6, 41.8, 41.8],
                          [14,  4.2,  6.2,  3.4, 41.8, 41.8]
                      ]);

                      var options = {
                          chart: {
                          },
                          height: 600
                      };

                      var chart = new google.charts.Line(document.getElementById('sistem'));

                      chart.draw(data, google.charts.Line.convertOptions(options));
                  }
              </script>

          </div>

</div>

        <!-- /.container-fluid -->
          <!-- Page level plugins -->

