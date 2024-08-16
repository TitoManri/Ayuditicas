<?php
require_once '../models/registroSesionModel.php';

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

$registroUsu = new registroSesionModel();

$registroUsu->setNombrePersona($nombrePersona);
$registroUsu->setPrimerApellido($PrimerApellido);
$registroUsu->setSegundoApellido($SegundoApellido);
$registroUsu->setGenero($Genero);
$registroUsu->setFechaNacimiento($FechaNacimiento);
$registroUsu->setCorreo($Correo);
$registroUsu->setCedula($Cedula);
$registroUsu->setTelefono($Telefono);
$registroUsu->setNombreUsuario($NombreUsuario);
$registroUsu->setContrasenia($contrasenia);

try {
    $response = $registroUsu->guardarUsuario();
    echo $response;
} catch (PDOException $th) {
    $resp = array("exito" => false, "msg" => "Se presentó un error en la base de datos.");
    echo json_encode($resp);
} catch (Exception $ex) {
    $resp = array("exito" => false, "msg" => $ex->getMessage());
    echo json_encode($resp);
}
?>
