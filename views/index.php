<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <!-- Bootstrap & Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/PaginaInicioIndex.css">
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
        include './templates/Header&Footer/header2.php';
        ?></header>
    <section id="CuerpoIndex">
        <div id="PrimeraParteIndex" class="pt-5">
            <section class="container text-center" id="Palabras">
                <h1 style="font-size: 58px;" class="pb-1">Unidos por un planeta más verde</h1>
                <br>
                <h5>Cada pequeño gesto cuenta en la lucha por un planeta más saludable. Únete a nuestro equipo de voluntarios y participa en iniciativas que protegen y mejoran nuestro medio ambiente. Desde la limpieza de playas hasta la plantación de árboles, tu contribución puede marcar una gran diferencia. Juntos, podemos crear un futuro sostenible para las próximas generaciones. ¡Haz parte del cambio hoy!</h5>
                <div class="pt-3">
                    <a href="./inicioSesion.php" class="btn btn-Inicio btn-success">Iniciar Sesion</a>
                    <a href="./registroSesion.php" class="btn btn-lg btn-outline-Inicio">Registrate aca</a>
                </div>
            </section>
            <br>
            <section class="d-flex justify-content-center">
                <img src="./assets/img/Imagen_Index.png" alt="Inicio_Pagina_RedSocial_Ayuditicas" class="img-fluid w-50 RedondearTop">
            </section>
            <section id="SobrePagina" class="RedondearTop">
                <br><br>
                <h1 class="text-center">Nuestras funciones</h1>
                <br><br>
                <section id="ExplicarApp" class="container">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title rounded d-flex justify-content-center" style="background-color: #4e9bf3a1"><i class="bi bi-chat-square-dots-fill h4" style="color:#2e8af3"></i></div>
                                    <h4>Participa en la conversacion</h4>
                                    <p class="card-text">Entra a la red social y habla con otras personas sobre el futuro del ambiente.</p>
                                    <div class="text-center">
                                        <a href="./redSocial.php" class="btn btn-primary">Entrar a la red social</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title rounded d-flex justify-content-center" style="background-color: #f3f04e56"><i class="bi bi-exclamation-triangle-fill h4" style="color: #f3e62e;"></i></i></div>
                                    <h4>Denuncia practicas indebidas</h4>
                                    <p class="card-text">Crea denuncias anonimas sobre el medio ambiente, para mejorar el pais.</p>
                                    <div class="text-center">
                                        <a href="./crearDenuncia.php" class="btn btn-primary">Crear una denuncia</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title rounded d-flex justify-content-center" style="background-color: #35c52256"><i class="bi bi-newspaper h4" style="color: #35c522;"></i></div>
                                    <h4>Participa en la conversacion</h4>
                                    <p class="card-text">Lee noticieros de nuestros usuarios con campañas exitosas.</p>
                                    <div class="text-center">
                                        <a href="./mainBlog.php" class="btn btn-primary">Leer blogs</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <br><br>
                <section id="ExplicarFunciones">
                    <div class="container">

                        <div class="row py-5">
                            <div class="col-5 d-flex justify-content-center">
                                <img src="./assets/img/Imagen_Index_RedSocial.png" alt="Publicacion_Ayuditicas" class="img-fluid">
                            </div>
                            <div class="col-1"></div>
                            <div class="col-5">
                                <h3>Red Social</h3>
                                <h1>Participa en las Conversaciones</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia architecto ad cumque earum soluta enim maiores eveniet dignissimos. Voluptatem consectetur officiis hic necessitatibus inventore odit. Voluptas debitis quia porro repellat.</p>
                                <p></p>
                            </div>
                        </div>

                        <div class="row py-5">
                            <div class="col-5">
                                <h3>Denuncias</h3>
                                <h1>Crea conciencia sobre problemas ambientales</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia architecto ad cumque earum soluta enim maiores eveniet dignissimos. Voluptatem consectetur officiis hic necessitatibus inventore odit. Voluptas debitis quia porro repellat.</p>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-5 d-flex justify-content-center">
                                <img src="./assets/img/Imagen_Index_Denuncias.png" alt="Denuncias_Ayuditicas" class="img-fluid">
                            </div>
                        </div>

                        <div class="row py-5">
                            <div class="col-5 d-flex justify-content-center">
                                <img src="./assets/img/Imagen_Index_Blogs.png" alt="Blogs_Ayuditicas" class="img-fluid">
                            </div>
                            <div class="col-1"></div>
                            <div class="col-5">
                                <h3>Blogs</h3>
                                <h1>Lee sobre los logros de nuestros usuaios</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia architecto ad cumque earum soluta enim maiores eveniet dignissimos. Voluptatem consectetur officiis hic necessitatibus inventore odit. Voluptas debitis quia porro repellat.</p>
                            </div>
                        </div>

                    </div>
                </section>
                <br><br>
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

                    <div class="container">
                        <div class="row">
                            <div class="col-5">
                                <p class="text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero magnam reiciendis aliquam cumque amet. Libero repellendus amet alias. Corporis cupiditate ullam quia est eos ratione dolor exercitationem omnis ipsum laboriosam! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sunt atque, corporis nobis adipisci neque id vero molestias rerum iure qui, fugiat error commodi veniam. Doloribus praesentium iure vero facere maxime.</p>
                            </div>
                            <div class="col-2 d-flex justify-content-center"><img src="./assets/img/logoAyuditicas_Verde.png" alt="Logo_Ayuditica" class="img-fluid"></div>
                            <div class="col-5">
                                <p class="text-end">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt deserunt enim necessitatibus. Molestiae culpa fugit pariatur dolore quae recusandae, laboriosam consectetur distinctio architecto earum veritatis fuga, eum excepturi est corporis! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis voluptatum ipsam sunt, corrupti similique atque expedita excepturi facere quos commodi assumenda odit, adipisci recusandae aut provident modi harum porro aliquam.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <br><br>
                <hr>
                <!-- Imagenes, Son imagenes y rol en el equipo -->
                <section id="Imagenes">
                    <div class="container">
                        <div class="row">
                            <h2 class="text-center">El equipo</h2>
                        </div>
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
            </section>
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
<script src="./assets/js/searchBar.js"></script>

</html>