<?php
	function clog( $data ){
		 echo '<script>';
		 echo 'console.log('. json_encode( $data ) .')';
		 echo '</script>';
	}
	
	
	define('SITE_KEY', '6LcJWdIUAAAAAEr28fa-1qZsY9mwNmA22LzJgyHl');
	define('SECRET_KEY', '6LcJWdIUAAAAAPiz33XGansAvptf3vlY3uxUmCRr');
	
	session_start();	#otwiera sesje (zmienne)
	
	//formulaz wysłany?
	if((!isset($_POST['mail'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}
	
	//formularz przyjety 
	$evertyhing_OK = true;
	
	//test captchy
	function getCaptcha($SecretKey){
		$Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
		$Return = json_decode($Response);
		return $Return;					
	}
	$Return = getCaptcha($_POST['g-recaptcha-response']);
		if(($Return -> success == true) && ($Return -> score > 0.5)){ //test captcha zaliczony
	}else{
		$evertyhing_OK = false;
		$_SESSION['err_CAPTCHA'] = "Test CAPTCHA nie przeszedł pomyślnie. Wynik: ".$Return -> score;
		header('Location: index.php');
		exit();
	}
	
	
	//test maila 
	$mail = $_POST['mail'];
	$sanitizeMail = filter_var($mail, FILTER_SANITIZE_EMAIL);	//usuniecie z maila niedozwolonych znakow
	
	if((filter_var($sanitizeMail, FILTER_VALIDATE_EMAIL)==false) || ($sanitizeMail != $mail)){	//test poprawnosci maila
		$evertyhing_OK = false;
		$_SESSION['err_mail'] = "Niepoprawny E-mail";
		header('Location: index.php');
		exit();
	}
	
	
	if($evertyhing_OK == true){
		//kod gdy testy zakoncza sie pomyslnie 
		
		require_once "connect.php"; 	#"wklejaj" tutaj to co jest w pliku connect.php (tam są dane do polaczenia sie z baza danych 
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try{
			$connect = new mysqli($host, $db_user, $db_password, $db_name);	#laczy sie z baza o danych pobranych z pliku wyzej
			
			if($connect -> connect_errno !=0)	#sprawdza polaczenie, jezeli sie nie udalo to bedzie error
			{
				throw new Exception(mysqli_connect_errno());
			}else{
				$mail = $_POST['mail'];	#zaciaga zmienne wyslane do tego pliku metoda post
				$password = $_POST['password'];
				
				$mail = htmlentities($mail, ENT_QUOTES, "UTF-8");
						
				$result = $connect -> query(sprintf("SELECT * FROM logins WHERE mail = '%s'", mysqli_real_escape_string($connect, $mail)));#wysyla zapytanie do bazy
				if(!$result) throw new Exception($connect->error);
				$rows = $result -> num_rows;	#pobiera informacje o ilosci wierszy
				if($rows>0)	#poprawny login, jezeli sa jakies pobrane wiersze (w przypadku logowania powinno byc zawsze 1 lub 0)
				{
					$row = $result -> fetch_assoc();	#tablica asocjacyjna wartosci z tego wiersza
					if(password_verify($password, $row['password'])){	#sprawdzanie hashowanego hasła
						
						$_SESSION['log-in'] = true;	#zmienna flaga ktora mowi ze ktos jest zalogowany
					
						$_SESSION['id'] = $row['id'];	#zmeinne sesyjne
						$_SESSION['mail'] = $row['mail'];
						
						unset($_SESSION['err_mail']);	#usun z pamieci zmienna bledu logowania
						unset($_SESSION['err_pass']);
						
						$result -> close();	#czyszczenie pamieci 
						header("Location: inventory-panel.php");
					}else {
						$_SESSION['err_pass'] = 'Nieprawidłowe hasło';
						header('Location: index.php');
					}
				} else {	#mysql zwrocil 0 rekordow dotyczacych zapytania (nieprawidlowe dane)
					
					$_SESSION['err_mail'] = 'Nieprawidłowy mail';
					header('Location: index.php');
					
				}
				
				$connect -> close();	#zamyka polaczenie
			}
		}
		catch(Exception $e){
			echo 'Błąd połączenia z bazą danych<br/>';
			echo 'Informacja deweloperska: '.$e;
		}
	}
?>