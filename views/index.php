<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/Etiquetas.css">

    <link rel="stylesheet" href="./assets/css/MultipleSelect.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        include './templates/Header&Footer/header.php';
        ?></header>

    <nav id="EtiquetasNav" class="EtiquetasNav centro">
        <h2>Etiquetas</h2>
    </nav>

    <br>

    <section id="BusquedaEtiqueta" class="container">
        <div style="width: 30%;">
            <!--Preguntar cual de las dos les parece
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputEtiqueta"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Buscar por Nombre" id="inputEtiqueta" aria-describedby="inputEtiqueta">
            </div>
        -->
            <label for="SelectEtiqueta"><i class="fa fa-search"></i> Busqueda por nombre</label>
            <select name="SelectEtiqueta" id="SelectEtiqueta" multiple>
                <option value="1">Basura</option>
                <option value="2">Arboles</option>
                <option value="3">Educacion</option>
            </select>
        </div>
    </section>
    <br>
    <h2 class="text-center">Etiquetas Populares</h2>
    <br>
    <section id="EtiquetasPopulares" class="container">
        <div class="row pb-5">
            <div class="col-1"></div>
            <div class="EtiquetasRecomendados col-3 centro">
                <a href="#">
                    <h3>Arboles</h3>
                    <h4>300 publicaciones</h4>
                </a>
            </div>
            <div class="col-1"></div>
            <div class="EtiquetasRecomendados col-3 centro">
                <a href="#">
                    <h3>Arboles</h3>
                    <h4>300 publicaciones</h4>
                </a>
            </div>
            <div class="col-1"></div>
            <div class="EtiquetasRecomendados col-3 centro">
                <a href="#">
                    <h3>Arboles</h3>
                    <h4>300 publicaciones</h4>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="EtiquetasRecomendados col-3 centro">
                <a href="#">
                    <h3>Arboles</h3>
                    <h4>300 publicaciones</h4>
                </a>
            </div>
            <div class="col-1"></div>
            <div class="EtiquetasRecomendados col-3 centro">
                <a href="#">
                    <h3>Arboles</h3>
                    <h4>300 publicaciones</h4>
                </a>
            </div>
            <div class="col-1"></div>
            <div class="EtiquetasRecomendados col-3 centro">
                <a href="#">
                    <h3>Arboles</h3>
                    <h4>300 publicaciones</h4>
                </a>
            </div>
        </div>
    </section>

    <br><br><br><br><br><br><br><br><br><br>

    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php';
        ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="./assets/js/searchBar.js"></script>
<script src="./assets/js/MultipleSelect.js"></script>
<script>
    new MultiSelectTag('SelectEtiqueta')
</script>

</html>