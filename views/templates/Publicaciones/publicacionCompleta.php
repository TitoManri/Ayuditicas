<div class="container contenedor-publicacion">
    <div class="row">
        <div class="col-md-8">
            <!-- Contenido Principal de la Publicación -->
            <div class="encabezado-publicacion">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-user fa-lg"></i>
                        <h5 class="mb-0 ml-3">&nbsp;Manrique Carazo</h5>
                    </div>
                    <div class="likes d-flex align-items-center mt-2">
                        <i class="fa-regular fa-heart fa-lg heart-icon"></i>
                        <span class="ml-2">&nbsp;10 likes</span>
                    </div>
                </div>
            </div>
            <div class="contenido-publicacion">
                <img src="https://www.nestleagustoconlavida.com/sites/default/files/2022-04/manos-sembrando.jpg"
                    class="imagen-publicacion" alt="publicacionImagen">
                <h5 class="mt-3">Tratamos de Ayudar al medio ambiente, tambien puedes hacerlo! </h5>
            </div>
        </div>
        <div class="col-md-4 caja-comentarios">
            <div class="encabezado-publicacion-comentarios">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="">Comentarios</h5>
                    <div class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static"
                            aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-report">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reportar" href="#"><i
                                        class="fa-regular fa-flag"></i> Reportar </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="caja-enviar-mensaje">
                <div class="no-commentarios" id="no-commentarios">No hay comentarios aún.</div>
                <ul id="commentarios-lista" class="list-unstyled mt-2"></ul>
            </div>
            <div class="nuevo-comentario mt-2">
                <textarea id="nuevo-comentario-text" class="form-control" rows="2" placeholder="Escribe un comentario..."></textarea>
            </div>
        </div>
    </div>
</div>
