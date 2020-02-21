<!––
***
* adding E100 to DB
* and changing availibility E100 in DB
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

	$pinioQuery = $db->query('SELECT * FROM pinio');
	$pinio = $pinioQuery->fetchAll();

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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
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
			<button onclick="window.location.href = 'inventory-add-set.php';"> Dodaj zestaw </button>
			<button onclick="window.location.href = 'inventory-add-e100.php';"> Dodaj E100 </button>
			<button onclick="window.location.href = 'inventory-add-ah30.php';"> Dodaj AH30 </button>
			<button onclick="window.location.href = '#';"> Dodaj PINIO </button>

		</div>
		<div class="main-content">
			<legend>PINIO:</legend>

			<div class="e100-main-content">
<!––
***
* adding new PINIO to DB
***
-->
				<div class="e100-add">
					<form action="add-pinio.php" method="post" onsubmit="return confirm('Na pewno chcesz dodać element?');">
						<h3>Dodaj PINIO:</h3>
						<?php
						if(isset($_SESSION['nonexisting-address'])){
							echo('<div class="error">Adres AH30 w bazie nie istnieje</div>');
							unset($_SESSION['nonexisting-address']);
						}
						if(isset($_SESSION['no-available'])){
							echo('<div class="error">AH30 niedostępne</div>');
							unset($_SESSION['no-available']);
						}
						?>
						<label for="address-select">Wybór adresu AH30</label>
						<select id="address-select" name="address" required>
							<option disabled selected value> -- wybierz adres -- </option>
							<?php
								foreach($ah30 as $part){
									if($part['available']) echo "<option>{$part['adres']}</option>";
								}
							?>
						</select>	

						<input type="hidden" name="place" value="inventory-add-pinio.php">
						<button>Dodaj</button>
					</form>
				</div>

				<div class="e100-inventory">
					<h3>Stan PINIO:</h3>	
						<table>
							<thead>
							<tr><th>ID</th><th>Adres</th><th>Dostępność</th></tr>
							</thead>
							<tbody>
								<?php
									foreach($pinio as $part){
										echo "<tr><td>{$part['id']}</td><td>{$part['adres']}</td><td>{$part['available']}</td></tr>";
									}
								?>
							</tbody>
						</table>
				</div>	
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