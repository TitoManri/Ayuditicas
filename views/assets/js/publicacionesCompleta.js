$(document).ready(function () {
    let idPublicacion = sessionStorage.getItem('publicacionID');    
    if (idPublicacion) {
        $.ajax({
            url: '../controllers/PublicacionController.php',
            type: 'POST',
            data: { op: 'obtenerPublicacion', id_publicacion: idPublicacion },
            success: function(response) {
                let publicacion = JSON.parse(response);
                if (publicacion) {
                    let imgHtml = publicacion.img ? `<img src="../views/assets/img_app/publicaciones/${publicacion.img}" class="card-img-top border-top border-bottom border-black imagen-publicacion" alt="${publicacion.titulo}">` : '';

                    let likeClase = publicacion.tieneLike ? 'fa-solid' : 'fa-regular';
                    let likeColor = publicacion.tieneLike ? 'red' : '';

                    let publicacionHtml = `
                    <div class="card" style="width: 50rem;">
                    <div class="container publicacion">
                        <div class="row perfil-barra">
                            <div class="col-auto d-flex align-items-center perfil-usuario">
                                <i class="fa-solid fa-user fa-lg" style="color: #000000;"></i>
                                <h5 class="mb-0 ml-3 pl-2">&nbsp; ${publicacion.nombre_usuario}  </h5>
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
                            <i class="fa-heart fa-lg ${likeClase}" data-id="${publicacion.id_publicacion}" style="color: ${likeColor};" ></i>
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

                    $('#publicacion-detalle').html(publicacionHtml);
                    cargarComentarios(idPublicacion);

                } else {
                    $('#publicacion-detalle').html('<p>No se encontró la publicación.</p>');
                }                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
    } else {
        $('#publicacion-detalle').html('<p>No se encontró el ID de la publicación.</p>');
    }

    // Función para cargar comentarios
    function cargarComentarios(idPublicacion) {
        $.ajax({
            url: '../controllers/ComentariosController.php', 
            type: 'POST',
            data: { op: 'mostrarComentariosPorPublicacion', id_publicacion: idPublicacion },
            success: function(response) {
                let comentarios = JSON.parse(response);
                let container = $('#comentariosContainer');
                container.empty(); 

                if (Array.isArray(comentarios)) {
                    comentarios.forEach(function(comentario) {
                        let comentarioHtml = `
                            <div class="comentario">
                                <p><strong>${comentario.nombre_usuario}:</strong> ${comentario.contenido}</p>
                            </div>
                        `;
                        container.append(comentarioHtml);
                    });
                } else {
                    container.html('<p>No se encontraron comentarios.</p>');
                }
            },
            error: function(err) {
                console.log("Error en la solicitud AJAX:", err);
            }
        });
    }

    $('#formComentario').on('submit', function(e) {

        e.preventDefault();
        let nuevoComentario = $('#nuevoComentario').val();
        let cedula = $('#cedula').val();

        if (nuevoComentario.trim() !== '') {
            $.ajax({
                url: '../controllers/ComentariosController.php', 
                type: 'POST',
                data: {
                    op: 'guardar',
                    id_publicacion: idPublicacion,
                    contenido: nuevoComentario,
                    cedula: cedula
                },
                success: function(response) {
                    let result = JSON.parse(response);
                    if (result.exitoFormulario) {
                        $('#nuevoComentario').val(''); 
                        cargarComentarios(idPublicacion);
                    } else {
                        console.error('Error:', result.message);
                    }
                },
                error: function(err) {
                    console.log("Error en la solicitud AJAX:", err);
                }
            });
        }
    });
});