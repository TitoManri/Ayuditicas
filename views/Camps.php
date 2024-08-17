<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campañas</title>
    <!-- Bootstrap & Icons-->
    <link rel="stylesheet" href="./assets/css/campanias.css">
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

    <!-- Barra debajo de navegacion -->
    <?php 
            $activoPaginaP = 'active';
            $nombrePagina = 'Campañas';
            include './templates/Header&Footer/subheader.php'; 
    ?>
    <!-- Asides de Etiquetas(Derecha) y Campannas (Izquierda) -->
    <?php include './templates/Red_Social/asideDerecha.php'; ?>
    <br><br>
    <!-- Mostrar Campañas usando PHP -->
    <section id="MostrarCampanias" class="container">
        <!-- Crear Row inicial -->
        <div class="row">
            <?php
            //Por la cantidad de veces que uno quiera
            //Copiar el codigo. Cambiar numero si se quiere ver el funcionamiento
            $campanias = 7;

            //Por las veces de la variable, crear secciones
            for ($i = 1; $i <= $campanias; $i++) {
                if ($i % 2 != 0 && $i != 1) {
                    //Crear row para diferenciar entre distintas filas
                    echo '<div class="row">';
                }

                //Crear seccion con id de campania
                echo '<section id="Campania', $i, '" class="col-5">';
            ?>
            <!-- Partes de la seccion -->
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
                        <a href="./enviarsoli.php" class="btn btn-warning me-2">Enviar Solicitud</a>
                        <a href="./DentroCamp.php" class="btn btn-warning">Ingresar</a>
                    </div>
                </div>
                <br>
            </section>
            <!-- Cerrar seccion de campaña -->
<?php
                if ($i % 2 == 0) {
                    //Cerrar column y darle espacio para el aside
                    echo '<div class="col-2"></div></div>';
                } 
                if ($i == $campanias) {
                    if($i % 2 != 0) {
                        //Si no es par, cerrar div de row
                        echo '</div>';
                    }
                    //Si ha llegado a la cantidad maxima, cerrar seccion para mostrar campañas
                    echo '</section>';
                }
            }
?>

<br><br>

<footer class="mainfooter">
    <?php include './templates/Header&Footer/footer.php';
    ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</html>