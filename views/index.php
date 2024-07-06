<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
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

    <!-- Barra debajo de navegacion -->
    <nav id="CampaniasNav" class="CampaniasNav centro">
        <h2>Campañas</h2>
    </nav>

    <!-- Aside de etiquetas -->
    <aside id="EtiquetaAside" class="EtiquetasAside">
        <!-- Titulo y ver todas las etiquetas -->
        <h3>Etiquetas</h3>
        <div class="text-center">
            <a href="" style="color: #827a6f; opacity: 47%;" class="text-center">Ver todo</a>
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
    <br><br>
    <section id="MostrarCampanias" class="container">
        <section id="Campania1" class="col-5">
            <div class="d-flex">
                <h3><i class="bi bi-person-circle" style="color: #d2ac97"></i> Nombre de usuario</h3>
                <div class="ms-auto p-2">
                    <div class="dropdown ms-auto p-2">
                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="Opciones">
                        <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ms-5 pe-4">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Excepturi error libero adipisci harum, iure nobis. Nam eaque velit sed vel, at harum mollitia modi fugiat impedit doloribus cum?
                    Ipsam, doloribus?
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi in rerum adipisci eum nesciunt accusantium aliquam dolor iste,
                    hic dolore a doloribus cum officiis, delectus laborum.
                    Sequi illo modi debitis.</p>
                <div class="d-flex justify-content-end pe-4">
                    <a href="#" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
        </section>

        <div class="col-2"></div>
    </section>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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