<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denuncias</title>
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/crearDenuncia.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/theme.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        include './templates/Header&Footer/header.php'
            ?>
    </header>

    <div id="FORM" class="container-fluid">
        <div class="container_label">
            <h5>Crear denuncia</h5>
        </div>
        <div class="container">
            <form method="post" action="" id="formDenuncia">
                <div class="row gx-5 align-items-start custom-gap">
                    <div class="col">
                        <label for="selectTipo" class="form-label">
                            <h3>Tipo denuncia</h3>
                        </label>
                        <select class="form-select" aria-label="Tipo denuncia" id="selectTipo">
                        </select>
                    </div>
                    <div class="col">
                        <label for="formFile" class="form-label">
                            <h3>Imágen</h3>
                        </label>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                </div>
                <div class="row gx-5 align-items-start custom-gap2">
                    <div class="col">
                        <label for="IdDetalle" class="form-label">
                            <h3>Detalle</h3>
                        </label>
                        <textarea class="form-control" id="IdDetalle" rows="4"></textarea>
                    </div>
                    <div class="col">
                        <label for="ubicacion" class="form-label">
                            <h3>Ubicación</h3>
                        </label>
                        <br>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d780739.7870962442!2d-4.508766387499999!3d40.14752270238211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42287bd0788e65%3A0xa28363ebaaa7adae!2sTeatro%20Real!5e0!3m2!1ses-419!2scr!4v1720387958264!5m2!1ses-419!2scr"
                            width="300" height="150" style="border:0;" allowfullscreen=""
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <input class="btn_enviar" type="submit" value="Enviar">
                </div>
            </form>
        </div>
    </div>

    <br><br>
    <footer class="mainfooter">
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
<script src="./assets/js/searchBar.js"></script>
<script src="./assets/js/crearDenuncia.js"></script>

</html>