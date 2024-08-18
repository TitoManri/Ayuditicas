$(document).ready(function () {
    let idPublicacion = $('#idPublicacion').val();

    // Cargar los detalles de la publicación
    $.ajax({
        url: '../controllers/PublicacionController.php',
        type: 'POST',
        data: { op: 'obtenerPublicacion', id_publicacion: idPublicacion },
        success: function(response) {
            let publicacion = JSON.parse(response);
            if (publicacion) {
                let imgHtml = publicacion.img ? `<img src="../views/assets/img_app/publicaciones/${publicacion.img}" class="imagen-publicacion" alt="${publicacion.titulo}">` : '';

                let likeClase = publicacion.tieneLike ? 'fa-solid' : 'fa-regular';
                let likeColor = publicacion.tieneLike ? 'red' : '';

                let publicacionHtml = `
                    <div class="col-md-8">
                        <div class="encabezado-publicacion">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-user fa-lg" style="color:black;"></i>
                                    <h5 class="mb-0 ml-3 text-dark">&nbsp; ${publicacion.nombre_usuario}</h5>
                                </div>
                                <div class="likes d-flex align-items-center mt-2">
                                    <i class="fa-heart fa-lg ${likeClase}" style="color: ${likeColor};" data-id="${publicacion.id_publicacion}"></i>
                                    <span class="ml-2 text-dark">&nbsp; ${publicacion.num_like} likes</span>
                                </div>
                            </div>
                        </div>
                        <div class="contenido-publicacion">
                            ${imgHtml}
                            <h5 class="mt-3 text-dark">${publicacion.titulo}</h5>
                            <p class="card-text">${publicacion.descripcion}</p>
                        </div>
                    </div>
                    <div class="col-md-4 caja-comentarios">
                        <div class="encabezado-publicacion-comentarios">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="text-dark">Comentarios</h5>
                            </div>
                        </div>
                        <div class="caja-enviar-mensaje">
                            <div class="no-commentarios" id="no-commentarios">No hay comentarios aún.</div>
                            <ul id="comentarios-lista" class="list-unstyled mt-2"></ul>
                        </div>
                        <div class="nuevo-comentario mt-2">
                            <textarea id="nuevo-comentario-text" class="form-control" rows="2" placeholder="Escribe un comentario..."></textarea>
                            <button id="enviar-comentario" class="btn btn-primary mt-2">Enviar</button>
                        </div>
                    </div>
                `;

                $('#publicacion-detalle').html(publicacionHtml);

            } else {
                $('#publicacion-detalle').html('<p>No se encontró la publicación.</p>');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
        }
    });
});


