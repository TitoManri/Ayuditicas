<?php
session_start();
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

// Crear un array con los datos
$data = array(
    'nombre' => $nombre,
    'cedula' => $cedula,
);
$jsonData = json_encode($data);

$ID_Camp = isset($_GET["ID_Camp"]) ? $_GET["ID_Camp"] : "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Campaña</title>
    <!-- Bootstrap & Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/css/campanias.css">
    <link rel="stylesheet" href="./assets/css/headerfooter.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.4/tagify.min.css" rel="stylesheet">
</head>

<div>
    <header class="mainHeader">
        <?php
        $activoCampanias = 'active';
        include './templates/Header&Footer/header.php';
        ?></header>
    <?php
    $nombrePagina = 'Campañas';
    include './templates/Header&Footer/subheader.php';
    ?>
</div>
<br><br>

<section id="NombreCamp" class=" containerD card rounded" style="margin-left: 200px;">
    <br>
    <div class="row">
        <div class="col-3 d-flex justify-content-center">
            <i class="fa fa-solid fa-people-roof fa-7x"></i>
        </div>
        <div class="col-9" id="InfoCamps">

        </div>
    </div>
    <br>
    <div class="row">
        <div id="BotonCampana" class="col-6 px-4">

        </div>
        <div class="col px-4" id="BotonTerminar"></div>
    </div>
    <br>
</section>
<br>
<section id="PostsCamp" class="containerD" style="margin-left: 200px;">
    <h1>Post sobre la campaña</h1><br>
    <div id="publicacionesContainer"></div>
</section>

<div class="col-4 ">
        <button onclick="topFunction()" id="myBtn"><i class="fa-solid fa-caret-up fa-2xl caret"></i></i></button>
        <?php include './templates/Red_Social/asideDerecha.php'; ?>
    </div>
    </div>
<div class="modal fade" id="crearPublicacionModal" aria-hidden="true" aria-labelledby="crearPublicacionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Crear la Publicación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="crearPublicacionForm">
                    <input type="hidden" id="inscripcion" name="inscripcion" value="1">
                    <input type="hidden" name="campaniaSeleccionada" id="campaniaSeleccionada" value="<?php echo $ID_Camp?>">
                    <input type="hidden" id="cedula" value="<?php echo $cedula ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tituloPublicacion" class="form-label">Título de la Publicación</label>
                                <input type="text" class="form-control w-100" id="tituloPublicacion" placeholder="Título de la Publicación" required name="titulo">
                            </div>
                            <div class="mb-3">
                                <label for="descripcionPublicacion" class="form-label">Descripción de la Publicación</label>
                                <textarea class="form-control w-100" id="descripcionPublicacion" rows="5" style="resize: none;" required name="descripcion"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="descripcionPublicacion" class="form-label">¿Esta publicación es para alguna campaña? </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                                    <label class="form-check-label" for="inlineRadio1">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" disabled type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="descripcionPublicacion" class="form-label">Etiquetas (Max.3)</label>
                                <input type="text" name="tags" id="tags" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <center><label for="descripcionPublicacion" class="form-label mt-5">Imagen para la Publicación</label></center>
                            <div class="mb-4 mt-1 d-flex justify-content-center">
                                <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder" style="width: 300px;" />
                            </div>
                            <div class="d-flex justify-content-center mb-4">
                                <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                    <label class="form-label text-white m-1" for="customFile1">Escoja una Foto</label>
                                    <input type="file" class="form-control d-none" id="customFile1" name="imagen" onchange="displaySelectedImage(event, 'selectedImage')" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnNext" type="submit">Crear Publicación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<br><br><br>
<footer class="mainfooter">
    <?php include './templates/Header&Footer/footer.php';
    ?></footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c723dfe3cd.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    let userData = <?php echo $jsonData; ?>;
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.4/tagify.min.js"></script>
<script src="./assets/js/verCampana.js"></script>
<script src="./assets/js/like.js"></script>
<script src="./assets/js/publicacionesConCampana.js"></script>
<script src="./assets/js/rellenarEtiquetas.js"></script>
<script src="./assets/js/botonTop.js"></script>
<script src="./assets/js/asideEtiquetasCamps.js"></script>
</html>