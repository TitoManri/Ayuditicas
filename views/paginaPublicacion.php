<?php
session_start();

if (empty($_SESSION['cedula'])) {
    header('Location: ./inicioSesion.php');
    exit();
}

$idPublicacion = isset($_GET['id']) ? intval($_GET['id']) : 0;
$cedula = $_SESSION['cedula'];
if ($idPublicacion <= 0) {
    echo "ID de publicación no válido.";
    exit();
}
?>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.4/tagify.min.css" rel="stylesheet">

</head>

<body>
    <header class="mainHeader">
        <?php
        $activoPaginaP = 'active';
        include './templates/Header&Footer/header.php';
        ?>
    </header>
    <?php 
            $activoPaginaP = 'active';
            $nombrePagina = 'Publicacion Completa';
            include './templates/Header&Footer/subheader.php'; 
    ?>
<section id="publicacion-completa">
    <main class="container d-flex align-items-stretch">
        <div class="row flex-fill">
            <div class="col-lg-8 d-flex flex-column" style="margin-bottom: 30px; padding-top: 10px;">
                <input type="hidden" id="idPublicacion" value="<?php echo $idPublicacion ?>">
                <input type="hidden" id="cedula" value="<?php echo $cedula ?>">
                <div id="publicacion-detalle" class="flex-fill"></div>
            </div>
            <div class="col-lg-4 d-flex flex-column" id="caja-comentarios" style="border: 1px solid #000000; margin-bottom: 30px; padding-top: 10px;">
                <h5>Comentarios</h5>
                <div id="comentariosContainer" class="mb-3"></div>
                <form id="formComentario" class="mt-auto">
                    <div class="mb-3">
                        <textarea class="form-control" id="nuevoComentario" rows="3" placeholder="Escribe un comentario..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Comentar</button>
                </form>
            </div>
        </div>
    </main>
</section>






    <!-- Modal Reporte -->
    <?php
    include './templates/Red_Social/modalReporte.php';
    ?>

    <footer class="mainfooter sticky-bottom">
        <?php include './templates/Header&Footer/footer.php';
        ?>
    </footer>
</body>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.4/tagify.min.js"></script>
    <script src="./assets/js/botonTop.js"></script>
    <script src="./assets/js/publicacionesCompleta.js"></script>
</html>