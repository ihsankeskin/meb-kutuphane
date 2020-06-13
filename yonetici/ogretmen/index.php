<?php 

session_start();
ob_start();
include_once '../../baglan.php';

if(!$_SESSION['kullanici_adi']){
	#oturum açılmamış ise
	header('Location:../403.php');
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
			require_once 'sayfalar/ogrenci-cek.php';
		break;

		case 'ogrenci-select':
			require_once 'sayfalar/ogrenci-cek.php';
		break;

		case 'ogrenci-insert':
			require_once 'sayfalar/ogrenci-ekle.php';
			break;

		case 'ogrenci-update':
			require_once 'sayfalar/ogrenci-guncelle.php';
			break;

		case 'tek-ogrenci-guncelle':
			require_once 'sayfalar/tek-ogrenci-guncelle.php';
			break;

		case 'tek-ogrenci-sil':
			require_once 'sayfalar/tek-ogrenci-sil.php';
			break;	

		case 'kitap-select':
			require_once 'sayfalar/kitap-cek.php';
			break;

		case 'kitap-insert':
			require_once 'sayfalar/kitap-ekle.php';
			break;

		case 'kitap-update':
			require_once 'sayfalar/kitap-guncelle.php';
			break;

		case 'tek-kitap-sil':
			require_once 'sayfalar/tek-kitap-sil.php';
			break;

		case 'tek-kitap-guncelle':
			require_once 'sayfalar/tek-kitap-guncelle.php';
			break;

		case 'kitap-onaylanmis':
			require_once 'sayfalar/onaylanmis-kitaplar.php';
			break;

		case 'kitap-onay-bekleyen':
			require_once 'sayfalar/onay-bekleyen-kitaplar.php';
			break;

		case 'kitap-iade-bekleyenler':
			require_once 'sayfalar/iade-bekleyen-kitaplar.php';
			break;

		case 'tek-kitap-goruntule':
			require_once 'sayfalar/tek-kitap-goruntule.php';
			break;
		case 'profil':
			require_once 'sayfalar/profil.php';
			break;

        case 'tek-ogrenci-goruntule':
            require_once 'sayfalar/tek-ogr-goruntule.php';
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