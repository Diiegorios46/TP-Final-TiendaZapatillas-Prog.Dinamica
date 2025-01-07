
$('#loginForm').validate({
    rules: {
        usnombre: {
            required: true,
            minlength: 3
        },
        usmail: {
            required: true,
            email: true
        },
        uspass: {
            required: true,
            minlength: 6
        }
    },
    messages: {
        usnombre: {
            required: "Por favor ingrese un nombre de usuario",
            minlength: "El nombre de usuario debe tener al menos 3 caracteres"
        },
        usmail: {
            required: "Por favor ingrese un correo electrónico",
            email: "Por favor ingrese un correo electrónico válido"
        },
        uspass: {
            required: "Por favor ingrese una contraseña",
            minlength: "La contraseña debe tener al menos 6 caracteres"
        }
    },
    submitHandler: function(form) {
        $.ajax({
            type: 'POST',
            url: './action.php',
            data: $(form).serialize(),
            success: function(response) {
                response = JSON.parse(response);
                console.log(response);
                
                if (response == "success") {
                    window.location.href = '../login/index.php?login=1';
                }
            },
            error: function() {
                window.location.href = './index.php?error=2';
            }
        });
    }
});

