$(document).getElementById('iniciarSesionBtn').addEventListener('click', function(e) {
    e.preventDefault();
    var formData = new FormData(document.getElementById('formIniciarSesion'));
    $.ajax({ 
        url: '../controllers/inicioSesionController.php', 
        type: 'POST', 
        data: formData, 
        contentType: false,
        processData: false,
        success: function(data) {
            if (data === '1') {
                // Redirigir al usuario a redSocial.php si la autenticación es exitosa
                window.location.href = '../views/redSocial.php';
            } else {
                // Mostrar un mensaje de error si la autenticación falla
                alert('Usuario o contraseña incorrectos');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
        }
    });
});