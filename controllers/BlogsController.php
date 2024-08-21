<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

error_log(print_r($_POST, true));
error_log(print_r($_FILES, true));

require_once '../models/BlogsModel.php';

$op = isset($_POST['op']) ? $_POST['op'] : '';
$cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";
$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : "";
$contenido = isset($_POST["contenido"]) ? $_POST["contenido"] : "";
$img = isset($_FILES["imagen"]) ? $_FILES["imagen"] : null; 
$id_blog = isset($_POST["id_blog"]) ? $_POST["id_blog"] : "";

$blog = new BlogModel();

switch ($op) {
    case 'guardar':
        $blog->setCedula($cedula);
        $blog->setTitulo($titulo);
        $blog->setContenido($contenido);
        $blog->setImg(null); 
        $blog->setNumLike(0); 
    
        try {
            if (empty($titulo) || empty($contenido)) {
                throw new Exception("Todos los campos obligatorios deben ser completados.");
            }
    
            $idBlog = $blog->guardarDatosBlog();
            
            if ($idBlog) {
                if ($img && $img['error'] == UPLOAD_ERR_OK) {
                    $uploadDir = '../views/assets/img_app/blogs/';
                    $fileTmpPath = $img['tmp_name'];
                    $fileName = $img['name'];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));
                    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
                    
                    if (in_array($fileExtension, $allowedExts)) {
                        $newFileName = uniqid('img_', true) . '.' . $fileExtension;
                        $destPath = $uploadDir . $newFileName;
                        
                        if (move_uploaded_file($fileTmpPath, $destPath)) {
                            $blog->setImg($newFileName);
                            $blog->actualizarImagen($idBlog, $newFileName); 
                            $resp = array("exitoFormulario" => true, "message" => "Blog y imagen creados exitosamente");
                        } else {
                            $resp = array("exitoFormulario" => true, "message" => "Blog creado, pero no se pudo subir la imagen.");
                        }
                    } else {
                        $resp = array("exitoFormulario" => false, "message" => "Extensión de archivo no permitida.");
                    }
                } else {
                    $resp = array("exitoFormulario" => true, "message" => "Blog creado exitosamente, sin imagen.");
                }
            } else {
                $resp = array("exitoFormulario" => false, "message" => "Error al crear el blog.");
            }
        } catch (Exception $e) {
            $resp = array("exitoFormulario" => false, "message" => $e->getMessage());
        }
        echo json_encode($resp);
        break;

    case 'mostrarBlogs':
        try {
            $blogs = $blog->mostrarBlogs($cedula);
            echo $blogs;
        } catch (Exception $e) {
            echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
        }
        break;

    case 'obtenerBlog': 
        try {
            if (empty($id_blog)) {
                throw new Exception("El ID del blog es obligatorio.");
            }
            $blogDetalles = $blog->obtenerBlog($id_blog);
            if ($blogDetalles) {
                echo $blogDetalles;
            } else {
                throw new Exception("No se encontraron detalles para este blog.");
            }
        } catch (Exception $e) {
            error_log("Error en obtener detalles del blog: " . $e->getMessage());
            echo json_encode(["exitoFormulario" => false, "message" => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(array("success" => false, "message" => "Operación no válida"));
        break;
}
