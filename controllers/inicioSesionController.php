<?php
require_once '../models/inicioSesionModel.php';
function iniciarSesion() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombreUsuario = $_POST['nombreUsuario'] ?? '';
        $contrasenia = $_POST['contrasenia'] ?? '';

        // Validar datos
        // Redirigira a un mensaje de error
        if (empty($nombreUsuario) || empty($contrasenia)) {
            header('Location: index.php?controller=usuario&action=login&error=1');
            exit();
        }

        $usuarioModel = new inicioSesionModel();
        $usuarioModel->setNombreUsuario($nombreUsuario);
        $usuarioModel->setContrasenia($contrasenia);
        $encontrado = $usuarioModel->verificarExistenciaDb($nombreUsuario, $contrasenia);

        // Usuario autenticado correctamente
        if ($encontrado) {
            session_start();
            $_SESSION['inicioSesion'] = true;
            $_SESSION['nombreUsuario'] = $nombreUsuario;

            // Redirigir a la página principal
            header('Location: index.php?controller=usuario&action=dashboard');
            exit();
        } else {
            // Autenticación fallida
            header('Location: index.php?controller=usuario&action=login&error=1');
            exit();
        }
    } else {
        exit();
    }
}

function login() {
    // Mostrar la vista de inicio de sesión
    require_once 'views/login.php';
}

// Lógica para determinar qué acción tomar
$action = $_GET['action'] ?? 'login';
switch ($action) {
    case 'iniciarSesion':
        iniciarSesion();
        break;
    default:
        login();
        break;
}
?>