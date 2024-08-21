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
    <title>Ver Blogs</title>
    <!-- Bootstrap & Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/Blogs.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.4/tagify.min.css" rel="stylesheet">
</head>

<body>
    <header class="mainHeader">
        <?php
        $activoBlogs = 'active';
        include './templates/Header&Footer/header3.php';
        ?>
    </header>
    <?php 
        $activoPaginaP = 'active';
        $nombrePagina = 'Blog';
        include './templates/Header&Footer/subheader.php'; 
    ?>
    <div class="col-9">
            <div class="">
                <nav id="SubHeader" class="SubHeader centro ms-5">
                <button type="button" id="abirModal" class="btn btn-light ms-5" data-bs-toggle="modal" data-bs-target="#crearPublicacionModal">
    <i class="fa-regular fa-pen-to-square"></i> Crear Blog
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
        <div class="col-12">
            <section id="pagina-red-social">
                <div class="container">
                    <main>
                        <div class="d-flex flex-column align-items-start" style="padding-top: 10px;">
                            <div class="card" style="width: 50rem;">
                                <div class="container publicacion">
                                    <div class="row perfil-barra">
                                        <div class="col-12 d-flex align-items-center perfil-usuario">
                                            <i class="fa-solid fa-user fa-lg " style="color: #000000;"></i>
                                            <h5 class="mb-0 ml-3 pl-2">&nbsp; Un nuevo Blog</h5>
                                            <form class="form-inline">
                                                <input class="form-control ms-5" size="50" type="search" placeholder="¿Tienes una Idea? Dinos lo que piensas" aria-label="Search">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    
                    <section id="BlogMenu">
                        <div class="row">
                            <?php for ($i = 0; $i < 7; $i++) {
                                include './templates/Blog/cardsBlog.php';
                            } ?>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="crearPublicacionModal" tabindex="-1" aria-labelledby="crearPublicacionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="crearPublicacionModalLabel">Crear la Blog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="crearBlogForm">
                    <input type="hidden" id="cedula" value="<?php echo $cedula ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tituloPublicacion" class="form-label">Título del Blog</label>
                                    <input type="text" class="form-control w-100" id="tituloPublicacion" placeholder="Título de la Publicación" required name="titulo">
                                </div>
                                <div class="mb-3">
                                    <label for="descripcionPublicacion" class="form-label">Contenido del Blog</label>
                                    <textarea class="form-control w-100" id="descripcionPublicacion" rows="15" style="resize: none;" required name="contenido"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <center><label for="descripcionPublicacion" class="form-label mt-5">Imagen para la Publicación</label></center>
                                <div class="mb-4 mt-1 d-flex justify-content-center">
                                    <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder" style="width: 300px;">
                                </div>
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="btn btn-primary btn-rounded">
                                        <label class="form-label text-white m-1" for="customFile1">Escoja una Foto</label>
                                        <input type="file" class="form-control d-none" id="customFile1" name="img" onchange="displaySelectedImage(event, 'selectedImage')">
                                    </div>
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

    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php'; ?>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./assets/js/Blogs.js"></script>
</html>
