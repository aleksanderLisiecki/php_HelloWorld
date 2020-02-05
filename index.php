<?php
/*
#hashowanie hasla:
$haslo = "alex1"
var_dump(password_hash($haslo, PASSWORD_DEFAULT));
exit();

*/
	function clog( $data ){
		 echo '<script>';
		 echo 'console.log('. json_encode( $data ) .')';
		 echo '</script>';
	}

	define('SITE_KEY', '6LcJWdIUAAAAAEr28fa-1qZsY9mwNmA22LzJgyHl');
	
	session_start();

	if((isset($_SESSION['log-in'])) && ($_SESSION['log-in']==true))
	{
		header('Location: inventory-panel.php');
		exit();	#opusc plik jezeli wystapil ten warunek, w przeciwnym razie wykona sie caly kod strony i dopiero przejdzie do inventory-panel)
	}
	
	
	
	
?>



<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title> Magazyn Pinio.io </title>
	
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>"></script>

</head>
<body>
	<div class="div-login">
		<form  action="login.php" method="post">
		
			E-mail: <br/><input type="text" name="mail" >
			<?php 
				if(isset($_SESSION['err_mail'])){
					echo '<div class="error">'.$_SESSION['err_mail'].'</div>';
					unset($_SESSION['err_mail']);
				}
				else{
					echo'</br>';
				}
			?>
			Hasło: <br/><input type="password" name="password" />
			<?php 
				if(isset($_SESSION['err_pass'])){
					echo '<div class="error">'.$_SESSION['err_pass'].'</div>';
					unset($_SESSION['err_pass']);
				}	
				else{
					echo'<br/><br/>';
				}			
			?>
			
			<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />

			<input type="submit" value="Zaloguj się" />
		
		</form>
		
		<script>
			grecaptcha.ready(function() {
				grecaptcha.execute("<?php echo SITE_KEY; ?>", {action: "loginpage"}).then(function(token) {
					document.getElementById('g-recaptcha-response').value=token;
				});
			});
		</script>
		<?php 
			if(isset($_SESSION['err_CAPTCHA'])){
				echo '<span class="error">'.$_SESSION['err_CAPTCHA'].'</span>';
				unset($_SESSION['err_CAPTCHA']);
			}				
		?>
	</div>



</body>


</html>