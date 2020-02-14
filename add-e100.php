 <?php
	session_start();	#otwiera sesje (zmienne)
	
	//formulaz wysłany?
	if(!isset($_POST['place']))
	{
		header('Location: inventory-panel.php');
		exit();
	}

	if(!preg_match('/\A\[[0-9A-Za-z]{2}\.[0-9A-Za-z]{2}\.[0-9A-Za-z]{2}\]$/', $_POST['address'], $matches)){
		$_SESSION['invalid-address'] = true;
		header("Location: {$_POST['place']}");
		exit();
	}

	$db = require_once 'database.php';

	$query = $db->prepare('INSERT INTO e100 (adres) VALUES (?)');
	$query->execute([$_POST['address']]);

	header("Location: {$_POST['place']}");
?>