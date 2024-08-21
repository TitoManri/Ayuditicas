<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajería</title>
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/msj.css">
</head>

<body>
    <header class="mainHeader">
        <!-- Source: https://stackoverflow.com/questions/30038275/change-a-div-in-php-include-->

        <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-custom ">
            <div class="container-fluid">
                <!-- Navbar Izquierda -->
                <a class="navbar-brand" href="./index.php">
                    <img src="./assets/img/logoAyuditicas_Verde.png" width="55px" alt="Logo_Ayuditicas">
                </a>
                <a class="navbar-brand ayuditicaHeader" href="./index.php">AYUDITICAS</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Centro -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./redSocial.php"><i class="fa fa-solid fa-house fa-2xl"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./camps.php"><i class="fa fa-solid fa-people-roof fa-2xl"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./mensajeria.php"><i class="fa fa-solid fa-comment fa-2xl" style="color:white"></i></a>
                        </li>
                    </ul>
                </div>

                <!-- Navbar Derecha -->
                <ul class="navbar-nav">
                    <!-- Perfil -->
                    <p class="ayuditicaHeader desconocido" href="">AYUDITICAS</p>
                    <li class="nav-item dropdown ">
                        <a class="nav-link icons" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static"
                            aria-expanded="false">
                            <i class="fa fa-solid fa-user fa-2xl"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item" href="./perfil.php"><i class="fa-solid fa-user"
                                        style="color: #000000;"></i> Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./crearCamp.php"><i class="fa fa-solid fa-people-roof"
                                        style="color: #000000;"></i> Crear Campaña</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./verSolicitudesCampanias.php"><i class="fa fa-solid fa-people-roof"
                                        style="color: #000000;"></i> Ver solicitudes de campañas</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./cerrarSesion.php"><i class="fa-solid fa-arrow-right-from-bracket"
                                        style="color: #000000;"></i> Cerrar sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            </div>
        </nav>
    </header>

    <?php
    echo "<div id='usuarioActual' data-usuario='" . $_SESSION['nombreUsuario'] . "' data-img='" . $_SESSION['img'] . "' data-ced='" . $_SESSION['cedula'] . "'></div>";
    ?>

    <div class="container-fluid d-flex flex-column" id="contenedor">
        <div class="row flex-grow-1 m-0">
            <!-- aside -->
            <div class="col-md-3 p-0" id="aside">
                <div class="d-flex flex-column bg-body-tertiary h-100">
                    <!-- SECCIÓN DE CHATS -->
                    <h3 class="text-center my-0 py-3">Chats</h3>
                    <!-- Botón para abrir el modal -->
                    <button type="button" class="btn btn-success my-1" data-bs-toggle="modal"
                        data-bs-target="#usernameModal">
                        Agregar Usuario
                    </button>
                    <ul id="listaUsuarios" class="nav nav-pills flex-column mb-auto">
                        <!-- Dentro del bucle que genera la lista de usuarios -->
                    </ul>
                </div>
            </div>

            <!-- MENSAJERÍA -->
            <div class="col-md-9 d-flex flex-column p-0">
                <!-- HEADER -->
                <header id="msjHeader">
                    <nav class="navbar w-100 m-0 p-3">
                        <div class="container-fluid d-flex align-items-center">
                            <div id="chatActual">
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- form de imagen-->
                                <form id="imgForm" action="./controllers/mensajeController?op=enviarMensaje"
                                    method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="imagen" class="form-label">Seleccione una imagen para
                                            subir</label>
                                        <!-- imagen -->
                                        <input class="form-control form-control-sm" id="imagen" type="file"
                                            name="imagen">
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
                    <!-- enviarMensaje form-->
                    <form id="enviarMsj" action="" method="post">
                        <div class="input-group">
                            <!-- Mensaje-->
                            <input type="text" class="form-control" id="mensaje" name="txtMensaje"
                                placeholder="Escribe tu mensaje aquí..." disabled>
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
                    <!-- agregar usuario fromulario-->
                    <form id="agrUsuario" action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="col-form-label">Nombre de usuario:</label>
                            <!-- username-->
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btnAgrUsuario" type="button" class="btn btn-success">Agregar</button>
                </div>
            </div>
        </div>
    </div>

    </div>
    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php';
        ?>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js"></script>
<script src="./assets/js/mensajeria.js"></script>

</html>