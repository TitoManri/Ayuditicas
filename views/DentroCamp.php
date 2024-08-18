<?php
$ID_Camp = isset($_GET["ID_Camp"]) ? $_GET["ID_Camp"] : "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaña1</title>
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/campanias.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        $activoCampanias='active';
        include './templates/Header&Footer/header.php';
        ?></header>
    <?php 
            $nombrePagina = 'Campañas';
            include './templates/Header&Footer/subheader.php'; 
    ?>

    <!-- Asides de Etiquetas(Derecha) y Campannas (Izquierda) -->
    <?php include './templates/Red_Social/asideDerecha.php'; ?>
    <?php include './templates/Red_Social/asideIzquierda.php'; ?>
    <br><br>

    <section id="NombreCamp" class="container containerD card rounded">
        <br>
        <div class="row">
            <div class="col-3 d-flex justify-content-center">
                <img src="https://cdn.iconscout.com/icon/free/png-256/free-gallery-187-902099.png?f=webp" alt="" width="175px">
            </div>
            <div class="col-9" id="InfoCamps">

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-7">
                <?php
                echo '<a href="./EnviarSoli.php?ID_Camp='.$ID_Camp.'" class="btn btn-light">
                    Unirse a la causa
                </a>';
                ?>
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
<script src="./assets/js/like.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./assets/js/verCampana.js"></script>

</html>