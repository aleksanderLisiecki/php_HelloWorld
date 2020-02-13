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

	//warunek ilosci znakow
	if(strlen($_POST['name-new'])<3){
		$_SESSION['name_len'] = true;
		header("Location: {$_POST['place']}");
		exit();
	}

	$db = require_once 'database.php';

	$query = $db->prepare('INSERT INTO inventory (nazwa, ilosc, symbol) VALUES (:namee, :quantity, :symbol)');
	$query->bindValue(':namee', $_POST['name-new'], PDO::PARAM_STR);
	$query->bindValue(':quantity', intval($_POST['quantity-new']), PDO::PARAM_INT);
	$query->bindValue(':symbol', $_POST['symbol-new'], PDO::PARAM_STR);
	$query->execute();


	header("Location: {$_POST['place']}");
?>