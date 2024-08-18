<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Denuncia</title>
    <!-- css del mapa-->
    <link rel="stylesheet" href="./assets/css/geocode.css">
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/denuncias.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/theme.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        include './templates/Header&Footer/header.php'
            ?>
    </header>

    <div class="container_label col-2">
        <h5>Crear denuncia</h5>
    </div>

    <section id="crearDenuncia" class="container">
        <!-- formulario de denuncia -->
        <form method="post" action="" name="formDenuncia" id="formDenuncia" enctype="multipart/form-data">
            <div class="row gx-5 align-items-start custom-gap">
                <div class="col">
                    <!-- select tipo denuncia-->
                    <label for="selectTipo" class="form-label">
                        <h3>Tipo denuncia</h3>
                    </label>
                    <select class="form-select" aria-label="Tipo denuncia" id="selectTipo" name="selectTipo">
                        <option value="">--Selecciona el tipo de denuncia--</option>
                        <option value="Basura en las calles">Basura en las calles</option>
                        <option value="Maltrato animal">Maltrato animal</option>
                        <option value="Deforestación">Deforestación</option>
                    </select>
                </div>
                <div class="col">
                    <!-- imagen-->
                    <label for="imgDen" class="form-label">
                        <h3>Imágen</h3>
                    </label>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="imgDen" name="imgDen">
                    </div>
                </div>
            </div>
            <div class="row gx-5 align-items-start custom-gap2">
                <div class="col">
                    <!-- detalle text-->
                    <label for="detalle" class="form-label">
                        <h3>Detalle</h3>
                    </label>
                    <textarea class="form-control" id="detalle" rows="4" name="detalle"></textarea>
                </div>
                <div class="col">
                    <!-- ubicación (PENDIENTE)-->
                    <label for="ubicacion" class="form-label">
                        <h3>Ubicación</h3>
                    </label>
                    <br>
                    <!-- MAPA-->
                    <div id="map">
                    </div>
                    <div id="datosLongLat">
                        <input type="hidden" id="latitud" name="latitud" value="">
                        <input type="hidden" id="longitud" name="longitud" value="">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <input class="btn_enviar" type="submit" value="Enviar">
            </div>
        </form>
    </section>

    <br><br>
    <footer class="mainfooter fixed-bottom">
        <?php
        include './templates/Header&Footer/footer.php'
            ?>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js
"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="./assets/js/crearDenuncia.js"></script>
<!-- api key: AIzaSyBkOC08uDEy_YWwrv9IGqWQiQHSwIVqY7I-->
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkOC08uDEy_YWwrv9IGqWQiQHSwIVqY7I&loading=async&callback=initMap&v=weekly&libraries=marker">
    </script>
</html>