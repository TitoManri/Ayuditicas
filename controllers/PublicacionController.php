<?php
require_once '../models/PublicacionModel.php';

$cedula = (isset($_POST["cedula"])) ? $_POST["cedula"] : "";
$titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
$descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
$inscripcion = (isset($_POST["inscripcion"])) ? $_POST["inscripcion"] : "";
$campaniaSeleccionada = (isset($_POST["campaniaSeleccionada"])) ? $_POST["campaniaSeleccionada"] : "";
$tags = (isset($_POST["tags"])) ? $_POST["tags"] : "";
$img = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";

$targetDir = "../views/assets/img_app/";
$targetFile = $targetDir . basename($_FILES["imagen"]["name"]);
move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile);

$publicacion = new PublicacionModel();
$publicacion->setCedula(119320433);
$publicacion->setTitulo($titulo);
$publicacion->setDescripcion($descripcion);
$publicacion->setImg($img);
$publicacion->setNumLike(0); 
$publicacion->setInscripcion($inscripcion);

if ($inscripcion == "1") {
    $publicacion->setIdCampania($campaniaSeleccionada);
} else {
    $publicacion->setIdCampania(null); 
}

try {
    if (empty($titulo) || empty($descripcion)) {
        throw new Exception("Todos los campos obligatorios deben ser completados.");
    }
    $publicacion->guardarDatosPublicacionRegular();
    $resp = array("exitoFormulario" => true, "message" => "Publicación creada exitosamente");
    echo json_encode($resp);
} catch (Exception $e) {
    $resp = array("exitoFormulario" => false, "message" => $e->getMessage());
    echo json_encode($resp);
}
?>
