<?php
$ID_Solicitud = isset($_POST["ID_Solicitud"]) ? trim($_POST["ID_Solicitud"]) : "";

$data = array(
    'id_solicitud' => $ID_Solicitud
);
$jsonData = json_encode($data);
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
    <link rel="stylesheet" href="./assets/css/verSolicitud.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        $activoCampanias = 'active';
        include './templates/Header&Footer/header.php';
        ?></header>

    <nav id="CampaniasNav" class="CampaniasNav centro" style="width: 550px;">
        <h2>Solicitud unirse a campaña</h2>
    </nav>
    <br><br>

    <section id="Solicitud" class="container">
        <div class="row">
            <div class="col-1"><br></div>
            <div class="col-3">
                <div class="d-flex justify-content-center">
                    <?php ?>
                    <img src="https://cdn.iconscout.com/icon/free/png-256/free-gallery-187-902099.png?f=webp" alt="" class="img-fluid" width="250px" height="250px">
                </div>
                <div class="text-center" id="DatosPersona">
                </div>
            </div>
            <div class="col-1"><br></div>
            <div class="col-6">
                <p class="h1 fw-bold">Razón de interés en el proyecto</p>
                <div id="RazonInteres">

                </div>
                <br>
                <p class="h1 fw-bold">Habilidades relevantes </p>
                <div id="Habilidades">

                </div>
                <br><br>
                <div class="d-flex justify-content-end">
                    <div class="col-2" id="AceptarDiv">

                    </div>
                    <div class="col-1"></div>
                    <div class="col-2" id="DenegarDiv">

                    </div>
                </div>
            </div>
        </div>
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
<script src="./assets/js/searchBar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    let userData = <?php echo $jsonData; ?>;
</script>
<script src="./assets/js/verSolicitudDetalle.js"></script>

</html>