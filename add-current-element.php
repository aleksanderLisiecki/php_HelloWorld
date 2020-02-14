 <?php
	session_start();	#otwiera sesje (zmienne)
	
	//formulaz wysłany?
	if(!isset($_POST['place']))
	{
		header('Location: inventory-panel.php');
		exit();
	}

	$db = require_once 'database.php';

	$invPartsQuery = $db->prepare("SELECT ilosc FROM inventory WHERE nazwa=? ");
	$invPartsQuery->execute([$_POST['name-curr']]);
	
	$partQty = $invPartsQuery->fetch();
	
	$partQty = $partQty['ilosc'];

	$partQty += intval($_POST['quantity-curr']);

	$query = $db->prepare('UPDATE `inventory` SET `ilosc` = :quantity WHERE `inventory`.`nazwa` = :namee');
	$query->execute([':namee' => $_POST['name-curr'], ':quantity' => intval($partQty)]);

	header("Location: {$_POST['place']}");
?>