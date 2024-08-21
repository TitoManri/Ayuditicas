<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/perfilModel.php';

$op = isset($_POST['op']) ? $_POST['op'] : '';
$nombrePersona = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
$primerApellido = isset($_POST["primer_apellido"]) ? $_POST["primer_apellido"] : "";
$segundoApellido = isset($_POST["segundo_apellido"]) ? $_POST["segundo_apellido"] : "";
$genero = isset($_POST["genero"]) ? $_POST["genero"] : "";
$fechaNacimiento = isset($_POST["fechaNacimiento"]) ? $_POST["fechaNacimiento"] : "";
$correo = isset($_POST["correo"]) ? $_POST["correo"] : "";
$cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";
$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
$nombreUsuario = isset($_POST["nombre_usuario"]) ? $_POST["nombre_usuario"] : "";
$contrasenia = isset($_POST["contrasenia"]) ? $_POST["contrasenia"] : "";
$img = isset($_POST["imagen"]) ? $_POST["imagen"] : "";

$usuario = new perfilModel();

switch ($op) {
    case "mostrarPerfil":
        $usuario->setNombrePersona($nombrePersona);
        $usuario->setPrimerApellido($primerApellido);
        $usuario->setSegundoApellido($segundoApellido);
        $usuario->setGenero($genero);
        $usuario->setFechaNacimiento($fechaNacimiento);
        $usuario->setCorreo($correo);
        $usuario->setCedula($cedula);
        $usuario->setTelefono($telefono);
        $usuario->setNombreUsuario($nombreUsuario);
        $usuario->setImg($img);
        
        try{
            $usuarios = $usuario->mostrarPerfil($cedula);
            echo $usuarios;
        } catch (Exception $e) {
            echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
        }   
    break;
    case "actualizarPerfil":
        $usuario->setNombrePersona($nombrePersona);
        $usuario->setPrimerApellido($primerApellido);
        $usuario->setSegundoApellido($segundoApellido);
        $usuario->setGenero($genero);
        $usuario->setFechaNacimiento($fechaNacimiento);
        $usuario->setCorreo($correo);
        $usuario->setCedula($cedula); 
        $usuario->setTelefono($telefono);
        $usuario->setNombreUsuario($nombreUsuario); 
        $usuario->setImg($img);
        try {
            $usuarios = $usuario->actualizarPerfil();
            echo $usuarios;
        } catch (Exception $e) {
            echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
        }
    break;
}
?>