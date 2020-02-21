 <?php
	session_start();	
	
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

	$query = $db->prepare('SELECT * FROM e100 WHERE address = ?');
	$query->execute([$_POST['address']]);

	$e100 = $query->fetchColumn();
	if(!$e100){
		$query = $db->prepare('INSERT INTO e100 (address, available) VALUES (?,?)');
		$query->execute([$_POST['address'], TRUE]);
	}
	else{
		$_SESSION['existing-address'] = true;
	}
	header("Location: {$_POST['place']}");
?>