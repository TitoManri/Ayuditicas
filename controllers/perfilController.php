<?php
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
$imgPDO = isset($_POST["imagen"]) ? $_POST["imagen"] : "";
$FechaUnionPDO = isset($_POST["fecha_creacion"]) ? $_POST["fecha_creacion"] :

$perfil = new PerfilModel();

switch ($op) {
    case "cambiarDatos":
        try {
            $perfil = $perfil->actualizarPerfil($cedula);
            echo $perfil;
        } catch (Exception $e) {
            echo json_encode(array("exitoFormulario" => false, "message" => $e->getMessage()));
        }
    break;
}


?>