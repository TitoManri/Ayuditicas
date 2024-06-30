<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/headerfooter.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        include './templates/Header&Footer/header.php';
        ?></header>
    <br>
    <div class="container">
        <h1>Ayuda al ambiente</h1>
        <br>
        <!-- Carusel de fotos. Creado por medio de Bootstrap. -->
        <!-- https://getbootstrap.com/docs/5.3/components/carousel/#how-it-works -->

        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Primer Imagen"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Segunda Imagen"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Tercera Imagen"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://res.cloudinary.com/worldpackers/image/upload/c_fill,f_auto,q_auto,w_1024/v1/guides/article_cover/yupbbhuuyscm4xceitjo" class="d-block w-100 rounded" alt="Imagen_Voluntariado_1">
                    <div class="carousel-caption d-none d-md-block bg-light w-25 rounded border-dark">
                        <!-- Arreglar -->
                        <h5 style="color: #616D63">Únete a una causa y transforma nuestro pais</h5>
                        <p>Registrate y participa en proyectos comunitarios.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://res.cloudinary.com/worldpackers/image/upload/c_fill,f_auto,q_auto,w_1024/v1/guides/article_cover/hdaeh8moxirgvluxdpew" class="d-block w-100 rounded" alt="Imagen_Voluntariado_2">
                    <div class="carousel-caption d-none d-md-block bg-light w-25 rounded border-dark">
                        <!-- Arreglar -->
                        <h5 style="color: #616D63">Inspira y lidera: Crea tus propias campañas de voluntariado</h5>
                        <p>Regístrate como 'Jefe de Campañas' y empieza a crear un impacto</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://traveler.marriott.com/es/wp-content/uploads/sites/2/2017/11/Voluntourism_teaching-english-GettyImages-148900387.jpg" class="d-block w-100 rounded" alt="Imagen_Voluntariado_3">
                    <div class="carousel-caption d-none d-md-block bg-light w-25 rounded border-dark">
                        <!-- Arreglar -->
                        <h5 style="color: #616D63">Denuncia prácticas irresponsables y protege el medio ambiente</h5>
                        <p>Registrate y ayuda a la comunidad a darse cuenta.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        <footer class="mainfooter">
            <?php include './templates/Header&Footer/footer.php';
            ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../assets/js/searchBar.js"></script>

</html>