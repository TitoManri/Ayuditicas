<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajería</title>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/mensajeria.css">
</head>

<body>
    <div class="container-fluid d-flex flex-column">
        <div class="row flex-grow-1 m-0">
            <!-- aside -->
            <div class="col-md-3 p-0">
                <div class="d-flex flex-column bg-body-tertiary h-100">
                    <!-- SECCIÓN DE CHATS -->
                    <h3 class="text-center my-0 py-3">Chats</h3>
                    <button type="button" id="iniciarChat" class="btn my-1">Iniciar chat</button>
                    <hr class="my-0">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <!-- Dentro del bucle que genera la lista de usuarios -->
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-usuario="Usuario 1"
                                data-imagen="https://github.com/mdo.png">
                                <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                    class="rounded-circle me-2">
                                <strong>Usuario 1</strong>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-usuario="Usuario 2"
                                data-imagen="https://github.com/mdo.png">
                                <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                    class="rounded-circle me-2">
                                <strong>Usuario 2</strong>
                            </a>
                        </li>
                        <hr>
                        <!-- SECCION DE GRUPOS-->
                        <h3 class="text-center">Grupos</h3>
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
                                <img src="./assets/img/logoAyuditicas.png" alt="" width="32" height="32"
                                    class="rounded-circle me-2">
                                <strong>¡Bienvenido a la mensajería!</strong>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="upload.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="formFileSm" class="form-label">Seleccione una imagen para
                                            subir</label>
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
                    <!-- los mensajes van acá -->
                </div>

                <!-- INPUT -->
                <div class="mt-auto mx-1 w-99 mb-3" id="enviarMensaje">
                    <form id="enviarMsj" action="" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" id="mensaje"
                                placeholder="Escribe tu mensaje aquí..." disabled>
                            <button type="submit" class="btn ms-2" id="btnEnviar" disabled>Enviar</button>
                            <button type="button" class="btn mx-1" data-bs-toggle="modal" data-bs-target="#cargarModal">
                                <img src="https://www.pngkey.com/png/full/50-505769_gallery-gallery-white-icon-png.png"
                                    alt="" style="width: 25px; height: 20px;">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/mensajeria.js"></script>

</html>