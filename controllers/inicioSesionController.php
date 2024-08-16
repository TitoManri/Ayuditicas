<?php
require_once '../models/inicioSesionModel.php';

$nombreUsuario = $_POST['nombreUsuario'] ?? '';
$contrasenia = $_POST['contrasenia'] ?? '';

$usuarioModel = new inicioSesionModel();
$usuarioModel->setNombreUsuario($nombreUsuario);
$usuarioModel->setContrasenia($contrasenia);

try {
    if ($usuarioModel->verificarExistenciaDb()) {
        session_start();
        $_SESSION['inicioSesion'] = true;
        $_SESSION['cedula'] = $usuarioModel->getCedula();
        $_SESSION['nombre'] = $usuarioModel->getNombre();
        $_SESSION['primerApellido'] = $usuarioModel->getPrimerApellido();
        $_SESSION['segundoApellido'] = $usuarioModel->getSegundoApellido();
        $_SESSION['genero'] = $usuarioModel->getGenero();
        $_SESSION['fechaNacimiento'] = $usuarioModel->getFechaNacimiento();
        $_SESSION['nombreUsuario'] = $nombreUsuario;
        $_SESSION['telefono'] = $usuarioModel->getTelefono();
        $_SESSION['correo'] = $usuarioModel->getCorreo();
        $_SESSION['numSeguidores'] = $usuarioModel->getNumSeguidores();
        $_SESSION['img'] = $usuarioModel->getImg();

        $response = array("exito" => true, "msg" => "Inicio de sesión exitoso");
    } else {
        $response = array("exito" => false, "msg" => "Usuario o contraseña incorrectos");
    }
} catch (PDOException $e) {
    $response = array("exito" => false, "msg" => "Error al intentar iniciar sesión: " . $e->getMessage());
}

echo json_encode($response);

?>