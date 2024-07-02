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
    <style>
        .btn-xl {
            padding: 10px 20px;
            font-size: 20px;
            border-radius: 10px;
            width: 50%;
        }
    </style>
</head>

<body>
    <header class="mainHeader">
        <?php
        include './templates/Header&Footer/header.php';
        ?></header>
    <br>
    <section class="container" id="Inicio">
        <h1>Ayuda al ambiente</h1>
        <br>
        <!-- Carusel de fotos. Creado por medio de Bootstrap. -->
        <!-- https://getbootstrap.com/docs/5.3/components/carousel/#how-it-works -->

        <div id="Carrusel">
            <section class="container d-flex justify-content-center" style="width: 80%;">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Primer Imagen"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Segunda Imagen"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Tercera Imagen"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://res.cloudinary.com/worldpackers/image/upload/c_fill,f_auto,q_auto,w_1024/v1/guides/article_cover/yupbbhuuyscm4xceitjo" class="d-block w-100 rounded" alt="Imagen_Voluntariado_1">
                            <div class="carousel-caption d-none d-md-block bg-light w-25 rounded border-dark position-absolute bottom-0 start-50 translate-middle-x">
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
                            <div class="carousel-caption d-none d-md-block">
                                <!-- Arreglar -->
                                <div class="bg-light w-25 rounded border-dark">
                                    <h5 style="color: #616D63">Denuncia prácticas irresponsables y protege el medio ambiente</h5>
                                    <p>Registrate y ayuda a la comunidad a darse cuenta.</p>
                                </div>
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
            </section>
        </div>

        <br>
        <!-- Botones para ir a los menus, incluye boton con etiqueta <a>, titulo y explicacion de lo que se hace -->
        <!-- Talvez incorporar imagenes para ver el sitio desde fuera -->
        <div id="BotonesYExplicacion">
            <section class="container">
                <div class="row">
                    <div class="col-5 d-flex justify-content-center">
                        <a href="#" class="btn btn-primary btn-xl">Pagina Principal</a>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-5  d-flex justify-content-center">
                        <a href="#" class="btn btn-primary btn-xl">Ver Blogs</a>
                    </div>
                </div>
            </section>
            <br>
            <section class="container">
                <div class="row">
                    <div class="col-6 d-flex justify-content-start">
                        <h1 class="text-start">Participa en la conversacion</h1>
                    </div>
                    <div class="col-6  d-flex justify-content-end">
                        <h1 class="text-end">Lee Blogs creados por Usuarios</h1>
                    </div>
                </div>
            </section>

            <section class="container">
                <div class="row">
                    <div class="col-5">
                        <p class="text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero magnam reiciendis aliquam cumque amet. Libero repellendus amet alias. Corporis cupiditate ullam quia est eos ratione dolor exercitationem omnis ipsum laboriosam!</p>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-5">
                        <p class="text-end">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt deserunt enim necessitatibus. Molestiae culpa fugit pariatur dolore quae recusandae, laboriosam consectetur distinctio architecto earum veritatis fuga, eum excepturi est corporis!</p>
                    </div>
                </div>
            </section>
        </div>

    </section>
    <br>
    <hr>
    <br>
    <!-- Sobre Nosotros, Explica quienes somos y que se quiere hacer -->
    <section id="SobreNosotros" class="container">
        <section class="container">
            <div class="row">
                <div class="col-6">
                    <h1>¿Quienes Somos?</h1>
                </div>
                <div class="col-6">
                    <h1 class="text-end">¿Que pensamos hacer?</h1>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="row">
                <div class="col-5">
                    <p class="text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero magnam reiciendis aliquam cumque amet. Libero repellendus amet alias. Corporis cupiditate ullam quia est eos ratione dolor exercitationem omnis ipsum laboriosam! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sunt atque, corporis nobis adipisci neque id vero molestias rerum iure qui, fugiat error commodi veniam. Doloribus praesentium iure vero facere maxime.</p>
                </div>
                <div class="col-2 d-flex justify-content-center"><img src="../assets/img/logoAyuditicas.png" alt="Logo_Ayuditica" class="img-fluid"></div>
                <div class="col-5">
                    <p class="text-end">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt deserunt enim necessitatibus. Molestiae culpa fugit pariatur dolore quae recusandae, laboriosam consectetur distinctio architecto earum veritatis fuga, eum excepturi est corporis! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis voluptatum ipsam sunt, corrupti similique atque expedita excepturi facere quos commodi assumenda odit, adipisci recusandae aut provident modi harum porro aliquam.</p>
                </div>
            </div>
        </section>
    </section>

    <br>
    <hr>
    <br>
    <!-- Imagenes, Son imagenes y rol en el equipo -->
    <section id="Imagenes">
        <div class="container">
            <div class="row"><h2 class="text-center">El equipo</h2></div>
            <br>
            <div class="row">
                <div class="col-3">
                    
                    <div class="d-flex justify-content-center">
                        <svg width="100" xmlns="http://www.w3.org/2000/svg" height="100" id="screenshot-371bae10-ec5b-8027-8004-8bc391090496" viewBox="-1373 553 100 100" style="-webkit-print-color-adjust:exact" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" version="1.1">
                            <g id="shape-371bae10-ec5b-8027-8004-8bc391090496">
                                <g class="fills" id="fills-371bae10-ec5b-8027-8004-8bc391090496">
                                    <rect rx="0" ry="0" x="-1373" y="553.0000000000002" transform="matrix(1.000000, 0.000000, 0.000000, 1.000000, 0.000000, 0.000000)" width="100" height="100" style="fill:#B1B2B5;fill-opacity:1">
                                    </rect>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h4 class="text-center">Persona 1</h4>
                </div>

                <div class="col-3">
                    
                    <div class="d-flex justify-content-center">
                        <svg width="100" xmlns="http://www.w3.org/2000/svg" height="100" id="screenshot-371bae10-ec5b-8027-8004-8bc391090496" viewBox="-1373 553 100 100" style="-webkit-print-color-adjust:exact" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" version="1.1">
                            <g id="shape-371bae10-ec5b-8027-8004-8bc391090496">
                                <g class="fills" id="fills-371bae10-ec5b-8027-8004-8bc391090496">
                                    <rect rx="0" ry="0" x="-1373" y="553.0000000000002" transform="matrix(1.000000, 0.000000, 0.000000, 1.000000, 0.000000, 0.000000)" width="100" height="100" style="fill:#B1B2B5;fill-opacity:1">
                                    </rect>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h4 class="text-center">Persona 2</h4>
                </div>

                <div class="col-3">
                    
                    <div class="d-flex justify-content-center">
                        <svg width="100" xmlns="http://www.w3.org/2000/svg" height="100" id="screenshot-371bae10-ec5b-8027-8004-8bc391090496" viewBox="-1373 553 100 100" style="-webkit-print-color-adjust:exact" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" version="1.1">
                            <g id="shape-371bae10-ec5b-8027-8004-8bc391090496">
                                <g class="fills" id="fills-371bae10-ec5b-8027-8004-8bc391090496">
                                    <rect rx="0" ry="0" x="-1373" y="553.0000000000002" transform="matrix(1.000000, 0.000000, 0.000000, 1.000000, 0.000000, 0.000000)" width="100" height="100" style="fill:#B1B2B5;fill-opacity:1">
                                    </rect>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h4 class="text-center">Persona 3</h4>
                </div>

                <div class="col-3">
                    
                    <div class="d-flex justify-content-center">
                        <svg width="100" xmlns="http://www.w3.org/2000/svg" height="100" id="screenshot-371bae10-ec5b-8027-8004-8bc391090496" viewBox="-1373 553 100 100" style="-webkit-print-color-adjust:exact" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" version="1.1">
                            <g id="shape-371bae10-ec5b-8027-8004-8bc391090496">
                                <g class="fills" id="fills-371bae10-ec5b-8027-8004-8bc391090496">
                                    <rect rx="0" ry="0" x="-1373" y="553.0000000000002" transform="matrix(1.000000, 0.000000, 0.000000, 1.000000, 0.000000, 0.000000)" width="100" height="100" style="fill:#B1B2B5;fill-opacity:1">
                                    </rect>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h4 class="text-center">Persona 4</h4>
                </div>

            </div>
            <div class="row"><br></div>
        </div>
    </section>

    <footer class=" mainfooter">
        <?php include './templates/Header&Footer/footer.php';
        ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../assets/js/searchBar.js"></script>

</html>