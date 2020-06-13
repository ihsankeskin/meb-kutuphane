<?php 


?>

<!-- Begin Page Content -->
<div class="container-fluid">

	 <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kütüphane İstatistikleri</h1>
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
                                $kit = $sorgu->fetchColumn();
                                echo $kit;

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
                                        $odu = $sorgu->fetchColumn();
                                        $sonuc=($odu * 100) / $kit;
                                        echo $odu;
                                        ?>


                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $sonuc; ?>% " aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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

    <div class="row">

        <div class="col-xl-12 col-xl-8">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kütüphanedeki Kitap Sayısı Zamansal Gösterimi</h6>
                </div>
                <div class="card-body">
                    <div id="kitap_adet" style="width: 100%px; height: 100%px;"></div>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yazar Dağılımı</h6>
                </div>
                <div class="card-body">
                    <div id="yazar_adet" style="width: 100%px; height: 100%px;"></div>
                </div>
            </div>
            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kategori Dağılımı</h6>
                </div>
                <div class="card-body">
                    <div id="kategori_adet" style="width: 100%px; height: 100%px;"></div>
                </div>
            </div>
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sisteme Kayıtlı Kullanıcı Sayısı </h6>
                </div>
                <div class="card-body">
                    <div id="kullanici_adet" style="width: 100%px; height: 100%px;"></div>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kullanoı Aktivitesi (Ödünç Alma Durumu) </h6>
                </div>
                <div class="card-body">
                    <div id="odunc_durum" style="width: 100%px; height: 100%px;"></div>
                </div>
            </div>



        </div>
        <script>
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Aylar', 'Birim Sayısı'],
                    ['Ocak', 100],
                    ['Şubat', 180],
                    ['Mart', 200],
                    ['Nisan', 230],
                    ['Mayıs', 380],
                    ['Haziran', 400],
                    ['Temmuz', 500],
                    ['Agustos', 540],
                    ['Eylül', 630],
                    ['Ekiml', 780],
                    ['Kasıml', 1000],
                    ['Aralıkl', 1400]
                ]);

                var options = {
                    chart: {
                    },
                    bars: 'vertical',
                    vAxis: {format: 'short'},
                    height: 400,
                    colors: ['#16649e', '#d95f02', '#7570b3']
                };

                var chart = new google.charts.Bar(document.getElementById('kitap_adet'));

                chart.draw(data, google.charts.Bar.convertOptions(options));



            }

            {
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Aylar', 'Birim Sayısı'],
                        ['Ocak', 100],
                        ['Şubat', 180],
                        ['Mart', 200],
                        ['Nisan', 230],
                        ['Mayıs', 380],
                        ['Haziran', 400],
                        ['Temmuz', 500],
                        ['Agustos', 540],
                        ['Eylül', 630],
                        ['Ekiml', 780],
                        ['Kasıml', 1000],
                        ['Aralıkl', 1400]
                    ]);

                    var options = {
                        chart: {
                        },
                        bars: 'vertical',
                        vAxis: {format: 'short'},
                        height: 400,
                        colors: ['#81409e', '#d95f02', '#7570b3']
                    };

                    var chart = new google.charts.Bar(document.getElementById('yazar_adet'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));



                }
            }
            {
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Aylar', 'Birim Sayısı'],
                        ['Ocak', 100],
                        ['Şubat', 180],
                        ['Mart', 200],
                        ['Nisan', 230],
                        ['Mayıs', 380],
                        ['Haziran', 400],
                        ['Temmuz', 500],
                        ['Agustos', 540],
                        ['Eylül', 630],
                        ['Ekiml', 780],
                        ['Kasıml', 1000],
                        ['Aralıkl', 1400]
                    ]);

                    var options = {
                        chart: {
                        },
                        bars: 'vertical',
                        vAxis: {format: 'short'},
                        height: 400,
                        colors: ['#9e451a', '#d95f02', '#7570b3']
                    };

                    var chart = new google.charts.Bar(document.getElementById('kategori_adet'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));



                }
            }
            {
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Aylar', 'Birim Sayısı'],
                        ['Ocak', 100],
                        ['Şubat', 180],
                        ['Mart', 200],
                        ['Nisan', 230],
                        ['Mayıs', 380],
                        ['Haziran', 400],
                        ['Temmuz', 500],
                        ['Agustos', 540],
                        ['Eylül', 630],
                        ['Ekiml', 780],
                        ['Kasıml', 1000],
                        ['Aralıkl', 1400]
                    ]);

                    var options = {
                        chart: {
                        },
                        bars: 'vertical',
                        vAxis: {format: 'short'},
                        height: 400,
                        colors: ['#15529e', '#d95f02', '#7570b3']
                    };

                    var chart = new google.charts.Bar(document.getElementById('kullanici_adet'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));



                }
            }
            {
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Aylar', 'Birim Sayısı'],
                        ['Ocak', 100],
                        ['Şubat', 180],
                        ['Mart', 200],
                        ['Nisan', 230],
                        ['Mayıs', 380],
                        ['Haziran', 400],
                        ['Temmuz', 500],
                        ['Agustos', 540],
                        ['Eylül', 630],
                        ['Ekiml', 780],
                        ['Kasıml', 1000],
                        ['Aralıkl', 1400]
                    ]);

                    var options = {
                        chart: {
                        },
                        bars: 'vertical',
                        vAxis: {format: 'short'},
                        height: 400,
                        colors: ['#209e02', '#d95f02', '#7570b3']
                    };

                    var chart = new google.charts.Bar(document.getElementById('odunc_durum'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));



                }
            }



        </script>


    </div>

</div>
        <!-- /.container-fluid -->
          <!-- Page level plugins -->

