//Insercion de publicaciones
$(document).ready(function () {
    let cedula = $('#cedula').val();    

    $('#crearPublicacionForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData($(this)[0]);
        formData.append('op', 'guardar'); 
        formData.append('cedula', cedula);
        $.ajax({
            url: '../controllers/PublicacionController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log("AJAX Response:", response); 
                try {
                    const respuestaDeJSON = JSON.parse(response);
                    if (respuestaDeJSON.exitoFormulario) {
                        $('#response').html('<div class="alert alert-success">' + respuestaDeJSON.message + '</div>');
                        $('#crearPublicacionModal').modal('hide');
                    } else {
                        $('#response').html('<div class="alert alert-danger">' + respuestaDeJSON.message + '</div>');
                        console.log("Error al crear la publicación");
                    }
                } catch (e) {
                    console.log("Error al parsear la respuesta JSON:", e);
                }
            },
            error: function(err) {
                $('#response').html('<div class="alert alert-danger">Error al crear la publicación.</div>');
                console.log("Error en la solicitud AJAX:", err);
            }
        });
    });

    $('input[name="inlineRadioOptions"]').on('change', function() {
        if ($('#inlineRadio1').is(':checked')) {
            $('#comunidadSection').show();
        } else {
            $('#comunidadSection').hide();
        }
    });

    var input = document.getElementById('tags');
    var tagify = new Tagify(input, {
        maxTags: 3,
        delimiters: ",| ",  
        dropdown: {
            enabled: 0 
        }
    });

    input.addEventListener('keydown', function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            tagify.addTags(input.value.trim());
            input.value = '';
        }
    });

//Cargar las publicaciones en la pagina
    function cargarPublicacionesSinCampania() {
        $.ajax({
            url: '../controllers/PublicacionController.php', 
            type: 'POST',
            data: { op: 'mostrarPublicaciones' },
            success: function(response) {
                let publicaciones = JSON.parse(response);
                let container = $('#publicacionesContainer');
                container.empty(); 

                if (Array.isArray(publicaciones)) {
                    publicaciones.forEach(function(publicacion) {
                        // Verifica si la imagen está vacía o no
                        let imgHtml = publicacion.img ? `<img src="../views/assets/img_app/${publicacion.img}" class="card-img-top" alt="${publicacion.titulo}">` : '';

                        let card = `
                            <div class="card" style="width: 50rem;">
                                <div class="container publicacion">
                                    <div class="row perfil-barra">
                                        <div class="col-auto d-flex align-items-center perfil-usuario">
                                            <i class="fa-solid fa-user fa-lg" style="color: #000000;"></i>
                                            <h5 class="mb-0 ml-3 pl-2">&nbsp; ${publicacion.nombre_usuario} </h5>
                                        </div>
                                        <div class="col ml-auto d-flex justify-content-end align-items-center">
                                            <div class="nav-item dropdown">
                                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical fa-lg" style="color: #000000;"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-lg-end dropdown-report">
                                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reportar" href="#"><i class="fa-regular fa-flag"></i> Reportar </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${imgHtml} <!-- Imagen opcional -->
                                <div class="card-body position-relative">
                                    <div class="col-auto d-flex align-items-center likes position-relative" style="z-index: 2;">
                                        <i class="fa-regular fa-heart fa-lg heart-icon" data-id="${publicacion.id_publicacion}"></i>
                                        <h5 class="mb-0 ml-3 pl-2 perfil-usuario">&nbsp; ${publicacion.num_like} &nbsp;</h5>
                                        <i class="fa-regular fa-comments"></i>
                                    </div>
                                    <!--<h5 class="card-title">${publicacion.titulo}</h5>-->
                                    <p class="card-text">${publicacion.descripcion}</p>
                                    <a href="#" class="stretched-link position-absolute" style="top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></a>
                                </div>
                            </div>
                        `;
                        container.append(card);
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

    // Llamar a cargarPublicacionesSinCampania cuando el modal se cierra
    $('#crearPublicacionModal').on('hidden.bs.modal', function () {
        cargarPublicacionesSinCampania();
    });
    cargarPublicacionesSinCampania();
    $(document).on('click', '.heart-icon', function() {
        let $icon = $(this);

        if ($icon.hasClass('fa-solid fa-heart')) {
            $icon.removeClass('fa-solid fa-heart').addClass('fa-regular fa-heart');
        } else {
            $icon.removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart');
        }
    });
});
