// Define cargarPublicacionesSinCampania in a common scope
function cargarPublicacionesSinCampania() {
    $.ajax({
        url: '../controllers/PublicacionController.php',
        type: 'POST',
        data: { op: 'mostrarPublicaciones', cedula: $('#cedula').val() }, // Enviar cedula junto con la solicitud
        success: function(response) {
            let publicaciones = JSON.parse(response); //Parsea el JSON
            let container = $('#publicacionesContainer'); //Carga el container en una variable 
            container.empty();  //Elimina todo lo del container para asegurarse de que no haya nada adentro

            if (Array.isArray(publicaciones)) { //Verifica que si es un array ya que se hizo un parse
                publicaciones.forEach(function(publicacion) { //Por cada publicacion carga un card
                    let imgHtml = publicacion.img ? `<img src="../views/assets/img_app/publicaciones/${publicacion.img}" class="card-img-top border-top border-bottom border-black" alt="${publicacion.titulo}">` : '';
                    
                    // Determinar el estado del like
                    let likeClase = publicacion.tieneLike ? 'fa-solid' : 'fa-regular';
                    let likeColor = publicacion.tieneLike ? 'red' : '';

                    //Estructura del card para la publicacion cargado dinamicamente
                    let publicacion_card = `
                        <div class="card" style="width: 50rem;">
                            <div class="container publicacion">
                                <div class="row perfil-barra">
                                    <div class="col-auto d-flex align-items-center perfil-usuario">
                                        <i class="fa-solid fa-user fa-lg" style="color: #000000;"></i>
                                        <h5 class="mb-0 ml-3 pl-2">&nbsp; ${publicacion.nombre_usuario}  </h5> <!--/ ${publicacion.id_campania}-->
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
                            ${imgHtml}
                            <div class="card-body position-relative">
                                <div class="col-auto d-flex align-items-center likes position-relative" style="z-index: 2;">
                                    <i class="fa-heart fa-lg ${likeClase}" data-id="${publicacion.id_publicacion}" style="color: ${likeColor};"></i>
                                    <h5 class="mb-0 ml-3 pl-2 perfil-usuario">&nbsp; ${publicacion.num_like} &nbsp;</h5>
                                    <a href="./paginaPublicacion.php?id=${publicacion.id_publicacion}">
                                        <i class="fa-regular fa-comment fa-lg" data-id="${publicacion.id_publicacion}"></i>
                                    </a>
                                </div>
                                <h5 class="card-title">${publicacion.titulo}</h5>
                                <p class="card-text">${publicacion.descripcion}</p>
                            </div>
                        </div>
                    `;
                    //Agrega la card al contendor para cargarlo dinamicamente
                    container.append(publicacion_card);
                });
            } else {
                container.html('<p>No se encontraron publicaciones.</p>');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
        }
    });
    $(document).ready(function () {
        $('#publicacionesContainer').on('click', '.fa-comment', function () {
            let idPublicacion = $(this).data('id');
            if (idPublicacion) {
                sessionStorage.setItem('publicacionID', idPublicacion);
                window.location.href = './paginaPublicacion.php';
            }
        });
    });
}

$(document).ready(function () {
    let cedula = $('#cedula').val(); //Carga la cedula

    //Carga las publicaciones 
    cargarPublicacionesSinCampania();

    // Manejar el click en el icono de like
    $('#publicacionesContainer').on('click', '.fa-heart', function () {
        let iconoLike = $(this); 
        let idPublicacion = iconoLike.data('id'); //Id de la publicacion

        let op = iconoLike.hasClass('fa-solid') ? 'reducirLike' : 'aumentarLike'; //Verifica si el icono del like tiene la clase fa-solid / esto es para verificar si ya tiene like o no

        $.ajax({
            url: '../controllers/PublicacionController.php',
            type: 'POST',
            data: {
                op: op,
                id_publicacion: idPublicacion,
                cedula: cedula
            },
            success: function(response) {
                try {
                    const jsonResponse = JSON.parse(response); //Parse el JSON
                    if (jsonResponse.success) { //Si todo salio bien 
                        let currentLikes = parseInt(iconoLike.next('h5').text().trim()); // obtener el número de likes actual
                        if (op === 'aumentarLike') { //Si la op que se quiere hacer es aumentar like 
                            iconoLike.addClass('fa-solid').removeClass('fa-regular').css('color', 'red'); //Se pone de color rojo y se llena
                            iconoLike.next('h5').html(`&nbsp; ${currentLikes + 1} &nbsp;`); //Y se aumenta en LO ESCRITO un 1
                        } else {
                            iconoLike.addClass('fa-regular').removeClass('fa-solid').css('color', '');
                            iconoLike.next('h5').html(`&nbsp; ${currentLikes - 1} &nbsp;`);//Y le quita en LO ESCRITO un 1
                        }
                    } else {
                        console.log("Error al modificar el número de likes:", jsonResponse.error);
                    }
                } catch (e) {
                    console.log("Error al parsear la respuesta JSON:", e);
                }
            },
            error: function(err) {
                console.log("Error en la solicitud AJAX:", err);
            }
        });
    });
});

$(document).ready(function () {
    let cedula = $('#cedula').val();    
    $('#crearPublicacionForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData($(this)[0]);
        formData.append('op', 'guardar'); 
        formData.append('cedula', cedula);
        formData.forEach(function(value, key){
            console.log(key + ': ' + value);
        });
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
});

$('#crearPublicacionModal').on('hidden.bs.modal', function () {
        cargarPublicacionesSinCampania();
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
        selectedImage.src = 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg'; // Resetea la imagen si no hay archivo seleccionado
    }
}
//linea para resolver conflictos :)