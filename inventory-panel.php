<?php

	session_start();
	
	if(!isset($_SESSION['log-in']))
	{
		header('Location: index.php');
		exit();
	}
	
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
<div class="div-login">
<?php
	
	echo "<p>Login as: ".$_SESSION['mail'].' [<a href="logout.php" title="Wyloguj się">Sign out</a>]</p>';

?>
</div>
</body>
</html>
</html>