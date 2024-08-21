<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/PublicacionModel.php';
require_once "../models/Publicaciones_etiquetas.php";

$op = isset($_POST['op']) ? $_POST['op'] : '';
$cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";
$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
$inscripcion = isset($_POST["inscripcion"]) ? $_POST["inscripcion"] : "";
$campaniaSeleccionada = isset($_POST["campaniaSeleccionada"]) ? $_POST["campaniaSeleccionada"] : "";
$tags = isset($_POST["tags"]) ? $_POST["tags"] : "";
$valoresEtiquetas = [];
if($tags != ""){
    $etiquetasArray = json_decode($tags, true);
    $valoresEtiquetas = [];
    foreach ($etiquetasArray as $etiqueta) {
        $valoresEtiquetas[] = $etiqueta['value'];
    }
}
$img = isset($_FILES["imagen"]) ? $_FILES["imagen"] : null; 
$id_publicacion = isset($_POST["id_publicacion"]) ? $_POST["id_publicacion"] : "";
$id_campania = isset($_POST["id_campania"]) ? $_POST["id_campania"] : "";

$publicacion = new PublicacionModel();
$pub_eti = new Publicaciones_etiquetas();

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
    
            // Primero guarda la publicación
            $idPublicacion = $publicacion->guardarDatosPublicacionRegular();
            $id_publicacionUltima = $publicacion -> conseguirUltimoID();
            if ($idPublicacion) {
                if ($img && $img['error'] == UPLOAD_ERR_OK) {
                    $uploadDir = '../views/assets/img_app/publicaciones/';
                    $fileTmpPath = $img['tmp_name'];
                    $fileName = $img['name'];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));
                    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
                    
                    if (in_array($fileExtension, $allowedExts)) {
                        $newFileName = $idPublicacion . '.' . $fileExtension;
                        $destPath = $uploadDir . $newFileName;
                        
                        if (move_uploaded_file($fileTmpPath, $destPath)) {
                            // Actualiza la publicación con el nombre de la imagen
                            $publicacion->setImg($newFileName);
                            $publicacion->actualizarImagen($idPublicacion, $newFileName); 
                            $resp = array("exitoFormulario" => true, "message" => "Publicación y imagen creadas exitosamente");
                            if(count($valoresEtiquetas) != 0){
                                $pub_eti -> insertarEtiquetasPosts($valoresEtiquetas, $id_publicacionUltima, 1);
                            }
                        } else {
                            $resp = array("exitoFormulario" => true, "message" => "Publicación creada, pero no se pudo subir la imagen.");
                            if(count($valoresEtiquetas) != 0){
                                $pub_eti -> insertarEtiquetasPosts($valoresEtiquetas, $id_publicacionUltima, 1);
                            }
                        }
                    } else {
                        $resp = array("exitoFormulario" => false, "message" => "Extensión de archivo no permitida.");
                    }
                } else {
                    $resp = array("exitoFormulario" => true, "message" => "Publicación creada exitosamente, sin imagen.");
                    if(count($valoresEtiquetas) != 0){
                        $pub_eti -> insertarEtiquetasPosts($valoresEtiquetas, $id_publicacionUltima, 1);
                    }
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

        case 'mostrarPublicacionesCamp':{
            try {
                $publicaciones = $publicacion -> mostrarPublicacionesPorCampania($id_campania, $cedula);
                echo $publicaciones;
            } catch (Exception $e) {
                echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
            }
            break; 
        }

    case 'verPublicacionesPorEtiqueta':{
        $etiquetas = "";
        try {
            $idEtiqueta = isset($_POST["ID_Etiqueta"]) ? $_POST["ID_Etiqueta"] : "";
            $ids = $pub_eti->obtenerIdsPorEtiqueta($idEtiqueta);
            $publicacionesEtiqueta = $publicacion -> mostrarPublicacionesPorIds($ids, $cedula);
            echo $publicacionesEtiqueta;
        } catch (Exception $e) {
            echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
        }
        break; 

    }

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
                if ($publicacionDetalles) {
                    echo $publicacionDetalles;
                } else {
                    throw new Exception("No se encontraron detalles para esta publicación.");
                }
            } catch (Exception $e) {
                error_log("Error en obtener detalles de la publicación: " . $e->getMessage());
                echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
            }
        break;

    default:
        echo json_encode(array("success" => false, "message" => "Operación no válida"));
        break;
}
?>
