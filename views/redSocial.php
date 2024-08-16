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
                                            <i class="fa-solid fa-user fa-lg " style="color: #000000;"></i>
                                            <h5 class="mb-0 ml-3 pl-2">&nbsp; Crear Publicacion</h5>
                                            <form class="form-inline">
                                                <input class="form-control ms-5" size="50" type="search"
                                                    placeholder="¿Quieres crear una publicacion?" aria-label="Search">
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php for ($i = 0; $i < 5; $i++) {
                        include './templates/Red_Social/publicacion.php';?><br><?php 
                    } ?>
                        </div>
                    </main>
                </div>
            </section>
        </div>

        <div class="col-4 ">
        <?php include './templates/Red_Social/asideDerecha.php'; ?>
    </div>
    </div>

    <?php include './templates/Red_Social/modalReporte.php'; ?>
    <?php include './templates/Red_Social/crearPublicacionModal.php'; ?>


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
    <script src="./assets/js/crearPublicacionModal.js"></script>
</body>

</html>