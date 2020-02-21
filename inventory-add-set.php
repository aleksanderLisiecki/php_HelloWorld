<!––
***
* kit menage page
***
-->

<?php
	session_start();

	if(!isset($_SESSION['log-in']))
	{
		header('Location: index.php');
		exit();
	}

	$db = require_once 'database.php';

	$e100Query = $db->query('SELECT * FROM e100');
	$e100 = $e100Query->fetchAll();

	$ah30Query = $db->query('SELECT * FROM ah30');
	$ah30 = $ah30Query->fetchAll();

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
			<button onclick="window.location.href = '#';"> Dodaj zestaw </button>
			<button onclick="window.location.href = 'inventory-add-e100.php';"> Dodaj E100 </button>
			<button onclick="window.location.href = 'inventory-add-ah30.php';"> Dodaj AH30 </button>
		</div>
		<div class="main-content" id="kit-form">
			<legend>Dodaj zestaw:</legend>
			<form action="add-set.php" class="kit-form-class" method="post">
<!––
***
* E100
***
-->
				<div>
					<label for="e100-select">E100</label>
				</div>
				<div>
					<select id="e100-select" name="e100-address" required>
						<option disabled selected value> -- wybierz adres -- </option>
						<?php
							foreach($e100 as $part){
								echo "<option>{$part['adres']}</option>";
							}
						?>
					</select>
				</div>
<!––
***
* AH30
***
-->
				<div>
					<label for="ah30-select">AH30</label>
				</div>
				<div>
					<select id="ah30-select" name="ah30-address" required>
						<option disabled selected value> -- wybierz adres -- </option>
						<?php
							foreach($ah30 as $part){
								echo "<option>{$part['adres']}</option>";
							}
						?>
					</select>
				</div>
<!––
***
* Maskownice
***
-->
				<div>
					<label for="battery-select">Mask. IN</label>
				</div>
				<div>
					<select id='availibility-select' name='availibility'>
						<option disabled selected value> -- wybierz rozmiar -- </option>
						<option value='70'> 70 </option>
						<option value='72'> 72 </option>
						<option value='90'> 90 </option>
						<option value='92'> 92 </option>
						<option value='85'> 85 </option>
						<option value='0'> blank </option>
					</select>
				</div>
				<div>

					<label for="battery-select">Mask. OUT</label>
				</div>
				<div>
					<select id='availibility-select' name='availibility'>
						<option disabled selected value> -- wybierz rozmiar -- </option>
						<option value='70'> 70 </option>
						<option value='72'> 72 </option>
						<option value='90'> 90 </option>
						<option value='92'> 92 </option>
						<option value='85'> 85 </option>
						<option value='0'> blank </option>
					</select>
				</div>
<!––
***
* Baterry
***
-->
				<div>
					<label for="battery-select">Bateria</label>
				</div>
				<div>
					<input type="checkbox" id="battery-select" name="battery">
				</div>



			</form>
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
</html>