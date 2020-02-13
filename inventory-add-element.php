<!––
***
* adding elem. to inventory 
***
-->
<?php

	function clog( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}
	clog("*** CONSOLE LOGS AVAILABLE ***");
	session_start();
	
	if(!isset($_SESSION['log-in']))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once 'database.php';

	$invPartsQuery = $db->query('SELECT * FROM inventory');
	$invParts = $invPartsQuery->fetchAll();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<title> Magazyn Pinio.io </title>
</head>

<body>
<div class="container">
	<div class="header">
		<div class="login-text">
			<div>Login as: </div><div class="user"><?=$_SESSION['mail'];?></div>
		</div>
		<div class="login-spacer"></div>
		<a href="logout.php" class="logout-btn">
			Wyloguj się
		</a>
	</div>
	<div class="main-grid">
		<div class="left-bar">
			<legend>Opcje</legend>
			<button onclick="window.location.href = 'inventory-panel.php';"> Panel główny </button>
			<button onclick="window.location.href = 'inventory-add-element.php';"> Dodaj akcesorium </button>
			<button> Dodaj zestaw </button>
			<button> Dodaj E100 </button>
			<button> Dodaj AH30 </button>
		</div>
		<div class="main-content">
			<legend>Dodaj akcesorium:</legend>
			<div class="add-current-section">
				<form action="add-current-element.php" method="post">
					<button>Dodaj</button>
				</form>
			</div>
			<div class="add-new-section">
				<form action="add-new-element.php" method="post">
					<h3>Dodaj nowy element</h3>
					<?php
						if(isset($_SESSION['name_len'])){
							echo('<div class="error">Nazwa musi posiadać co najmniej 3 znaki</div>');
							unset($_SESSION['name_len']);
						}
					?>
					<div class="add-form">	
						<div>
							Nazwa
							<input type="text" name="name">
						</div>	
						<div class="add-new-qty">
							Ilość
							<input type="number" name="quantity" value="1">
						</div>
						<div>
							Symbol
							<input type="text" name="symbol">
						</div>
					</div>
					<input type="hidden" name="place" value="inventory-add-element.php">
					<button>Dodaj</button>
				</form>
			</div>
		</div>
		<div class="right-bar">
			<legend>Magazyn</legend>
			<table>
				<thead>
				<tr><th>ID</th><th>Nazwa</th><th>Ilość</th><th>Symbol</th></tr>
				</thead>
				<tbody>
					<?php
						foreach($invParts as $part){
							echo "<tr><td>{$part['id']}</td><td>{$part['nazwa']}</td><td>{$part['ilosc']}</td><td>{$part['symbol']}</td></tr>";
						}
					?>
				</tbody>
			</table>
		</div>	
	</div>
	<div class="footer">
	</div>
</div>
</body>
</html>