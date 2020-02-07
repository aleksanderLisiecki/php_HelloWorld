<?php

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
			<button> Dodaj akcesorium </button>
			<button> Dodaj zestaw </button>
			<button> Dodaj E100 </button>
			<button> Dodaj AH30 </button>
		</div>
		<div class="main-content">
			<legend>Dodaj akcesorium:</legend>
			
			
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
</html>