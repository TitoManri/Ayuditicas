<?php
require_once '../models/registroSesionModel.php';
$NombrePersona = (isset($_POST["nombre"])) ? $_POST["nombre"] : "";
$PrimerApellido = (isset($_POST["primer_apellido"])) ? $_POST["primer_apellido"] : "";
$SegundoApellido = (isset($_POST["segundo_apellidop"])) ? $_POST["segundo_apellidop"] : "";
$Genero = (isset($_POST["genero"])) ? $_POST["genero"] : "";
$FechaNacimiento = (isset($_POST["fechaNacimiento"])) ? $_POST["fechaNacimiento"] : "";
$Correo = (isset($_POST["correo"])) ? $_POST["correo"] : "";
$Cedula = (isset($_POST["cedula"])) ? $_POST["cedula"] : "";
$Telefono = (isset($_POST["telefono"])) ? $_POST["telefono"] : "";
$NombreUsuario = (isset($_POST["nombre_usuario"])) ? $_POST["nombre_usuario"] : "";
$contrasenia = (isset($_POST["contrasenia"])) ? $_POST["contrasenia"] : "";

$registroUsu = new registroSesionModel();

$registroUsu->setNombreUsuario($NombrePersona);
$registroUsu->setPrimerApellido($PrimerApellido);
$registroUsu->setSegundoApellido($SegundoApellido);
$registroUsu->setGenero($Genero);
$registroUsu->setCorreo($FechaNacimiento);
$registroUsu->setFechaNacimiento($Correo);
$registroUsu->setCedula($Cedula);
$registroUsu->setTelefono($Telefono);
$registroUsu->setNombreUsuario($NombreUsuario);
$registroUsu->setContrasenia($contrasenia);

try {
    $registroUsu->guardarconOO();
    $resp = array("exito"=> true,"msg"=>"Persona insertada correctamente");
    echo json_encode($resp);
} catch (PDOException $th) {
    $resp = array("exito"=> false,"msg"=>"Se presento un error");
    echo json_encode($resp);
}
?>