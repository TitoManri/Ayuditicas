<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaña1</title>
    <!-- Bootstrap & Icons-->
    <link rel="stylesheet" href="./assets/css/campanias.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        include './templates/Header&Footer/header.php';
        ?></header>

    <!-- Aside de etiquetas -->
    <aside id="EtiquetaAside" class="EtiquetasAside">
        <!-- Titulo y ver todas las etiquetas -->
        <h3>Etiquetas</h3>
        <div class="text-center">
            <a href="./VerEtiquetas.php" style="color: #827a6f; opacity: 47%;" class="text-center">Ver todo</a>
        </div>

        <!-- Etiquetas individuales. Uso de PHP para facilitar la creacion -->
        <br>
        <?php
        for ($i = 0; $i < 5; $i++) {
        ?>
            <div class="Etiquetas">
                <a href=""><i class="bi bi-tag-fill" style="color: #bcc9b8;"></i> Nombre</a>
            </div>
            <br>
        <?php
        }
        ?>
    </aside>

    <aside id="CampanasAside" class="CampanasAside">
        <h3>Campañas</h3>
        <div class="text-center">
            <a href="./Camps.php" style="color: #827a6f; opacity: 47%;" class="text-center">Ver todo</a>
        </div>

        <!-- Etiquetas individuales. Uso de PHP para facilitar la creacion -->
        <br>
        <?php
        for ($i = 0; $i < 4; $i++) {
        ?>
            <div class="Etiquetas">
                <a href="">
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <img src="https://cdn.iconscout.com/icon/free/png-256/free-gallery-187-902099.png?f=webp" alt="" width="60px" height="60px">
                        </div>
                        <div class="col">
                            <div class="row" style="height: 30%;">
                                <p>Nombre</p>
                            </div>
                            <div class="row">
                                <p style="font-size: 14px; opacity: 47%;" class="text-truncate">Descripcion</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <br>
        <?php
        }
        ?>
    </aside>
    <br><br>

    <section id="NombreCamp" class="container containerD card rounded">
        <br>
        <div class="row">
            <div class="col-3 d-flex justify-content-center">
                <img src="https://cdn.iconscout.com/icon/free/png-256/free-gallery-187-902099.png?f=webp" alt="" width="175px">
            </div>
            <div class="col-9">
                <p class="h1 font-weight-bold">Nombre de la comunidad</>
                    <br>
                <p style="font-size: 18px; opacity: 47%;">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione tempora libero enim beatae sint qui iure eos, labore, minima debitis velit voluptatem perspiciatis. Voluptate consequatur quae sunt pariatur quam nostrum.
                </p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-7">
                <a href="" class="btn btn-light">
                    Crear Publicacion
                </a>
            </div>
            <div class="col"></div>
        </div>
        <br>
    </section>
    <br>
    <section id="PostsCamp" class="container containerD">
        <h1>Post sobre la campaña</h1><br>
        <?php
        for ($i = 0; $i < 2; $i++) {
        ?>
            <main class="col d-flex justify-content-center">
                <div class="col d-flex flex-column align-items-center" style="padding-bottom: 20px; padding-top: 10px;">
                    <?php
                    include './templates/Red_Social/publicacion.php';
                    ?>
                </div>
            </main>
            <hr>
        <?php
        }
        ?>
    </section>


    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php';
        ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="./assets/js/searchBar.js"></script>

</html>