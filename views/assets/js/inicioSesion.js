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
            dataType: 'json', 
            success: function(data) {
                
                if (data.exito) {
                    $('#formIniciarSesion').hide();
                    $('#response').html('<div class="alert alert-success">' + data.msg + '</div>');

                    $(location).attr('href','redSocial.php')
                } else {
                    $('#response').html('<div class="alert alert-danger">' + data.msg + '</div>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {                
                $('#response').html('<div class="alert alert-danger">Ocurrió un error al intentar iniciar sesión. Inténtalo de nuevo.</div>');
            }
        });
    });
});
