<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="../views/assets/css/perfil.css"> 
</head>
<body>
    <header class="mainHeader">
        <?php
        $activoPerfil='active';
         include './templates/Header&Footer/header3.php'; ?>
    </header>

    <nav id="CampaniasNav" class="CampaniasNav centro">
        <h2>Perfil</h2>
    </nav>

    <div class="container mx auto">
        <div class="row mx auto">
            <div class="col-xl-8 mx auto">
                <div class="card card-top">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Columna del perfil -->
                            <div class="col-md-4">
                                <div class="text-center">
                                    <img src="https://cdn.icon-icons.com/icons2/2942/PNG/512/profile_icon_183860.png" class="img-fluid avatar-xxl rounded-circle" alt="">
                                    <h4 class="font-size-10 mt-3">Nombre Apellido</h4>
                                </div>
                            </div>
                            <!-- Fin col -->

                            <!-- Columna de la biografia -->
                            <div class="col-md-8">
                                <div class="ms-3">
                                    <h4 class="card-title mb-2">Biografia</h4>
                                    <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                            <!-- Fin col -->
                        </div>
                    </div>
                </div>
                <!-- Fin card-top -->

                <!-- Mis publicaciones -->
                <!--Cositas que estan arriba de mis publicaciones-->
                <ul class="nav nav-tabs nav-tabs-custom border-bottom-0 mt-3 nav-justfied" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            <i class="fa-regular fa-rectangle-list fa-xl" style="color: #616d63;"></i></a>
                    </li>
                </ul>
                <section class="card">
                    <div class="tab-content p-3">
                        <div class="tab-pane active show">
                            <div class="d-flex"> 
                                <h4 class="card-title mb-4">Mis Blogs</h4> 
                            </div>
                            <section class="row">
                                <?php include './templates/Blog/cards.php'; ?>
                            </section>
                        </div>
                    </div>
                </section>
                <!-- Fin card -->
            </div>
        </div>
        <!-- Fin row -->
    </div>
    <!-- Fin container -->

    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>
