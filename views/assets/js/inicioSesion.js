$(document).ready(function() {   
    $('#formIniciarSesion').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
            url: '../controllers/inicioSesionController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', // Asegúrate de que el controlador PHP devuelva JSON
            success: function(data) {
                
                if (data.exito) {
                    // Cambiar el contenido de la página para simular una redirección
                    $('#formIniciarSesion').hide();
                    $('#response').html('<div class="alert alert-success">' + data.msg + '</div>');

                    // Cargar el contenido de la nueva página o sección
                    // $('.container').load('./redSocial.php');
                    $(location).attr('href','redSocial.php')
                } else {
                    // Mostrar un mensaje de error si la autenticación falla
                    
                    $('#response').html('<div class="alert alert-danger">' + data.msg + '</div>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                
                console.error('Error:', textStatus, errorThrown);
                $('#response').html('<div class="alert alert-danger">Ocurrió un error al intentar iniciar sesión. Inténtalo de nuevo.</div>');
            }
        });
    });
});
