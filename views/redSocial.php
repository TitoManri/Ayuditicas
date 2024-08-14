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
</head>

<body>
    <header class="mainHeader">
        <?php 
        $activoPaginaP = 'active';
        include './templates/Header&Footer/header.php'; 
        ?>
    </header>
    <div class="row row-personalizada">
        <div class="col-3">
            <nav id="CampaniasNav" class="CampaniasNav centro">
                <h2>Red Social</h2>
            </nav>
        </div>
        <div class="col-9">
            <nav id="SubHeader" class="SubHeader centro ms-5">
            </nav>
        </div>
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
        <div class="col-4 sticky-column">
        <div class="sticky-content">
            <center><h1>Campañas</h1></center>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
            </ul>
            <center><h1>Etiquetas</h1></center>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">An item</li>
            </ul>
        </div>
    </div>


    </div>
    </div>

    <?php include './templates/Red_Social/modalReporte.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./assets/js/like.js"></script>
    <script src="./assets/js/crearPublicacionModal.js"></script>
</body>

</html>