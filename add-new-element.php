<?php
	function clog( $data ){
		 echo '<script>';
		 echo 'console.log('. json_encode( $data ) .')';
		 echo '</script>';
	}

	session_start();	#otwiera sesje (zmienne)
	
	//formulaz wysłany?
	if(!isset($_POST['place']))
	{
		header('Location: inventory-panel.php');
		exit();
	}

	if(strlen($_POST['name'])<3){
		$_SESSION['name_len'] = true;
		header("Location: {$_POST['place']}");
		exit();
	}

	require_once 'database.php';

	$query = $db->prepare('INSERT INTO inventory (nazwa, ilosc, symbol) VALUES (:namee, :quantity, :symbol)');
	$query->bindValue(':namee', $_POST['name'], PDO::PARAM_STR);
	$query->bindValue(':quantity', intval($_POST['quantity']), PDO::PARAM_INT);
	$query->bindValue(':symbol', $_POST['symbol'], PDO::PARAM_STR);
	$query->execute();


	header("Location: {$_POST['place']}");
?>