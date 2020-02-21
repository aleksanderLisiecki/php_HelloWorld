 <?php
	session_start();
 
	if(!isset($_POST['place']))
	{
		header('Location: inventory-panel.php');
		exit();
	}

	$db = require_once 'database.php';

	$query = $db->prepare('UPDATE ah30 SET available = ? WHERE ah30.address = ?');
	$query->execute([$_POST['availibility'], $_POST['address-curr']]);

	header("Location: {$_POST['place']}");
?>