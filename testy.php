<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

function clog( $data ){
    console.log($data);
}


</script>
</head>
<body>


<?php
$a = "[xx.xx..4]";
var_dump($a,
preg_match('/\A\[[0-9A-Za-z]{2}\.[0-9A-Za-z]{2}\.[0-9A-Za-z]{2}\]$/', $a, $matches)
);
?>


</body>
</html>
