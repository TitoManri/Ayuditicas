<?php
require_once '../models/inicioSesionModel.php';

$nombreUsuario = $_POST['nombreUsuario'] ?? '';
$contrasenia = $_POST['contrasenia'] ?? '';

$usuarioModel = new inicioSesionModel();
$usuarioModel->setNombreUsuario($nombreUsuario);
$usuarioModel->setContrasenia($contrasenia);

try {
    // Verificar si el usuario existe
    if ($usuarioModel->verificarExistenciaDb($nombreUsuario, $contrasenia)) {
        session_start();
        $_SESSION['inicioSesion'] = true;
        $_SESSION['nombreUsuario'] = $nombreUsuario;
        $response = array("exito" => true, "msg" => "Inicio de sesión exitoso");
    } else {
        $response = array("exito" => false, "msg" => "Usuario o contraseña incorrectos");
    }
} catch (PDOException $e) {
    $response = array("exito" => false, "msg" => "Error al intentar iniciar sesión");
}

echo json_encode($response);
?>
