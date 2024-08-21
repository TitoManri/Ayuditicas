console.log("Blogs.js cargado");
$(document).ready(function() {
    console.log("jQuery listo");
    $('#crearBlogForm').on('submit', function(event) {
        
        event.preventDefault();
        console.log("Formulario enviado");
        // Crear el objeto FormData
        let formData = new FormData(this);
        formData.append('op', 'guardar');
        formData.append('cedula', $('#cedula').val());

        // Mostrar los datos de FormData en la consola para depuración
        console.log("FormData creado:");
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        // Enviar la solicitud AJAX
        $.ajax({
            url: '../controllers/BlogsController.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("AJAX Response:", response);
                try {
                    // Intentar parsear la respuesta JSON
                    const jsonResponse = JSON.parse(response);
                    if (jsonResponse.exitoFormulario) {
                        // Mostrar mensaje de éxito y ocultar modal
                        $('#response').html('<div class="alert alert-success">' + jsonResponse.message + '</div>');
                        $('#crearPublicacionModal').modal('hide');
                    } else {
                        // Mostrar mensaje de error
                        $('#response').html('<div class="alert alert-danger">' + jsonResponse.message + '</div>');
                        console.log("Error al crear la publicación");
                    }
                } catch (e) {
                    // Manejar errores de parseo JSON
                    console.error("Error al parsear la respuesta JSON:", e);
                    $('#response').html('<div class="alert alert-danger">Error al procesar la respuesta del servidor.</div>');
                }
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error("Error en la solicitud AJAX:", xhr.responseText);
                $('#response').html('<div class="alert alert-danger">Ocurrió un error al crear la publicación.</div>');
            }
        });
    });

    $('#abirModal').on('click', function() {
        console.log("Modal abierto"); 
        var myModal = new bootstrap.Modal(document.getElementById('crearPublicacionModal'));
        myModal.show();
    });

    $('#customFile1').on('change', function(event) {
        displaySelectedImage(event, 'selectedImage');
    });

    function displaySelectedImage(event, elementId) {
        const selectedImage = document.getElementById(elementId);
        const fileInput = event.target;

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                selectedImage.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        } else {
            selectedImage.src = 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg';
        }
    }
});
