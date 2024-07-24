<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Publicacion</title>
    <!-- Bootstrap & Icons-->
    <link rel="stylesheet" href="./assets/css/campanias.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/EnviarSoli.css">
    <link rel="stylesheet" href="./assets/css/Etiquetas.css">
    <link rel="stylesheet" href="./assets/css/MultipleSelect.css">
    <link rel="stylesheet" href="./assets/css/campanias.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        include './templates/Header&Footer/header.php';
        ?></header>

    <nav id="CampaniasNav" class="CampaniasNav centro">
        <h2>Crear Publicacion</h2>
    </nav>
    <br><br>
    <section id="EnviarSoli" class="container">
        <form action="" method="POST">
            <div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5">
                        <label class="h3" for="titulo">Titulo Publicacion</label>
                        <input name="titulo" id="titulo" class="form-control" type="text" required>
                        <br>
                        <label class="h3" for="RazonInteres">Descripcion</label>
                        <textarea class="form-control" name="RazonInteres" id="RazonInteres" rows="3"
                            style="resize: none;" required></textarea>
                        <br>
                        <label for="SelectEtiqueta"> Etiquetas para publicacion</label>
                        <div class="d-flex justify-content-center">
                            <select name="SelectEtiqueta" id="SelectEtiqueta" multiple required>
                                <?php
                        $opciones = ['Basura', 'Arboles', 'Educacion'];

                        for ($i = 0; $i < count($opciones); $i++) {
                            echo '<option value="', $opciones[$i], '">', $opciones[$i], '</option>';
                        }
                        ?>
                            </select>
                        </div>
                        <br>
                    </div>

                    <div class="col-5">
                        <div>
                            <div class="mb-4 d-flex justify-content-center">
                                <img id="selectedImage" src="./assets/img/imagen.png" alt="example placeholder"
                                    style="width: 300px;" />
                            </div>
                            <div class="d-flex justify-content-center">
                                <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                    <label class="form-label text-white m-1" for="customFile1">Escoja una Imagen</label>
                                    <input type="file" class="form-control d-none" id="customFile1"
                                        onchange="displaySelectedImage(event, 'selectedImage')" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="CrearCampFormBTN">Crear Publicacion</button>
                </div>
        </form>
    </section>
    <br><br>

    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php';
        ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="./assets/js/searchBar.js"></script>
<script src="./assets/js/MultipleSelect.js"></script>
<script src="./assets/js/crearPublicacion.js"></script>
<script>
new MultiSelectTag('SelectEtiqueta')
</script>
</html>