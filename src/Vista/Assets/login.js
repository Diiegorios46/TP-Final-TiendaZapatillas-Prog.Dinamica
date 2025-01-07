$(document).ready(function(){
    $('#login').submit(function(e){
        e.preventDefault();
        var datos = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: './action.php',
            data: datos,
            success: function(data){
                if(data == 1){
                    window.location.href = '../home/index.php';
                } else {
                    window.location.href = './index.php?error=1';
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    });
});