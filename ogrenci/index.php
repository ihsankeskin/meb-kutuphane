<?php 
	session_start();
	ob_start();
	include_once '../baglan.php';	
 ?>

<?php 

	if(isset($_SESSION['kullanici_adi'])){
		//oturum açılmış ise
		include_once 'lib/header.php';

	}else{
		//oturum açılmamış ise
		header('Location:login.php');
	}

?>

<?php  
	if (!isset($_GET['sayfa'])){
		$_GET['sayfa'] = 'index';
	}

	switch ($_GET['sayfa']) {

		case 'index':
			require_once 'sayfalar/kitaplar-cek.php';
			#hiç bir sayfa get ile gelmemişse direk kitap bilgilerini çek
		break;

		case 'kitaplar-cek':
			require_once 'sayfalar/kitaplar-cek.php';
		break;

		case 'odunc':
			require_once 'sayfalar/odunc.php';
		break;

		case 'profil':
			require_once 'sayfalar/profil.php';
		break;
		
		case 'ayarlar':
			require_once 'sayfalar/ayarlar.php';
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
	include_once 'lib/footer.php';
}
?>
