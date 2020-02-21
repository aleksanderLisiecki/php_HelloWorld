 <?php
	session_start();

	if(!isset($_POST['place']))
	{
		header('Location: inventory-panel.php');
		exit();
	}
	$mask_pad = FALSE;
	if(isset($_POST['pad'])) $mask_pad = TRUE;

	$db = require_once 'database.php';

	$query = $db->prepare('INSERT INTO `sets` (e100, pinio, mask_in, mask_out, trzpien, pad) VALUES (:e100, :pinio, :mask_in, :mask_out, :trzpien, :pad)');
	$query->execute(
		[
		e100 => $_POST['e100-address'],
		pinio =>  $_POST['pinio-address'],
		mask_in =>  $_POST['mask-in'],
		mask_out =>  $_POST['mask-out'],
		trzpien =>  $_POST['trzpien'],
		pad =>  $mask_pad
		]);

	header("Location: {$_POST['place']}");
?>