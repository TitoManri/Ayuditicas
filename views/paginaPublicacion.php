<?php
session_start();

// Redirigir si la sesión no está iniciada
if (empty($_SESSION['cedula'])) {
    header('Location: ./inicioSesion.php');
    exit();
}

// Obtener el ID de la publicación desde la URL
$idPublicacion = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idPublicacion <= 0) {
    // Manejar el caso cuando el ID no es válido
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
    <link rel="stylesheet" href="./assets/css/publicacionCompleta.css">

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
        <main class="col d-flex justify-content-center">
            <div class="col d-flex flex-column align-items-center" style="margin-bottom: 30px; padding-top: 10px;">
            <input type="hidden" id="idPublicacion" value="<?php echo $idPublicacion ?>">
            <div id="publicacion-detalle" class="row">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="./assets/js/like.js"></script>
<script src="./assets/js/publicacionCompleta.js"></script>
<script src="./assets/js/comentarios.js"></script>
</html>