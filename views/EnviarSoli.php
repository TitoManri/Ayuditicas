<?php
session_start();
$cedula = $_SESSION['cedula'];
$nombre = $_SESSION['nombre'];
$primerApellido = $_SESSION['primerApellido'];
$segundoApellido = $_SESSION['segundoApellido'];
$genero = $_SESSION['genero'];
$fechaNacimiento = $_SESSION['fechaNacimiento'];
$nombreUsuario = $_SESSION['nombreUsuario'];
$telefono = $_SESSION['telefono'];
$correo = $_SESSION['correo'];
$numSeguidores = $_SESSION['numSeguidores'];
$img = $_SESSION['img'];
$ID_Camp = isset($_GET["ID_Camp"]) ? $_GET["ID_Camp"] : "";
//var_dump($_SESSION)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Solicitud</title>
    <!-- Bootstrap & Icons-->
    <link rel="stylesheet" href="./assets/css/campanias.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/EnviarSoli.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        $activoCampanias = 'active';
        include './templates/Header&Footer/header.php';
        ?></header>

    <nav id="CampaniasNav" class="CampaniasNav centro">
        <h2>Enviar solicitud</h2>
    </nav>
    <br><br>
    <section id="EnviarSoli" class="container">
        <form method="POST" id="FormSolicitud">
            <div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5">
                        <?php
                        echo '<input name="id_campania" id="id_campania" type="hidden" value="' . $ID_Camp . '">';
                        ?>
                        <?php
                        echo '<input name="cedula" id="cedula" type="hidden" value="' . $cedula . '">';
                        ?>
                        <label class="h3" for="Nombre_Usuario">Creador de la campaña</label>
                        <?php
                        echo '<input name="Nombre_Usuario" id="Nombre_Usuario" class="form-control" type="text" readonly value="', $nombre, '" required>';
                        ?>
                        <label for="Nombre_Usuario">No editable</label>
                        <br>
                        <br>
                        <label class="h3" for="Nombre_Usuario">Edad</label>
                        <?php
                        // Asignar la fecha actual
                        $fechaActual = date("Y-m-d");
                        $fechaActual = new DateTime($fechaActual);
                        $fechaNacimiento = $_SESSION['fechaNacimiento'];
                        $fechaNacimientoDate = new DateTime($fechaNacimiento);

                        $edad = $fechaNacimientoDate->diff($fechaActual);
                        echo '<input name="Edad" id="Edad" class="form-control" type="number" readonly value="', $edad->y, '" required>';
                        ?>
                        <label for="Edad">No editable</label>
                        <br><br>
                        <label class="h3" for="RazonInteres">Razón de interés en el proyecto</label>
                        <textarea class="form-control" name="RazonInteres" id="RazonInteres" rows="3" style="resize: none;" required></textarea>
                    </div>
                    <div class="col-5">
                        <label class="h3" for="Apellido_Usuario">Apellidos</label>
                        <?php
                        $apellido = $primerApellido . " " . $segundoApellido;
                        echo '<input name="Apellido_Usuario" id="Apellido_Usuario" class="form-control" type="text" readonly value="', $apellido, '" required>';
                        ?>
                        <label for="Edad">No editable</label>
                        <br><br>
                        <label class="h3" for="Contacto">Medio a ser contactado</label>
                        <select name="Contacto" id="Contacto" class="form-select">
                            <option hidden disabled selected value>Escoga una opcion</option>
                            <option value="Correo">Correo</option>
                            <option value="Mensajeria">Mensajeria</option>
                            <option value="Telefono">Telefono</option>
                        </select>
                        <br><br>
                        <label class="h3" for="Habilidades">Habilidades relevantes</label>
                        <textarea class="form-control" name="Habilidades" id="RazonHabilidadesInteres" rows="3" style="resize: none;"></textarea>
                        <label for="Habilidades">No necesario</label>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="d-flex justify-content-center">
                <button type="submit" class="CrearCampFormBTN">Enviar Solicitud</button>
            </div>
        </form>
    </section>
    <br><br>

    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php';
        ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./assets/js/enviarSolicitudCamp.js"></script>

</html>