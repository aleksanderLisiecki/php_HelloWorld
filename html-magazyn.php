<legend>Magazyn</legend>
<table>
    <thead>
    <tr><th>ID</th><th>Nazwa</th><th>Ilość</th><th>Symbol</th></tr>
    </thead>
    <tbody>
        <?php
            /***
            * setting quantity of e100 and ah30
            ***/
            require_once 'set-e100-and-ah30-qty.php';

            $invPartsQuery = $db->query('SELECT * FROM inventory');
            $invParts = $invPartsQuery->fetchAll();

            foreach($invParts as $part){
                echo "<tr><td>{$part['id']}</td><td>{$part['nazwa']}</td><td>{$part['ilosc']}</td><td>{$part['symbol']}</td></tr>";
            }
        ?>
    </tbody>    
</table>