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

	$pinioQuery = $db->query('SELECT * FROM pinio');
	$pinio = $pinioQuery->fetchAll();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title> Magazyn Pinio.io </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>

	$(document).ready(function(){
				
		$(function() {
		var select1 = $("#mask-in-select");
		var select2 = $("#mask-out-select");

		select1.on('change', function(event) {
			select2.val(select1.val());
		});
		});
	});
	</script>
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
			<button onclick="window.location.href = 'inventory-add-pinio.php';"> Dodaj PINIO </button>
		</div>
		<div class="main-content" id="kit-form">
			<legend>Dodaj zestaw:</legend>
			<form action="add-set.php" class="kit-form-class" method="post">
<!––
***
* E100
***
-->
				<div class="e100-label">
					<label for="e100-select">E100</label>
				</div>
				<div class="e100-select">
					<select id="e100-select" name="e100-address" required>
						<option disabled selected value> -- wybierz adres -- </option>
						<?php
							foreach($e100 as $part){
								if($part['available']){
									echo "<option>{$part['address']}</option>";
								}
							}
						?>
					</select>
				</div>
<!––
***
* PINIO
***
-->
				<div class="pinio-label">
					<label for="pinio-select">PINIO</label>
				</div>
				<div class="pinio-select">
					<select id="pinio-select" name="pinio-address" required>
						<option disabled selected value> -- wybierz adres -- </option>
						<?php
							foreach($pinio as $part){
								if($part['available']){
									echo "<option>{$part['address']}</option>";
								}
							}
						?>
					</select>
				</div>
<!––
***
* Maskownice
***
-->
				<div class="mask-in-label">
					<label for="mask-select">Mask. IN</label>
				</div>
				<div class="mask-in-select">
					<select id='mask-in-select' name='mask-in' required>
						<option disabled selected value> -- wybierz rozmiar -- </option>
						<option value='70'> 70 </option>
						<option value='72'> 72 </option>
						<option value='90'> 90 </option>
						<option value='92'> 92 </option>
						<option value='85'> 85 </option>
						<option value='0'> blank </option>
					</select>
				</div>
				<div class="mask-out-label">
					<label for="mask-select">Mask. OUT</label>
				</div>
				<div class="mask-out-select">
					<select id='mask-out-select' name='mask-out' required>
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
* Trzpień
***
-->
				<div class="trzpien-label">
					<label for="trzpien-select">Trzpień</label>
				</div>
				<div class="trzpien-select">
					<select id='trzpien-select' name='trzpien' required>
						<option disabled selected value> -- wybierz rozmiar -- </option>
						<option value='8/40-50'> 8mm/40-50mm (śruby M5x30 3szt.)</option>
						<option value='8/50-60'> 8mm/50-60mm (śruby M5x40 3szt.)</option>
						<option value='8/60-70'> 8mm/60-70mm (śruby M5x50 3szt.)</option>
						<option value='8/70-80'> 8mm/70-80mm (śruby M5x60 3szt.)</option>
						<option value='8/80-90'> 8mm/80-90mm (śruby M5x70 3szt.)</option>
						<option value='8/90-100'> 8mm/90-100mm (śruby M5x80 3szt.)</option>
					</select>
				</div>
<!––
***
* Podkładka
***
-->
				<div class="pad-label">
					<label for="pad-select">Podkładka pod maskownice</label></label>
				</div>
				<div class="pad-select">
					<input type="checkbox" id="pad-select" name="pad">
				</div>
				<input type="hidden" name="place" value="inventory-add-set.php">
				<button class="kit-form-add-button">Dodaj</button>
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