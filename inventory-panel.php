<!––
***
* main panel witch kits view
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

	$setQuery = $db->query('SELECT * FROM `sets`');
	$sets = $setQuery->fetchAll();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Panel główny</title>
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
			<button onclick="window.location.href = '#';"> Panel główny </button>
			<button onclick="window.location.href = 'inventory-add-element.php';"> Dodaj akcesorium </button>
			<button onclick="window.location.href = 'inventory-add-set.php';"> Dodaj zestaw </button>
			<button onclick="window.location.href = 'inventory-add-e100.php';"> Dodaj E100 </button>
			<button onclick="window.location.href = 'inventory-add-ah30.php';"> Dodaj AH30 </button>
			<button onclick="window.location.href = 'inventory-add-pinio.php';"> Dodaj PINIO </button>
		</div>
		<div class="main-content">
			<legend>Dostępne zestawy</legend>

			<table>
				<thead>
				<tr><th>ID</th> <th>E100</th> <th>PINIO</th> <th>Mask.(IN/OUT)</th> <th>Trzpień</th> <th>Podkładki</th> </tr>
				</thead>
				<tbody>
					<?php
					foreach($sets as $set){
						echo "<tr><td>{$set['id']}</td> <td>{$set['e100']}</td> <td>{$set['pinio']}</td><td>{$set['mask_in']}/{$set['mask_out']}</td><td>{$set['trzpien']}</td>";
						if($set['pad']){
							echo "<td>2szt</td></tr>";
						}
						else{
							echo "<td>brak</td></tr>";
						}
					}
					?>
				</tbody>    
			</table>
			
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