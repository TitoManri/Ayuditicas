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

// Crear un array con los datos
$data = array(
    'nombre' => $nombre,
    'cedula' => $cedula,
);
$jsonData = json_encode($data);
$etiquetas = isset($_GET["SelectEtiqueta"]) ? $_GET["SelectEtiqueta"] : [];
$etiquetasData = json_encode($etiquetas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etiqueta1</title>
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/campanias.css">
    <link rel="stylesheet" href="./assets/css/Etiquetas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="mainHeader">
        <?php
         $activoPaginaP = 'active';
        include './templates/Header&Footer/header.php';
        ?></header>


    <!-- Asides de Etiquetas(Derecha) y Campannas (Izquierda) -->
    <?php include './templates/Red_Social/asideDerecha.php'; ?>
    <br><br>
    <section id="PublicacionesEtiquetas" class="container containerD" style="margin-left: 200px;">
        <h1>Post sobre la Etiqueta</h1><br>

    </section>
    <br><br><br>
    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php';
        ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    let userData = <?php echo $jsonData; ?>;
    let etiquetas = <?php echo $etiquetasData?>
</script>
<script src="./assets/js/searchBar.js"></script>
<script src="./assets/js/etiquetasVer.js"></script>
<script src="./assets/js/verPublicacionesEtiqueta.js"></script>
<script src="./assets/js/asideEtiquetasCamps.js"></script>

</html>