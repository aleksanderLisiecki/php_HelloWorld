<?php
$parts = ["E100", "AH30"];

foreach($parts as $part){
	$query = $db->prepare('SELECT * FROM '.strtolower($part).' WHERE available = "1"');
	$query->execute();
	$query = $query->fetchAll();

	$quantity = count($query);

	$query = $db->prepare('UPDATE inventory SET ilosc = ? WHERE inventory.nazwa = ?');
	$query->execute([$quantity, $part]);
}