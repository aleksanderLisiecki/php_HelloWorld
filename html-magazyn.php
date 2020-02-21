<?php
if(!isset($db)){
	$db = require_once 'database.php';
}


require_once 'set-e100ah30-qty.php';

$invPartsQuery = $db->query('SELECT * FROM inventory');
$invParts = $invPartsQuery->fetchAll();

$e100Query = $db->query('SELECT * FROM e100');
$e100 = $e100Query->fetchAll();

$ah30Query = $db->query('SELECT * FROM ah30');
$ah30 = $ah30Query->fetchAll();

?>
<div class="elements-sidebar-inventory">
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

<div class="e100-sidebar-inventory">
    <legend>Stan E100</legend>	
    <table>
        <thead>
        <tr><th>ID</th><th>Adres</th><th>Dostępność</th></tr>
        </thead>
        <tbody>
            <?php
                foreach($e100 as $part){
                    echo "<tr><td>{$part['id']}</td><td>{$part['adres']}</td><td>{$part['available']}</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<div class="pinio-sidebar-inventory">
    <legend>Stan PINIO:</legend>	
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

<div class="ah30-sidebar-inventory">
    <legend>Stan AH30</legend>	
    <table>
        <thead>
        <tr><th>ID</th><th>Adres</th><th>Dostępność</th></tr>
        </thead>
        <tbody>
            <?php
                foreach($ah30 as $part){
                    echo "<tr><td>{$part['id']}</td><td>{$part['adres']}</td><td>{$part['available']}</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>
