 <?php
	session_start();	
	
	if(!isset($_POST['place']))
	{
		header('Location: inventory-panel.php');
		exit();
	}

	$db = require_once 'database.php';

	$invPartsQuery = $db->prepare("SELECT quantity FROM inventory WHERE name=? ");
	$invPartsQuery->execute([$_POST['name-curr']]);
	
	$partQty = $invPartsQuery->fetch();
	
	$partQty = $partQty['quantity'];

	$partQty += intval($_POST['quantity-curr']);

	$query = $db->prepare('UPDATE `inventory` SET `quantity` = :quantity WHERE `inventory`.`name` = :namee');
	$query->execute([':namee' => $_POST['name-curr'], ':quantity' => intval($partQty)]);

	header("Location: {$_POST['place']}");
?>