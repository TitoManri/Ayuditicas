<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Campaña</title>
    <!-- Bootstrap & Icons-->
    <link rel="stylesheet" href="./assets/css/campanias.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/CrearCamps.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        $activoCampanias='active';
        include './templates/Header&Footer/header.php';
        ?></header>

    <nav id="CampaniasNav" class="CampaniasNav centro">
        <h2>Crear Campañas</h2>
    </nav>
    <br><br>
    <section id="CrearCamp" class="container">
        <form action="./Camps.php" method="POST">
            <div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5">
                    <label class="h3" for="Nombre_Usuario">Creador de la campaña</label>
                    <?php
                    $nombre = "Nombre_Usuario";
                    echo '<input name="Nombre_Usuario" id="Nombre_Usuario" class="form-control" type="text" readonly value="', $nombre, '" required>';
                    ?>
                    <label for="Nombre_Usuario">No editable</label>
                    <br>
                    <br>
                    <label class="h3" for="Descripcion">Descripcion</label>
                    <textarea class="form-control" name="Descripcion" id="Descripcion" rows="3" style="resize: none;" required></textarea>
                    <br><br>
                    <label class="h3" for="FechaFinalizacion">Fecha de Finalizacion de la campaña</label>
                    <input name="FechaFinalizacion" id="FechaFinalizacion" class="form-control" type="date" required />
                </div>
                <div class="col-5">
                    <br><br>
                    <br>
                    <label class="h3" for="Nombre_Camp">Nombre de la campaña</label>
                    <input type="text" name="Nombre_Camp" id="Nombre_Camp" class="form-control" required>
                    <br><br>
                    <label class="h3" for="Cantidad_Personas">Cantidad de personas requeridas</label>
                    <input type="number" name="Cantidad_Personas" id="Cantidad_Personas" class="form-control" required min="5" max="50">
                </div>
            </div>
            </div>
            <br><br>
            <div class="d-flex justify-content-center">
                <button type="submit" class="CrearCampFormBTN">Crear Campaña</button>
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
</html>