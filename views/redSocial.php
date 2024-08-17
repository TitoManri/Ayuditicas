<?php
session_start();
$cedula = $_SESSION['cedula'];
$nombre = $_SESSION['nombre'];
$primerApellido = $_SESSION['primerApellido'];
$segundoApellido = $_SESSION['segundoApellido'];
$genero = $_SESSION['genero'];
$fechaNacimiento = $_SESSION['fechaNacimiento'];
$nombreUsuario = $_SESSION['nombreUsuario'];
$telefono = $_SESSION['telefono'];
$correo = $_SESSION['correo'];
$numSeguidores = $_SESSION['numSeguidores'];
$img = $_SESSION['img'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/mainpage.css">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/Etiquetas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.4/tagify.min.css" rel="stylesheet">
</head>

<body>
    <header class="mainHeader">
        <?php 
            $activoPaginaP = 'active';
            include './templates/Header&Footer/header.php'; 
            ?>
        
    </header>
    <?php 
            $activoPaginaP = 'active';
            $nombrePagina = 'Red Social';
            include './templates/Header&Footer/subheader.php'; 
            
    ?>
            <div class="col-9">
            <div class="">
                <nav id="SubHeader" class="SubHeader centro ms-5">
                <button type="button" class="btn btn-light ms-5" data-bs-toggle="modal" data-bs-target="#crearPublicacionModal">
    <i class="fa-regular fa-pen-to-square"></i> Crear Publicación
</button>
                    <div class="input-group rounded barrabusqueda">
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" />
                        <span class="input-group-text border-0" id="search-addon">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
            </div>
        </div>
        </nav>
    </div>

    
    <div class="row row-personalizada">
        <div class="col-8">
            <section id="pagina-red-social">
                <div class="container-fluid">
                    <main>
                        <div class="d-flex flex-column align-items-center" style="padding-top: 10px;">
                            <div class="card" style="width: 50rem;">
                                <div class="container publicacion">
                                    <div class="row perfil-barra">
                                        <div class="col-12 d-flex align-items-center perfil-usuario">
                                            <h5 class="mb-0 ml-3 pl-2">&nbsp; Crear Publicacion</h5>
                                            <form class="form-inline">
                                                <input class="form-control ms-5" size="50" type="text"
                                                    placeholder="¿Quieres crear una publicacion?" id="abirModal" aria-label="Search">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="publicacionesContainer" class="d-flex flex-column align-items-center"></div>
                    </main>
                </div>
            </section>
        </div>

        <div class="col-4 ">
        <button onclick="topFunction()" id="myBtn"><i class="fa-solid fa-caret-up fa-2xl caret"></i></i></button>
        <?php include './templates/Red_Social/asideDerecha.php'; ?>
    </div>
    </div>

    <?php include './templates/Red_Social/modalReporte.php'; ?>
    <div class="modal fade" id="crearPublicacionModal" aria-hidden="true" aria-labelledby="crearPublicacionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Crear la Publicación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="crearPublicacionForm">
                <input type="hidden" id="cedula" value="<?php echo $cedula ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tituloPublicacion" class="form-label">Título de la Publicación</label>
                                <input type="text" class="form-control w-100" id="tituloPublicacion" placeholder="Título de la Publicación" required name="titulo">
                            </div>
                            <div class="mb-3">
                                <label for="descripcionPublicacion" class="form-label">Descripción de la Publicación</label>
                                <textarea class="form-control w-100" id="descripcionPublicacion" rows="5" style="resize: none;" required name="descripcion"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="descripcionPublicacion" class="form-label">¿Esta publicación es para alguna campaña? </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" checked>
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                            </div>
                            <div id="comunidadSection" class="mb-3" style="display: none;">
                                <label for="descripcionPublicacion" class="form-label">¿Cuál?</label>
                                <select class="form-select" aria-label="Default select example" name="campaniaSeleccionada">
                                    <option selected>Campañas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="descripcionPublicacion" class="form-label">Etiquetas (Max.3)</label>
                                <input type="text" id="tags" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnNext" type="submit">Crear Publicación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>


<br><br>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.4/tagify.min.js"></script>
    <script src="./assets/js/like.js"></script>
    <script src="./assets/js/publicaciones.js"></script>
    <script src="./assets/js/botonTop.js"></script>
</body>

</html>