<?php
	function postCaptcha($response){
		$fieldsArray = array(
			'secret' 		=> '6LdhlPEUAAAAAB_PJ7KmrbjwutVwQ0ZfaOTZON_q',
			'response' 		=> $response
		);
		$postFields = http_build_query($fieldsArray);
		$ch = 		curl_init();
					curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
					curl_setopt($ch, CURLOPT_POST, count($fieldsArray));
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = 	curl_exec($ch);
					curl_close($ch);
		return json_decode($result,true);
	}
	if($_POST):
		$result = postCaptcha($_POST['g-recaptcha-response']);
		if ($result['success']):
			$resultMessage = 'Doğrulama tamamlandı.';
		else:
			$resultMessage = 'Bir hata oluştu.<br>';
			$resultMessage .= 'Hata Kodu: '.$result['error-codes'][0];
		endif;
	endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>reCAPTCHA</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.4/dist/css/uikit.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.4/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.4/dist/js/uikit-icons.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
    <?php if($_POST): ?>
    	<section class="uk-flex uk-flex-middle" uk-height-viewport>
	    	<div class="uk-container">
	    		<div class="uk-grid">
	    			<div class="uk-card uk-card-default uk-card-body uk-width-large">
		    			<div class="uk-alert uk-alert-primary uk-text-center">
		    				<span uk-icon="icon: info; ratio: 2"></span>
		    				<p><?=$resultMessage?></p>
		    			</div>
					</div>
	    		</div>
	    	</div>
    	</section>
    <?php else: ?>
    	<section class="uk-flex uk-flex-middle" uk-height-viewport>
	    	<div class="uk-container">
	    		<div class="uk-grid">
	    			<div class="uk-card uk-card-default uk-card-body uk-width-large">
	    				<h3 class="uk-card-title">Giriş Formu</h3>
		    			<form method="post">
						    <fieldset class="uk-fieldset">
						        <div class="uk-margin">
							        <div class="uk-inline uk-width-expand">
							            <span class="uk-form-icon" uk-icon="icon: mail"></span>
							            <input type="text" class="uk-input uk-form-large" name="email" placeholder="E-Posta" required />
							        </div>
							    </div>
							    <div class="uk-margin">
							        <div class="uk-inline uk-width-expand">
							            <span class="uk-form-icon" uk-icon="icon: lock"></span>
							            <input type="password" class="uk-input uk-form-large" name="password" placeholder="Şifre" required />
							        </div>
							    </div>
							    <div class="uk-margin uk-flex uk-flex-center">
							    	<div class="g-recaptcha" data-sitekey="6LdhlPEUAAAAACBxL_UgLTG06rPGMbitgQyhBR2N"></div>
							    </div>
							    <div class="uk-margin">
							        <button type="submit" class="uk-button uk-button-primary uk-width-expand uk-button-large">GİRİŞ</button>
							    </div>
						    </fieldset>
						</form>
					</div>
	    		</div>
	    	</div>
    	</section>
    <?php endif; ?>
    </body>
</html>