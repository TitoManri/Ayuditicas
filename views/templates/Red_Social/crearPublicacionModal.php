<div class="modal fade" id="crearPublicacionModal" aria-hidden="true" aria-labelledby="crearPublicacionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Crear la Publicacion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Titulo de la Publicación</label>
                    <input type="text" class="form-control w-100" id="exampleFormControlInput1" placeholder="Titulo de la Publicación">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripción de la Publicación</label>
                    <textarea class="form-control w-100" id="exampleFormControlTextarea1" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#crearPublicacionModal2" data-bs-toggle="modal">Siguiente</button>
            </div>
            <div class="carousel-indicators">
                <div class="carousel-indicator active" data-target="#crearPublicacionModal"></div>
                <div class="carousel-indicator" data-target="#crearPublicacionModal2"></div>
                <div class="carousel-indicator" data-target="#crearPublicacionModal3"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="crearPublicacionModal2" aria-hidden="true" aria-labelledby="crearPublicacionModal2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="crearPublicacionModalLabel2">Imagen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="mb-4 d-flex justify-content-center">
                        <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder" style="width: 300px;" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                            <label class="form-label text-white m-1" for="customFile1">Choose file</label>
                            <input type="file" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage')" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#crearPublicacionModal" data-bs-toggle="modal">Atras</button>
                <button class="btn btn-primary" data-bs-target="#crearPublicacionModal3" data-bs-toggle="modal">Siguiente</button>
            </div>
            <div class="carousel-indicators">
                <div class="carousel-indicator" data-target="#crearPublicacionModal"></div>
                <div class="carousel-indicator active" data-target="#crearPublicacionModal2"></div>
                <div class="carousel-indicator" data-target="#crearPublicacionModal3"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="crearPublicacionModal3" aria-hidden="true" aria-labelledby="crearPublicacionModal3" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="crearPublicacionModalLabel3">Vista Previa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card w-100">
                    <div class="container publicacion">
                        <div class="row perfil-barra">
                            <div class="col-auto d-flex align-items-center perfil-usuario">
                                <i class="fa-solid fa-user fa-lg " style="color: #000000;"></i>
                                <h5 class="mb-0 ml-3 pl-2">&nbsp; Juan Alcachofa</h5>
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
                    <img src="https://www.nestleagustoconlavida.com/sites/default/files/2022-04/manos-sembrando.jpg" class="card-img-top" alt="...">
                    <div class="card-body position-relative">
                        <div class="col-auto d-flex align-items-center likes position-relative" style="z-index: 2;">
                            <i class="fa-regular fa-heart fa-lg heart-icon "></i>
                            <h5 class="mb-0 ml-3 pl-2 perfil-usuario">&nbsp; 0 &nbsp;</h5>
                            <i class="fa-regular fa-comments"></i>
                        </div>
                        <h5 class="card-title">Tratamos de Ayudar al medio ambiente, tambien puedes hacerlo!</h5>
                        <a href="../../../../../SC502_2C2024_M_G3/views/paginaPublicacion.php" class="stretched-link position-absolute" style="top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#crearPublicacionModal2" data-bs-toggle="modal">Atras</button>
                <button class="btn btn-primary" data-bs-target="#crearPublicacionModal3" data-bs-toggle="modal">Completar</button>
            </div>
            <div class="carousel-indicators">
                <div class="carousel-indicator" data-target="#crearPublicacionModal"></div>
                <div class="carousel-indicator" data-target="#crearPublicacionModal2"></div>
                <div class="carousel-indicator active" data-target="#crearPublicacionModal3"></div>
            </div>
        </div>
    </div>
</div>
