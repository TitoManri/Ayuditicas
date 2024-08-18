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
$img = isset($_FILES["imagen"]) ? $_FILES["imagen"] : null; 
$id_publicacion = isset($_POST["id_publicacion"]) ? $_POST["id_publicacion"] : "";
$id_campania = isset($_POST["id_campania"]) ? $_POST["id_campania"] : "";

$publicacion = new PublicacionModel();

switch ($op) {
    case 'guardar':
        $publicacion->setCedula($cedula);
        $publicacion->setTitulo($titulo);
        $publicacion->setDescripcion($descripcion);
        $publicacion->setImg(null); 
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
    
            $idPublicacion = $publicacion->guardarDatosPublicacionRegular();
            
            if ($idPublicacion) {
                if ($img && $img['error'] == UPLOAD_ERR_OK) {
                    $uploadDir = '../views/assets/img_app/publicaciones/';
                    $fileTmpPath = $img['tmp_name'];
                    $fileName = $img['name'];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));
                    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
                    
                    if (in_array($fileExtension, $allowedExts)) {
                        $newFileName = uniqid('img_', true) . '.' . $fileExtension;
                        $destPath = $uploadDir . $newFileName;
                        
                        if (move_uploaded_file($fileTmpPath, $destPath)) {
                            $publicacion->setImg($newFileName);
                            $publicacion->actualizarImagen($idPublicacion, $newFileName); 
                            $resp = array("exitoFormulario" => true, "message" => "Publicación y imagen creadas exitosamente");
                        } else {
                            $resp = array("exitoFormulario" => true, "message" => "Publicación creada, pero no se pudo subir la imagen.");
                        }
                    } else {
                        $resp = array("exitoFormulario" => false, "message" => "Extensión de archivo no permitida.");
                    }
                } else {
                    $resp = array("exitoFormulario" => true, "message" => "Publicación creada exitosamente, sin imagen.");
                }
            } else {
                $resp = array("exitoFormulario" => false, "message" => "Error al crear la publicación.");
            }
        } catch (Exception $e) {
            $resp = array("exitoFormulario" => false, "message" => $e->getMessage());
        }
        echo json_encode($resp);
        break;    

    case 'mostrarPublicaciones':
        try {
            $publicaciones = $publicacion->mostrarPublicaciones($cedula);
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
            $response = $publicacion->aumentarLike($id_publicacion, $cedula);
            echo $response;
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e->getMessage()));
        }
        break;

    case 'reducirLike':
        try {
            $response = $publicacion->reducirLike($id_publicacion, $cedula);
            echo $response;
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e->getMessage()));
        }
        break;

    case 'verificarLike':
        try {
            $hasLiked = $publicacion->verificarLike($id_publicacion, $cedula);
            echo json_encode(["hasLiked" => $hasLiked]);
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "message" => $e->getMessage()));
        }
        break;
        case 'obtenerPublicacion': 
            try {
                if (empty($id_publicacion)) {
                    throw new Exception("El ID de la publicación es obligatorio.");
                }
                $publicacionDetalles = $publicacion->obtenerPublicacion($id_publicacion);
                echo $publicacionDetalles;
            } catch (Exception $e) {
                error_log("ID de la publicación no recibido en la operación: $op");
                echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
            }
            break;

    default:
        echo json_encode(array("success" => false, "message" => "Operación no válida"));
        break;
}
?>
