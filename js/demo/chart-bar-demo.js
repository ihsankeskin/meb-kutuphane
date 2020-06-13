{
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Aylar', 'Kullanıcı Sayısı'],
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
    colors: ['#3e9e09', '#d95f02', '#7570b3']
  };

  var chart = new google.charts.Bar(document.getElementById('kayitli_kullanici'));

  chart.draw(data, google.charts.Bar.convertOptions(options));



}
}
{
  google.charts.load('current', {'packages': ['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Aylar', 'Kullanıcı Aktivitesi'],
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
      chart: {},
      bars: 'vertical',
      vAxis: {format: 'short'},
      height: 400,
      colors: ['#d95f02', '#d95f02', '#7570b3']
    };

    var chart = new google.charts.Bar(document.getElementById('kullanici_aktivite'));

    chart.draw(data, google.charts.Bar.convertOptions(options));

  }
}