<?php
session_start();

if (empty($_SESSION['cedula'])) {
    header('Location: ./inicioSesion.php');
    exit(); 
}else{
    if (isset($_POST['id_rol']) == 1 || isset($_POST['id_rol']) == 2)  {
        header('Location: ./redSocial.php');
        exit(); 
    }elseif (isset($_POST['id_rol']) == 3) {
        header('Location: ./admin.php');
        exit(); 
    }else{
        header('Location: ./inicioSesion.php');
        exit(); 
    }
}

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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link rel="stylesheet" href="../views/assets/css/perfil.css"> 
</head>
<body>
    <header class="mainHeader">
        <?php
        $activoPerfil='active';
         include './templates/Header&Footer/header.php'; ?>
    </header>

    <nav id="CampaniasNav" class="CampaniasNav centro">
        <h2>Perfil</h2>
    </nav>

    <div class="container container-large">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="card card-top">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Columna del perfil -->
                            <div class="col-md-4">
                            <input type="hidden" id="cedula" value="<?php echo $cedula ?>">
                                <div class="text-center">
                                    <img src="https://icones.pro/wp-content/uploads/2021/02/icone-utilisateur.png" class="img-fluid avatar-xxl rounded-circle" alt="">
                                    <br>
                                    <h5 class="font-size-13 mb-2">Nombre Usuario</h5>
                                </div>
                            </div>
                            <!-- Fin col -->

                            <!-- Columna de la biografia -->
                            <div class="col-md-8 datosPerfil">
                                <div id="datosPerfil" class="ms-3">
                                    
                                </div>
                                <button id="editarBtn" data-bs-toggle="modal" data-bs-target="#editarPerfilModal" type="button" class="btn btn-success">Editar Perfil</button>
                            </div>
                            <!-- Fin col -->
                        </div>
                    </div>
                </div>
                <!-- Fin card-top -->
            </div>
            <div class="col-xl-8">
                <!-- Mis publicaciones -->
                <!--Cositas que estan arriba de mis publicaciones-->
                <ul class="nav nav-tabs nav-tabs-custom border-bottom-0 mt-3 nav-justfied" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            <i class="fa-regular fa-rectangle-list fa-xl" style="color: #616d63;"></i></a>
                    </li>
                </ul><!-- fin ul -->
                <section class="card">
                    <div class="tab-content p-3">
                        <div class="tab-pane active show">
                            <div class="d-flex"> 
                                <h4 class="card-title mb-4">Mis Publicaciones</h4> 
                            </div>
                            <section class="row">
                            <?php include './templates/Perfil/publicaciones.php'; ?>
                            <?php include './templates/Perfil/publicaciones.php'; ?>
                            <?php include './templates/Perfil/publicaciones.php'; ?>
                            </section>
                        </div>
                    </div>
                </section>
                <!-- Fin card -->
            </div>
            <!-- Fin col-xl-8 -->

            <!-- Mis Campañas -->
            <div class="col-xl-4">
              <!-- Parte de arriba de la cosita -->
              <ul class="nav nav-tabs nav-tabs-custom border-bottom-0 mt-3 nav-justfied" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">
                  <i class="fa-solid fa-clipboard fa-xl" style="color: #616d63;"></i></a>
                </li>
              </ul>
              <section class="card">
                <?php include './templates/perfil/campanias.php'; ?>
                <?php include './templates/perfil/campanias.php'; ?>
              </section>
            </div>
            <!-- Fin col-xl-4 -->
        </div>
        <!-- Fin row -->
    </div>
    <!-- Fin container -->

    <!-- Este es el modal para la actualizacion de datos de perfil -->
    <div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editarPerfilModalLabel">Nuevos Datos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="editarPerfilForm">
                        <div>
                            <div class="d-flex justify-content-center mb-4">
                                <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg"
                                class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                            </div>
                            <div class="d-flex justify-content-center">
                                <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                    <label class="form-label text-white m-1" for="customFile2">Elegir una foto de Perfil</label>
                                    <input type="file" class="form-control d-none" id="customFile2" name="img" onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                </div>
                            </div>
                        </div>
                        <div id="datosPerfilModal">
                            
                        </div>
                    </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit"  form="editarPerfilForm" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="mainfooter">
        <?php include './templates/Header&Footer/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/Perfil.js"></script>
</body>
</html>
