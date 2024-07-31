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
    <style>
        
    </style>
</head>

<body>
    <header class="mainHeader">
        <?php 
        $activoPaginaP = 'active';
        include './templates/Header&Footer/header.php'; 
        ?>
    </header>

    <?php include './templates/Red_Social/asideDerecha.php'; ?>
    <?php include './templates/Red_Social/asideIzquierda.php'; ?>

    <section id="pagina-red-social">
        <div class="container-fluid">
            <main>
                <div class="d-flex flex-column align-items-center" style="padding-top: 10px;">
                    <?php for ($i = 0; $i < 5; $i++) {
                        include './templates/Red_Social/publicacion.php';
                    } ?>
                </div>
                <button id="modalCrearPublicacion" data-bs-toggle="modal" data-bs-target="#crearPublicacionModal" type="button" class="btn p-4 rounded-circle btn-lg sticky-button">
                    <i class="fa-regular fa-pen-to-square fa-2xl"></i>
                </button>
            </main>
        </div>
    </section>
    <!-- Modal Reporte -->
    <?php include './templates/Red_Social/crearPublicacionModal.php'; ?>
    <!-- Modal Crear Publicacion -->
    <?php include './templates/Red_Social/modalReporte.php'; ?>

    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php'; ?>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./assets/js/like.js"></script>
    <script src="./assets/js/crearPublicacionModal.js"></script>
</body>
</html>
