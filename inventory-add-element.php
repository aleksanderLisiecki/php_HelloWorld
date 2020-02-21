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
	
	$db = require_once 'database.php';
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
			<button onclick="window.location.href = '#';"> Dodaj akcesorium </button>
			<button onclick="window.location.href = 'inventory-add-set.php';"> Dodaj zestaw </button>
			<button onclick="window.location.href = 'inventory-add-e100.php';"> Dodaj E100 </button>
			<button onclick="window.location.href = 'inventory-add-ah30.php';"> Dodaj AH30 </button>
			<button onclick="window.location.href = 'inventory-add-pinio.php';"> Dodaj PINIO </button>
		</div>
		<div class="main-content">
			<legend class="main-content-legend">Dodaj akcesorium:</legend>
<!––
***
* adding existing elem. to inventory 
***
-->
			<div class="add-current-section">
				<form action="add-current-element.php" method="post" onsubmit="return confirm('Na pewno chcesz dodać element?');">
					<h3>Dodaj istniejący element</h3>
					<div class="add-form">	
						<div>
							<label for="elem-curr-select">Element</label>
							<select id="elem-curr-select" name="name-curr" required>
								<option disabled selected value> -- wybierz element -- </option>
								<?php
									foreach($invParts as $part){
										echo "<option>{$part['nazwa']}</option>";
									}
								?>
							</select>
						</div>	
						<div class="add-new-qty">
							<label for="elem-curr-qty">Dodawana ilość</label>
							<input id="elem-curr-qty" type="number" name="quantity-curr" value="0">
						</div>
					</div>
					<input type="hidden" name="place" value="inventory-add-element.php">
					<button>Wykonaj</button>
				</form>
			</div>
<!––
***
* adding new elem. to inventory 
***
-->
			<div class="add-new-section">
				<form action="add-new-element.php" method="post" onsubmit="return confirm('Na pewno chcesz dodać nowy element?');">
					<h3>Dodaj nowy element</h3>
					<?php
						if(isset($_SESSION['name_len'])){
							echo('<div class="error">Nazwa musi posiadać co najmniej 3 znaki</div>');
							unset($_SESSION['name_len']);
						}
					?>
					<div class="add-form">	
						<div>
							<label for="elem-new-name">Nazwa</label>
							<input id="elem-new-name" type="text" name="name-new">
						</div>	
						<div class="add-new-qty">
							<label for="elem-new-qty">Ilość</label>
							<input id="elem-new-qty" type="number" name="quantity-new" value="1">
						</div>
						<div>
							<label for="elem-new-symbol">Symbol</label>
							<input id="elem-new-symbol" type="text" name="symbol-new">
						</div>
					</div>
					<input type="hidden" name="place" value="inventory-add-element.php">
					<button>Dodaj</button>
				</form>
			</div>
		</div>
		<div class="right-bar">
			<?php
			require 'html-magazyn.php';
			?>
		</div>	
	</div>
	<div class="footer">
	</div>
</div>
</body>
</html>