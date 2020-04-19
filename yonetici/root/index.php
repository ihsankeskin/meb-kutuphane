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
			if(!($_SESSION['yetki'] == 1)){
				header('Location: ../index.php');
			}
			require_once 'sayfalar/mudur-cek.php';
			#hiç bir sayfa get ile gelmemişse direk müdür bilgilerini çek
		break;

		case 'm_select':
			require_once 'sayfalar/mudur-cek.php';
			#müdür bilgileri istenirse bilgileri çek
		break;

		case 'm_insert':
			require_once 'sayfalar/mudur-ekle.php';
			#müdür ekleme sayfası
		break;

		case 'm_update':
			require_once 'sayfalar/mudur-guncelle.php';
			#müdür güncelleme
			break;

		case 'tek-mudur-guncelle':
			require_once 'sayfalar/tek-mudur-guncelle.php';
			#güncelleme için müdür verilerini çekme sayfası
		break;

		case 'tek-mudur-sil':
			require_once 'sayfalar/tek-mudur-sil.php';
			#müdür silme sayfası
		break;

		case 'b_select':
			require_once 'sayfalar/birim-cek.php';
			#birim bilgilerini göster
		break;

		case 'b_insert':
			require_once 'sayfalar/birim-ekle.php';
			#birim ekleme sayfası
		break;

		case 'b_update':
			require_once 'sayfalar/birim-guncelle.php';
			#güncelleme için birim verilerini çekme sayfası
		break;

		case 'tek-birim-guncelle':
			require_once 'sayfalar/tek-birim-guncelle.php';
			#güncelleme için birim verilerini çekme sayfası
		break;

		case 'tek-birim-sil':
			require_once 'sayfalar/tek-birim-sil.php';
			#birim silme sayfası
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