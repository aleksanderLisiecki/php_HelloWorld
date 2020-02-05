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
	<title> Magazyn Pinio.io </title>
</head>
<body>

<?php
	
	echo "<p>Login as: ".$_SESSION['mail'].' [<a href="logout.php">Sign out</a>]</p>';

?>

</body>
</html>
</html>