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
	clog("*** CLOG AVAILABLE ***");

	function submit( $i ){
		if($i){
			return(true);
	   	}
	   	else{
		   alert("Please check value of VAR");
		   return(false);
	   	}
	}

	session_start();
	
	if(!isset($_SESSION['log-in']))
	{
		header('Location: index.php');
		exit();
	}
	
	$db = require_once 'database.php';

	$invPartsQuery = $db->query('SELECT * FROM inventory');
	$invParts = $invPartsQuery->fetchAll();

	$e100Query = $db->query('SELECT * FROM e100');
	$e100 = $e100Query->fetchAll();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<title> Magazyn Pinio.io </title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
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
			<button> Dodaj zestaw </button>
			<button onclick="window.location.href = '#';"> Dodaj E100 </button>
			<button> Dodaj AH30 </button>
		</div>
		<div class="main-content">
			<legend>E100:</legend>

			<div class="e100-main-content">
				<div class="e100-add">
					<form action="add-e100.php" method="post" onsubmit="return confirm('Na pewno chcesz dodać element?');">
						<h3>Dodaj E100:</h3>
						<?php
						if(isset($_SESSION['invalid-address'])){
							echo('<div class="error">Nieprawidłowy adres</div>');
							unset($_SESSION['invalid-address']);
						}
						?>
						<label for="address-input">Adres dodawanego E100</label>
						<input name="address" id="address-input" maxlength=9 autocomplete=off title="Błąd: podczas usuwania znaków należy usunąć także kropki" required>
						<input type="hidden" name="place" value="inventory-add-e100.php">
						<button>Dodaj</button>
					</form>
				</div>
				<div class="e100-inventory">
					<h3>Stan E100:</h3>	
						<table>
							<thead>
							<tr><th>ID</th><th>Adres</th></tr>
							</thead>
							<tbody>
								<?php
									foreach($e100 as $part){
										echo "<tr><td>{$part['id']}</td><td>{$part['adres']}</td></tr>";
									}
								?>
							</tbody>
						</table>
				</div>	
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