<div class="container-fluid d-flex flex-column">
    <div class="row flex-grow-1 m-0">
        <!-- aside -->
        <div class="col-md-3 p-0">
            <div class="d-flex flex-column bg-body-tertiary h-100">
                <!-- SECCIÓN DE CHATS -->
                <h3 class="text-center my-0 py-3">Chats</h3>
                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-success my-1" data-bs-toggle="modal"
                    data-bs-target="#usernameModal">
                    Agregar Usuario
                </button>
                <hr class="my-0">
                <ul class="nav nav-pills flex-column mb-auto">
                    <!-- Dentro del bucle que genera la lista de usuarios -->
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-usuario="Usuario 1" data-imagen="https://github.com/mdo.png">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                class="rounded-circle me-2">
                            <strong>Usuario 1</strong>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-usuario="Usuario 2" data-imagen="https://github.com/mdo.png">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                class="rounded-circle me-2">
                            <strong>Usuario 2</strong>
                        </a>
                    </li>
                    <hr>
                    <!-- SECCION DE GRUPOS-->
                    <h3 class="text-center">Grupos</h3>
                    <!-- Botón para abrir el modal -->
                    <button type="button" class="btn btn-success my-1" data-bs-toggle="modal"
                        data-bs-target="#grupoModal">
                        Agregar Grupo
                    </button>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <!-- Dentro del bucle que genera la lista de grupos -->
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-usuario="Grupo 1"
                                data-imagen="https://github.com/mdo.png">
                                <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                    class="rounded-circle me-2">
                                <strong>Grupo 1</strong>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-usuario="Grupo 2"
                                data-imagen="https://github.com/mdo.png">
                                <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                    class="rounded-circle me-2">
                                <strong>Grupo 2</strong>
                            </a>
                        </li>
                    </ul>
            </div>
        </div>

        <!-- MENSAJERÍA -->
        <div class="col-md-9 d-flex flex-column p-0">
            <!-- HEADER -->
            <header>
                <nav class="navbar w-100 m-0 p-3">
                    <div class="container-fluid d-flex align-items-center">
                        <div id="usuarioActual">
                            <img src="./assets/img/logoFondo.jpg" alt="" width="32" height="32"
                                class="rounded-circle me-2">
                            <strong class="text-white">¡Bienvenido a la mensajería!</strong>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- MODAL IMAGEN -->
            <div class="modal fade" id="cargarModal" tabindex="-1" role="dialog" aria-labelledby="cargarModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cargarModalLabel">Subir Imagen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="upload.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Seleccione una imagen para subir</label>
                                    <input class="form-control form-control-sm" id="formFileSm" type="file"
                                        name="image">
                                </div>
                                <button type="submit" class="btn btn-success">Subir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- MENSAJES -->
            <div class="flex-grow-1 overflow-auto p-3" id="chatContainer">
                <!-- aquí mete los mensjes el js -->
            </div>

            <!-- INPUT -->
            <div class="mt-auto mx-1 w-99 mb-3" id="enviarMensaje">
                <form id="enviarMsj" action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" id="mensaje" placeholder="Escribe tu mensaje aquí..."
                            disabled>
                        <button type="submit" class="btn ms-2" id="btnEnviar" disabled>Enviar</button>
                        <button type="button" class="btn mx-1" id="btnImg" data-bs-toggle="modal"
                            data-bs-target="#cargarModal">
                            <img src="https://www.pngkey.com/png/full/50-505769_gallery-gallery-white-icon-png.png"
                                alt="" style="width: 25px; height: 20px;">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal de Agregar Usuario -->
<div class="modal fade" id="usernameModal" tabindex="-1" aria-labelledby="usernameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="usernameModalLabel">Chatea con un usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="username" class="col-form-label">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="username">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Agregar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Agregar Grupo  (VER CÓMO PASAR LOS USUARIOS)-->
<div class="modal fade" id="grupoModal" tabindex="-1" aria-labelledby="grupoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="grupoModalLabel">Crea un grupo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <label for="nombreGrupo" class="col-form-label">Nombre del grupo:</label>
                    <input type="text" class="form-control" id="nombreGrupo">
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-success my-2">Agregar</button>
            </div>
        </div>
    </div>
</div>
</div>