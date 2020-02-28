<!––
***
* adding and changing availibility of AH30, 
* page is directly copy of adding E100 (css class name is for the e100 too)
* witch change in fetching DB data in PHP section
* and F/E tags 
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

	$ah30Query = $db->query('SELECT * FROM ah30');
	$ah30 = $ah30Query->fetchAll();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title> Dodaj AH30 </title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
	//*** funkcje templatki wypisywania adresu ***/
	$(document).ready(function(){
		$("#address-input").keypress(function () {
			$(this).val('['+$(this).val().replace(/\[|\]/g, ''));
			var len=this.value.length - 1;
			x = this.value.match(/\./g)
			if(x) len -= x.length;
			if(((len % 2) == 0) && len < this.maxLength-3 && len > 1){
				$(this).val($(this).val() + '.');
				}
		});
		$("#address-input").keyup(function () {
			this.value = this.value.toUpperCase();

			$(this).val(($(this).val().replace(/\]/g, '')) + "]");
			var pos = $(this).val().length - 1;
			this.setSelectionRange(pos, pos);
		});
		
		//*** funkcja opcji select  ***/
		$(function() {
		var select1 = $("#address-select");
		var select2 = $("#availibility-select");

		var ah30 = <?php echo json_encode($ah30); ?>; 

		select1.on('change', function(event) {
			for(var i=0; i<ah30.length; i++){
				if(ah30[i]['address'] === select1.val()){
					select2.val(ah30[i]['available']);
					select2.show();
				};
			}
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
			<button onclick="window.location.href = 'inventory-add-set.php';"> Dodaj zestaw </button>
			<button onclick="window.location.href = 'inventory-add-e100.php';"> Dodaj E100 </button>
			<button onclick="window.location.href = '#';"> Dodaj AH30 </button>
			<button onclick="window.location.href = 'inventory-add-pinio.php';"> Dodaj PINIO </button>
		</div>
		<div class="main-content">
			<legend>AH30:</legend>

			<div class="e100-main-content">
<!––
***
* adding new ah30 to DB
***
-->
				<div class="e100-add">
					<form action="add-ah30.php" method="post" onsubmit="return confirm('Na pewno chcesz dodać element?');">
						<h3>Dodaj AH30:</h3>
						<?php
						if(isset($_SESSION['invalid-address'])){
							echo('<div class="error">Nieprawidłowy adres (format: "[XX.XX.XX]")</div>');
							unset($_SESSION['invalid-address']);
						}
						if(isset($_SESSION['existing-address'])){
							echo('<div class="error">Adres już istnieje w bazie</div>');
							unset($_SESSION['existing-address']);
						}
						?>
						<label for="address-input">Adres dodawanego AH30</label>
						<input name="address" id="address-input" maxlength=9 autocomplete=off title="Występujący błąd: podczas usuwania znaków należy usunąć także kropki" required>
						<input type="hidden" name="place" value="inventory-add-ah30.php">
						<button>Dodaj</button>
					</form>
				</div>
<!––
***
* changing existing ah30
***
-->
				<div class="e100-available">
					<form action="change-ah30.php" method="post">
						<h3>Zmień dostępność:</h3>
						<label for="address-select">Wybór AH30</label>
						<select id="address-select" name="address-curr" required>
							<option disabled selected value> -- wybierz adres -- </option>
							<?php
								foreach($ah30 as $part){
									echo "<option>{$part['address']}</option>";
								}
							?>
						</select>
						<select id='availibility-select' name='availibility'>
							<option disabled selected value> <- wybierz adres</option>
							<option value='0'> Niedostępny </option>
							<option value='1'> Dostępny </option>		
						</select>
						<input type="hidden" name="place" value="inventory-add-ah30.php">
						<button>Aktualizuj</button>
					</form>
				</div>
				<div class="e100-inventory">
					<h3>Stan AH30:</h3>	
						<table>
							<thead>
							<tr><th>ID</th><th>Adres</th><th>Dostępność</th></tr>
							</thead>
							<tbody>
								<?php
									foreach($ah30 as $part){
										echo "<tr><td>{$part['id']}</td><td>{$part['address']}</td><td>{$part['available']}</td></tr>";
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