<?php 
	session_start();
	ob_start();
	include_once '../baglan.php';	
 ?>

<?php 

	if(isset($_SESSION['kullanici_adi'])){
		//oturum açılmış ise
		
		if ($_SESSION['yetki'] == '1') {
			//root kullanici
			header('Location:root/');
		}elseif($_SESSION['yetki'] == '2'){
			//mudur kullanici
			header('Location:mudur/');
		}elseif($_SESSION['yetki'] == '3'){
			//ogretmen kullanici
			header('Location:ogretmen/');
		}

	}else{
		//oturum açılmamış ise
		include_once 'login.php';
	}

?>
