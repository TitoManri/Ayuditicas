var contrasenia = document.getElementById("contrasenia")
  , confirmar_contrasenia = document.getElementById("confirmar_contrasenia");

function validarContrasenia(){
  if(contrasenia.value != confirmar_contrasenia.value) {
    confirmar_contrasenia.setCustomValidity("Las contraseñas no coinciden");
  } else {
    confirmar_contrasenia.setCustomValidity('');
  }
}

contrasenia.onchange = validarContrasenia;
confirmar_contrasenia.onkeyup = validarContrasenia;

$(document).ready(function () { 
    $('#registro').on('submit', function (e) { 
        e.preventDefault(); 
        var formData = new FormData($('#registro')[0])
        $.ajax({
            url: '../controllers/registroSesionController.php',
            type: 'POST', 
            data: formData,
            contentType :  false,
            processData  : false, 

            success: function(response) { 
                $('#response').html('<div class="alert alert-success">Usuario registrado exitosamente!</div>');
            }, 
            error: function(err) { 
                $('#response').html('<div class="alert alert-danger">Error al registrar el usuario.</div>'); 
            } 
        }); 
    });
});