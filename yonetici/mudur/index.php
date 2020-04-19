<?php 

session_start();
ob_start();
include_once '../../baglan.php';

if(!$_SESSION['kullanici_adi']){
	#oturum açılmamış ise
	header('Location:../index.php');
	#oturum açılmadan şöyle bir sayfaya gidilmeye çalışılırsa
	#/proje/yonetici/root/
	#kötü amaçlı kişiyi def etmek amacıyla yazılmış kod bloğu
	#BÖCÜ
}

if($_SESSION['kullanici_adi']){
	# oturum açılmışsa
	include_once '../lib/header.php';
}

?>


<?php  
	if (!isset($_GET['sayfa'])){
		$_GET['sayfa'] = 'index';
	}

	switch ($_GET['sayfa']) {

		case 'index':
			require_once 'sayfalar/ogretmen-cek.php';
		break;

		case 'ogr_select':
			require_once 'sayfalar/ogretmen-cek.php';
		break;

		case 'ogr_insert':
			require_once 'sayfalar/ogretmen-ekle.php';
			break;

		case 'ogr_update':
			require_once 'sayfalar/ogretmen-guncelle.php';
			break;

		case 'tek-ogr-guncelle':
			require_once 'sayfalar/tek-ogr-guncelle.php';
			break;

		case 'tek-ogr-sil':
			require_once 'sayfalar/tek-ogr-sil.php';
			break;

		case 'yazar-select':
			require_once 'sayfalar/yazar-cek.php';
			#yazar görüntüleme sayfası
		break;

		case 'yazar-insert':
			require_once 'sayfalar/yazar-ekle.php';
			#yazar ekleme sayfası
		break;

		case 'yazar-update':
			require_once 'sayfalar/yazar-guncelle.php';
			#yazar güncelleme sayfası
		break;

		case 'tek-yazar-guncelle':
			require_once 'sayfalar/tek-yazar-guncelle.php';
			#yazar güncelleme sayfası
		break;

		case 'tek-yazar-sil':
			require_once 'sayfalar/tek-yazar-sil.php';
			#yazar güncelleme sayfası
		break;

		case 'kategori-select':
			require_once 'sayfalar/kategori-cek.php';
			#kategori bilgilerini çekme sayfası
		break;

		case 'kategori-insert':
			require_once 'sayfalar/kategori-ekle.php';
			#kategori ekleme sayfası
		break;

		case 'kategori-update':
			require_once 'sayfalar/kategori-guncelle.php';
			#kategori güncelleme sayfası
		break;

		case 'tek-kategori-guncelle':
			require_once 'sayfalar/tek-kategori-guncelle.php';
			#tekli olarak kategoriyi güncelleme sayfası
		break;

		case 'tek-kategori-sil':
			require_once 'sayfalar/tek-kategori-sil.php';
			#kategori güncelleme sayfası
		break;

		default:
			# code...
			break;
	}

?>

<!-- Begin Page Content -->
        <!-- 
        <div class="container-fluid">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas odio, nulla delectus deserunt impedit officiis quasi eum laborum expedita fuga enim repudiandae totam, aliquid natus. Itaque fuga, consequatur dolorem sunt!
          </p>
        </div>
         -->
        
      </div>
      <!-- End of Main Content -->





<?php 
if($_SESSION['kullanici_adi']){
	# oturum açılmışsa
	include_once '../lib/footer.php';
}
?>