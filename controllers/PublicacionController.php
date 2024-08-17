<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/PublicacionModel.php';

$op = isset($_POST['op']) ? $_POST['op'] : '';
$cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";
$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
$inscripcion = isset($_POST["inscripcion"]) ? $_POST["inscripcion"] : "";
$campaniaSeleccionada = isset($_POST["campaniaSeleccionada"]) ? $_POST["campaniaSeleccionada"] : "";
$tags = isset($_POST["tags"]) ? $_POST["tags"] : "";
$img = isset($_FILES["imagen"]["name"]) ? $_FILES["imagen"]["name"] : "";
$id_publicacion = isset($_POST["id_publicacion"]) ? $_POST["id_publicacion"] : "";
$id_campania = isset($_POST["id_campania"]) ? $_POST["id_campania"] : "";

$publicacion = new PublicacionModel();

switch ($op) {
    case 'guardar':

        $publicacion->setCedula($cedula);
        $publicacion->setTitulo($titulo);
        $publicacion->setDescripcion($descripcion);
        $publicacion->setImg($img);
        $publicacion->setNumLike(0); 
        $publicacion->setInscripcion($inscripcion);
        $publicacion->setImg(null);

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
        } catch (Exception $e) {
            $resp = array("exitoFormulario" => false, "message" => $e->getMessage());
        }
        echo json_encode($resp);
        break;

    case 'mostrarPublicaciones':
        try {
            $publicaciones = $publicacion->mostrarPublicaciones();
            echo $publicaciones;
        } catch (Exception $e) {
            echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
        }
        break;

    case 'mostrarPorCampania':
        try {
            $publicaciones = $publicacion->mostrarPublicacionesPorCampania($id_campania);
            echo $publicaciones;
        } catch (Exception $e) {
            echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
        }
        break;

    case 'aumentarLike':
        try {
            $response = $publicacion->aumentarNumLikes($id_publicacion);
            echo $response;
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e->getMessage()));
        }
        break;

    case 'reducirLike':
        try {
            $response = $publicacion->reducirNumLikes($id_publicacion);
            echo $response;
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e->getMessage()));
        }
        break;

    default:
        echo json_encode(array("success" => false, "message" => "Operación no válida"));
        break;
}
?>
