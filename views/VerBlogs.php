<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Etiquetas</title>
    <!-- Bootstrap & Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="./assets/css/Blogs.css">
</head>

<body>
    <header class="mainHeader">
        <?php
        $activoBlogs = 'active';
        include './templates/Header&Footer/header3.php';
        ?></header>

    <nav id="BlogsNav" class="BlogsNav centro">
        <h2>Blog</h2>
    </nav>

    <div class="row row-personalizada">
        <div class="col-12">
            <section id="pagina-red-social">
                <div class="container">
                    <main>
                        <div class="d-flex flex-column align-items-start" style="padding-top: 10px;">
                            <div class="card" style="width: 50rem;">
                                <div class="container publicacion">
                                    <div class="row perfil-barra">
                                        <div class="col-12 d-flex align-items-center perfil-usuario">
                                            <i class="fa-solid fa-user fa-lg " style="color: #000000;"></i>
                                            <h5 class="mb-0 ml-3 pl-2">&nbsp; Crear Publicacion</h5>
                                            <form class="form-inline">
                                                <input class="form-control ms-5" size="50" type="search"
                                                    placeholder="¿Quieres crear una publicacion?" aria-label="Search">
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    
                    <section id="BlogMenu">
                    <div class="row">
                        <?php for ($i = 0; $i < 7; $i++) {
                            include './templates/Blog/cardsBlog.php';?><br><?php 
                        } ?>
                    </div>
                    </section>
                </div>
            </section>
        </div>


    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php';
        ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="./assets/js/MultipleSelect.js"></script>
</html>