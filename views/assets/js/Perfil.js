$(document).ready(function () {
    let perfil = {};
    let cedula = $('#cedula').val();

    function cargarPerfil() {
        $.ajax({
            url: '../controllers/PerfilController.php',
            type: 'POST',
            data: { op: 'mostrarPerfil', cedula: cedula },
            success: function(response) {
                console.log("Respuesta recibida del servidor:", response);
                
                perfil = JSON.parse(response);
                const container = $('#datosPerfil');
                container.empty();

                if (Array.isArray(perfil)) { 
                    perfil.forEach(function(perfilD) {
                        console.log("JSON parseado:", perfil);

                        // Estructura los datos del perfil
                        let datosPerfil_card = `
                        <div class="text-center">
                            <img src="${perfilD.img}" class="img-fluid avatar-xxl rounded-circle" alt="">
                            <br>
                            <h5 class="font-size-13 mb-2">${perfilD.nombre_usuario}</h5>
                        </div>
                        <h4 class="card-title mb-2 text-center">${perfilD.nombre} ${perfilD.primer_apellido} ${perfilD.segundo_apellido}</h4>
                        <div class="row my-4">
                            <div class="col-12 d-flex justify-content-between">
                                <p class="text-muted mb-2 fw-medium">Se unió el: ${perfilD.fecha_creacion}</p>
                                <p class="text-muted fw-medium mb-2">Fecha Nacimiento: ${perfilD.fecha_nacimiento}</p>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <p class="text-muted fw-medium mb-2">Género: ${perfilD.genero}</p>
                                <p class="text-muted fw-medium mb-2">Teléfono: ${perfilD.telefono}</p>
                            </div>

                            <div class="col-md-6">
                                <p class="text-muted fw-medium mb-2">Correo: ${perfilD.correo}</p>
                            </div>
                        </div>
                        `;
                        container.append(datosPerfil_card);
                    });
                } else {
                    container.html('<p>ALGO SALIO TERRIBLEMENTE MAL</p>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
    }

    cargarPerfil();

    $('#editarBtn').on('click', function(e) {
        console.log("Se abrió el modal");
        console.log(perfil);
        const containerModal = $('#datosPerfilModal');
        containerModal.empty();

        const datosPerfil = perfil[0];

        containerModal.append(`
            <div class="row mb-3">
                <div class="col">
                    <input hidden name="cedula" value="${datosPerfil.cedula}">
                    <label for="nombre" class="col-form-label">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" value="${datosPerfil.nombre}" id="nombre">
                </div>
                <div class="col">
                    <label for="primer-apellido" class="col-form-label">Primer Apellido:</label>
                    <input type="text" name="primerApellido" class="form-control" value="${datosPerfil.primer_apellido}" id="primer-apellido">
                </div>
                <div class="col">
                    <label for="segundo-apellido" class="col-form-label">Segundo Apellido:</label>
                    <input type="text" name="segundoApellido" class="form-control" value="${datosPerfil.segundo_apellido}" id="segundo-apellido">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="telefono" class="col-form-label">Teléfono:</label>
                    <input type="text" name="telefono" class="form-control" value="${datosPerfil.telefono}" id="telefono">
                </div>
                <div class="col">
                    <label for="correo" class="col-form-label">Correo:</label>
                    <input type="email" name="correo" class="form-control" value="${datosPerfil.correo}" id="correo">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="fecha-nacimiento" class="col-form-label">Fecha de Nacimiento:</label>
                    <input type="date" name="fechaNacimiento" class="form-control" value="${datosPerfil.fecha_nacimiento}" id="fecha-nacimiento">
                </div>
                <div class="col">
                    <label for="genero" class="col-form-label">Género:</label>
                    <select name="genero" class="form-control" id="genero">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="otro">Prefiero no decir</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="contrasena-nueva" class="col-form-label">Nombre de Usuario:</label>
                    <input type="password" name="nombreUsuario" class="form-control" id="contrasena-nueva">
                </div>
            </div>`
        );

        // Asignamos el valor del dropdown de género
        $('#genero').val(datosPerfil.genero);
    });

    $('#editarPerfilForm').on('submit', function(e) {
        e.preventDefault();
        $('#editarPerfilModal').modal('hide');

        const formData = new FormData(this);

        // Agrega la imagen solo si se ha seleccionado una nueva imagen
        if ($('#customFile2')[0].files.length > 0) {
            formData.append('img', $('#customFile2')[0].files[0]);
        }

        formData.append('op', 'actualizarPerfil');

        $.ajax({
            url: '../controllers/perfilController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                console.log("Se guardaron los datos");
                console.log(data);
                cargarPerfil();
            },
            error: function(error) {
                console.log('Error en la solicitud AJAX:', error);
            }
        });
    });
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
    }
}
