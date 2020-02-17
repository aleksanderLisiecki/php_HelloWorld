<?php
    $db = require_once 'database.php';



	$e100Query = $db->query('SELECT * FROM e100');
    $e100 = $e100Query->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>



$(function() {
    var select1 = $("#address-select");
    var select2 = $('select[name="v2"].wariant2');

    var a= <?php echo json_encode($e100); ?>; 
    select1.on('change', function(event) {
        console.log(select1.val());
        for(var i=0; i<a.length; i++){
            console.log(a[i]['adres']);
            if(a[i]['adres'] === select1.val()){
                console.log(a[i]['id']);
            };
        }
        
        
    });
});


</script>
</head>
<body>


<main>
        <select id="address-select" name="name-curr" required>
            <option disabled selected value> -- wybierz adres -- </option>
            <?php
                foreach($e100 as $part){
                    echo "<option>{$part['adres']}</option>";
                }
            ?>
        </select>

        <select name="v2" class="wariant2">
            <option data-bind="1" value="1">Opcja 1</option>
            <option data-bind="2" value="2">Opcja 2</option>
            <option data-bind="0" value="3">Opcja 3</option>
        </select>
    </main>


</body>
</html>
