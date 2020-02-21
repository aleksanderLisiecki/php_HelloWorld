 <?php
	session_start();	#otwiera sesje (zmienne)
	
	//formulaz wysłany?
	if(!isset($_POST['place']))
	{
		header('Location: inventory-panel.php');
		exit();
	}

	$db = require_once 'database.php';

	$query = $db->prepare('SELECT * FROM ah30 WHERE adres = ?');
	$query->execute([$_POST['address']]);

	$ah30 = $query->fetchAll();
	if($ah30){

		if($ah30[0]['available']){
			$query = $db->prepare('INSERT INTO pinio (adres, available) VALUES (?,?)');
			$query->execute([$_POST['address'], TRUE]);

			$query = $db->prepare('UPDATE ah30 SET available = ? WHERE ah30.adres = ?');
			$query->execute([FALSE, $_POST['address']]);
		}
		else{
			$_SESSION['no-available'] = true;
		}

	}
	else{
		$_SESSION['nonexisting-address'] = true;
	}
	header("Location: {$_POST['place']}");
?>