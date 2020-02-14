<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

function clog( $data ){
    console.log($data);
}



$(document).ready(function(){
    $("#input").keypress(function () {

        $(this).val('['+$(this).val().replace(/\[|\]/g, ''));
        var len=this.value.length - 1;
        x = this.value.match(/\./g)
        if(x) len -= x.length;
        if(((len % 2) == 0) && len < this.maxLength-3 && len > 1){
            $(this).val($(this).val() + '.');
            }
    });

    $("#input").keyup(function () {

        this.value = this.value.toUpperCase();

        $(this).val($(this).val().replace(/\]/g, ''));
        $(this).val($(this).val() + "]");
        var pos = $(this).val().length - 1;
        this.setSelectionRange(pos, pos);
    });
});





</script>
</head>
<body>
<div>
    <input id = "input" maxlength = 9>
</div>
</body>
</html>
