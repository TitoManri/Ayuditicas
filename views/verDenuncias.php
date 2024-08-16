<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Denuncias</title>
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
        <h5>Ver denuncias</h5>
    </div>

    <div class="row m-3">
        <div class="col">
            <h4>Denuncias aceptadas</h4>
            <table class="table table-striped p-1">
                <thead>
                    <tr>
                        <th scope="col">Ver más</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //cargar de la lista de denuncias aceptadas
                    for ($i = 0; $i < 4; $i++) {
                        echo "<tr>
                        <td>
                            <a href='./detalleDenuncia.php' class='ml-1'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                    <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0' />
                                    <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7' />
                                </svg>
                            </a>
                        </td>
                        <td>41°24'12.2'N 2°10'26.5'E</td>
                        <td>Tipo</td>
                        <td>Aceptada</td>
                    </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col">
            <h4>Denuncias por revisar</h4>
            <table class="table table-striped p-1">
                <thead>
                    <tr>
                        <th scope="col">Ver más</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < 4; $i++) {
                        echo "<tr>
                    <td>
                        <a href='./confirmarDenuncia.php' class='ml-1'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0' />
                                <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7' />
                            </svg>
                        </a>
                    </td>
                    <td>41°24'12.2'N 2°10'26.5'E</td>
                    <td>Tipo</td>
                    <td>Pendiente</td>
                </tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>


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
<script src="./assets/js/searchBar.js"></script>
<script src="./assets/js/confirmarDenuncia.js"></script>

</html>