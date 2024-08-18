$(document).ready(function () {
    let cedula = $('#cedula').val(); //Carga la cedula

        $.ajax({
            url: '../controllers/PerfilController.php',
            type: 'POST',
            data: { op: 'cambiarDatos', cedula: cedula },
            success: function(response) {
                let perfil = JSON.parse(response);
                let container = $('#datosPerfil');
                container.empty();
                
                if (Array.isArray(publicaciones)) { 
                    publicaciones.forEach(function(publicacion) {
                        //Estructura del card para la publicacion cargado dinamicamente
                        let datosPerfil = `
                            <div class="ms-3">
                                <h4 class="card-title mb-2 text-center">Nombre Apellido Apellido</h4>
                                <div class="row my-4">
                                    <div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <p class="text-muted mb-2 fw-medium">Se unió el: ${perfil.FechaUnionPDO}</p>
                                            <p class="text-muted fw-medium mb-2">Fecha Nacimiento: ${perfil.FechaNacimiento}</p>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <p class="text-muted fw-medium mb-2">Género: ${perfil.Genero}</p>
                                            <p class="text-muted fw-medium mb-2">Teléfono: ${perfil.Telefono}</p>
                                        </div>

                                        <div class="col-md-6">
                                            <p class="text-muted fw-medium mb-2">Correo: ${perfil.correo}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-muted fw-medium mb-2">Contraseña: ${perfil.contrasenia}</p>
                                        </div>
                                        <br>
                                        <button type="button" class="btn btn-success">Editar Perfil</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        //Agrega la card al contendor para cargarlo dinamicamente
                        container.append(datosPerfil);
                    });
                } else {
                    container.html('<p>No se encontraron publicaciones.</p>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
    }
);

$(document).ready(function() {
    $('#abrirModal').on('focus', function() {
        $('#createPostModal').modal('show');
    });
});