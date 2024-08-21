<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/ComentariosModel.php';

$op = isset($_POST['op']) ? $_POST['op'] : '';
$cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";
$id_publicacion = isset($_POST["id_publicacion"]) ? $_POST["id_publicacion"] : "";
$id_padre = isset($_POST["id_padre"]) ? $_POST["id_padre"] : "";
$tipo_comentario = isset($_POST["tipo_comentario"]) ? $_POST["tipo_comentario"] : "";
$contenido = isset($_POST["contenido"]) ? $_POST["contenido"] : "";

$comentario = new ComentariosModel();

switch ($op) {
    case 'guardar':
        $comentario->setCedula($cedula);
        $comentario->setIdPublicacion($id_publicacion);
        $comentario->setIdPadre($id_padre);
        $comentario->setTipoComentario($tipo_comentario);
        $comentario->setContenido($contenido);

        try {
            if (empty($contenido)) {
                throw new Exception("El contenido del comentario es obligatorio.");
            }

            $idComentario = $comentario->guardarComentario();
            
            if ($idComentario) {
                $resp = array("exitoFormulario" => true, "message" => "Comentario creado exitosamente");
            } else {
                $resp = array("exitoFormulario" => false, "message" => "Error al crear el comentario.");
            }
        } catch (Exception $e) {
            $resp = array("exitoFormulario" => false, "message" => $e->getMessage());
        }
        echo json_encode($resp);
        break;    

    case 'mostrarComentariosPorPublicacion':
        try {
            $comentarios = $comentario->mostrarComentariosPorPublicacion($id_publicacion);
            echo $comentarios;
        } catch (Exception $e) {
            echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
        }
        break;

    default:
        echo json_encode(array("success" => false, "message" => "Operación no válida"));
        break;
}
?>
