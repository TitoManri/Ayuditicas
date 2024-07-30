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
    
    <style>
        
    </style>
</head>

<body>
    <header class="mainHeader">
        <?php include './templates/Header&Footer/header.php'; ?>
    </header>
    <section class="py-5 text-center container">
        <div class="row py-lg-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-bold text-dark">Página Principal</h1>
            </div>
        </div>
    </section>
    <section id="pagina-red-social">
        <div class="container-fluid">
            <!-- Aside de etiquetas -->
            <aside id="EtiquetaAside" class="EtiquetasAside">
                <h3>Etiquetas</h3>
                <div class="text-center">
                    <a href="./VerEtiquetas.php" style="color: #827a6f; opacity: 47%;" class="text-center">Ver todo</a>
                </div>
                <br>
                <?php for ($i = 0; $i < 5; $i++) { ?>
                    <div class="Etiquetas">
                        <a href=""><i class="bi bi-tag-fill" style="color: #bcc9b8;"></i> Nombre</a>
                    </div>
                    <br>
                <?php } ?>
            </aside>

            <main>
                <div class="d-flex flex-column align-items-center" style="padding-top: 10px;">
                    <?php for ($i = 0; $i < 5; $i++) {
                        include './templates/Red_Social/publicacion.php';
                    } ?>
                </div>
            </main>

            <!-- Aside de campañas -->
            <aside id="CampanasAside" class="CampanasAside">
                <h3>Campañas</h3>
                <div class="text-center">
                    <a href="./Camps.php" style="color: #827a6f; opacity: 47%;" class="text-center">Ver todo</a>
                </div>
                <br>
                <?php for ($i = 0; $i < 4; $i++) { ?>
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
                <?php } ?>
            </aside>
        </div>
    </section>

    <!-- Modal Reporte -->
    <?php include './templates/Red_Social/modalReporte.php'; ?>

    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php'; ?>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="./assets/js/like.js"></script>

</html>
