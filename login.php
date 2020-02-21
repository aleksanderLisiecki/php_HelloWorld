<?php
	function clog( $data ){
		 echo '<script>';
		 echo 'console.log('. json_encode( $data ) .')';
		 echo '</script>';
	}

	define('SITE_KEY', '6LcJWdIUAAAAAEr28fa-1qZsY9mwNmA22LzJgyHl');
	define('SECRET_KEY', '6LcJWdIUAAAAAPiz33XGansAvptf3vlY3uxUmCRr');
	
	session_start();
	
	if((!isset($_POST['mail'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}

	$evertyhing_OK = true;
	
	//test captchy
	function getCaptcha($SecretKey){
		$Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
		$Return = json_decode($Response);
		return $Return;					
	}
	$Return = getCaptcha($_POST['g-recaptcha-response']);
	if(!(($Return -> success == true) && ($Return -> score > 0.5))){ 
		$evertyhing_OK = false;
		$_SESSION['err_CAPTCHA'] = "Test CAPTCHA nie przeszedł pomyślnie. Wynik: ".$Return -> score;
		header('Location: index.php');
		exit();
	}
	
	
	//test maila 
	$mail = $_POST['mail'];
	$sanitizeMail = filter_var($mail, FILTER_SANITIZE_EMAIL);
	if((filter_var($sanitizeMail, FILTER_VALIDATE_EMAIL)==false) || ($sanitizeMail != $mail)){
		$evertyhing_OK = false;
		$_SESSION['err_mail'] = "Niepoprawny E-mail";
		header('Location: index.php');
		exit();
	}
	
	
	if($evertyhing_OK == true){
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try{
			$connect = new mysqli($host, $db_user, $db_password, $db_name);
			
			if($connect -> connect_errno !=0)
			{
				throw new Exception(mysqli_connect_errno());
			}else{
				$mail = $_POST['mail'];
				$password = $_POST['password'];
				
				$mail = htmlentities($mail, ENT_QUOTES, "UTF-8");
						
				$result = $connect -> query(sprintf("SELECT * FROM logins WHERE mail = '%s'", mysqli_real_escape_string($connect, $mail)));#wysyla zapytanie do bazy
				if(!$result) throw new Exception($connect->error);
				$rows = $result -> num_rows;
				if($rows>0)
				{
					$row = $result -> fetch_assoc();
					if(password_verify($password, $row['password'])){
						$_SESSION['log-in'] = true;
					
						$_SESSION['id'] = $row['id'];
						$_SESSION['mail'] = $row['mail'];
						
						unset($_SESSION['err_mail']);
						unset($_SESSION['err_pass']);
						
						$result -> close();
						header("Location: inventory-panel.php");
					}else {
						$_SESSION['err_pass'] = 'Nieprawidłowe hasło';
						header('Location: index.php');
					}
				} else {
					$_SESSION['err_mail'] = 'Nieprawidłowy mail';
					header('Location: index.php');
				}
				
				$connect -> close();
			}
		}
		catch(Exception $e){
			echo 'Błąd połączenia z bazą danych<br/>';
			echo 'Informacja deweloperska: '.$e;
		}
	}
?>