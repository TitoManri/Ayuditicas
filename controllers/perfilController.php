<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/perfilModel.php';

$op = isset($_POST['op']) ? $_POST['op'] : '';
$nombrePersona = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
$PrimerApellido = isset($_POST["primer_apellido"]) ? $_POST["primer_apellido"] : "";
$SegundoApellido = isset($_POST["segundo_apellido"]) ? $_POST["segundo_apellido"] : "";
$Genero = isset($_POST["genero"]) ? $_POST["genero"] : "";
$FechaNacimiento = isset($_POST["fechaNacimiento"]) ? $_POST["fechaNacimiento"] : "";
$Correo = isset($_POST["correo"]) ? $_POST["correo"] : "";
$Cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";
$Telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
$NombreUsuario = isset($_POST["nombre_usuario"]) ? $_POST["nombre_usuario"] : "";
$contrasenia = isset($_POST["contrasenia"]) ? $_POST["contrasenia"] : "";
$img = isset($_POST["imagen"]) ? $_POST["imagen"] : "";

$usuario = new perfilModel();

switch ($op) {
    case "mostrarPerfil":
        $usuario->setNombrePersona($nombrePersona);
        $usuario->setPrimerApellido($PrimerApellido);
        $usuario->setSegundoApellido($SegundoApellido);
        $usuario->setGenero($Genero);
        $usuario->setFechaNacimiento($FechaNacimiento);
        $usuario->setCorreo($Correo);
        $usuario->setCedula($Cedula);
        $usuario->setTelefono($Telefono);
        $usuario->setNombreUsuario($NombreUsuario);
        $usuario->setImg($img);
        try{
            $usuarios = $usuario->mostrarPerfil($Cedula);
            echo $usuarios;
        } catch (Exception $e) {
            echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
        }   
    break;
    case "actualizarPerfil":
        $usuario->setNombrePersona($nombrePersona);
        $usuario->setPrimerApellido($PrimerApellido);
        $usuario->setSegundoApellido($SegundoApellido);
        $usuario->setGenero($Genero);
        $usuario->setFechaNacimiento($FechaNacimiento);
        $usuario->setCorreo($Correo);
        $usuario->setCedula($Cedula);
        $usuario->setTelefono($Telefono);
        $usuario->setNombreUsuario($NombreUsuario);
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