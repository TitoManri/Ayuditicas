<!Doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="./assets/css/mainBlog.css">
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

    <main class="container" id="mainBlog-ayuditicas">
        <div class="p-4 p-md-5 mb-4 mt-4 rounded text-body-emphasis fondo-bloque">
            <div class="row">
            <div class="col-lg-9 px-0">
                <h2 class="display-5 link-body-emphasis mb-1">
                Tecnología y Acción Humana para Salvar el Medio Ambiente
                </h2>
            </div>
            <div class="col text-center">
                <img class="" src="./assets/img/logoAyuditicas_Cafe.png" width="130px" alt="Logo_Ayuditicas">
            </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-md-8">

                <article class="blog-post">
                    <p class="blog-post-meta">Julio 11, 2024 <a href="#">Usuario</a></p>

                    <p></p>
                    <hr>
                    <div style="white-space: pre-line;">El medio ambiente enfrenta desafíos sin precedentes debido a la actividad humana, pero las personas y las tecnologías emergentes están desempeñando un papel crucial en la lucha por preservar nuestro planeta. 
                        
                    Desde la adopción de energías renovables hasta la implementación de prácticas sostenibles, estamos viendo un cambio global hacia un enfoque más consciente del impacto ambiental. Este cambio es vital para combatir el cambio climático, conservar la biodiversidad y asegurar un futuro saludable para las próximas generaciones.</div>
                    <br>
                    <img src="https://media.licdn.com/dms/image/v2/D4D12AQHiXzJpQlRjfA/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1681344088674?e=2147483647&v=beta&t=LJ-Zw2a_Xkz3ED8lF3IBi2IO5toH8sbG1lPzG06J4xY" alt="" class="imagen-ajustada">

                    <div style="white-space: pre-line;">
                        La protección del medio ambiente es un esfuerzo colectivo que requiere la participación activa de individuos, comunidades, empresas y gobiernos. La tecnología y la innovación proporcionan herramientas poderosas para abordar los desafíos ambientales, pero es esencial adoptar una mentalidad de sostenibilidad en nuestra vida diaria. Solo a través de una combinación de tecnología, educación y acción consciente podemos garantizar un futuro en el que el planeta prospere y sus recursos se preserven para las futuras generaciones.
                    </div>
                    <br>
                </article> 
            </div>
            <aside id="publicaciones-recientes" class="col-md-4 ">
                <div class="position-sticky" style="top: 2rem;">

                    <div>
                        <h4 class="fst-italic">Publicaciones Recientes</h4>
                        <ul class="list-unstyled">
                        <?php
                        for ($i=0; $i<6; $i++){
                            
                            include './templates/Blog/nuevasPubli.php';
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </aside>
            
        </div>

    </main>

    <footer class=" mainfooter">
        <?php include './templates/Header&Footer/footer.php';
        ?></footer>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</html>