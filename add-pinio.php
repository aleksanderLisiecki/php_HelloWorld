 <?php
	session_start();
	
	if(!isset($_POST['place']))
	{
		header('Location: inventory-panel.php');
		exit();
	}

	$db = require_once 'database.php';

	$query = $db->prepare('SELECT * FROM ah30 WHERE address = ?');
	$query->execute([$_POST['address']]);

	$ah30 = $query->fetchAll();
	if($ah30){

		if($ah30[0]['available']){
			$query = $db->prepare('INSERT INTO pinio (address, available) VALUES (?,?)');
			$query->execute([$_POST['address'], TRUE]);

			$query = $db->prepare('UPDATE ah30 SET available = ? WHERE ah30.address = ?');
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