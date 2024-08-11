<?php
require_once '../config/conexion.php';
class registroSesionModel extends conexion {
    protected static $cnx;

    private $NombrePersona=null;
    private $PrimerApellido=null;
    private $SegundoApellido=null;
    private $Genero=null;
    private $FechaNacimiento=null;
    private $Correo=null;
    private $Cedula=null;
    private $Telefono=null;
    private $NombreUsuario=null;
    private $contrasenia=null;

    public function getNombrePersona() {
        return $this->NombrePersona;
    }

    public function getPrimerApellido() {
        return $this->PrimerApellido;
    }

    public function getSegundoApellido() {
        return $this->SegundoApellido;
    }
    
    public function getGenero() {
        return $this->Genero;
    }

    public function getFechaNacimiento() {
        return $this->FechaNacimiento;
    }

    public function getCorreo() {
        return $this->Correo;
    }

    public function getCedula() {
        return $this->Cedula;
    }

    public function getTelefono() {
        return $this->Telefono;
    }

    public function getNombreUsuario() {
        return $this->NombreUsuario;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function setNombrePersona($NombrePersona) {
        $this->NombrePersona = $NombrePersona;
    }

    public function setPrimerApellido($PrimerApellido) {
        $this->PrimerApellido = $PrimerApellido;
    }

    public function setSegundoApellido($SegundoApellido) {
        $this->SegundoApellido = $SegundoApellido;
    }

    public function setGenero($Genero) {
        $this->Genero = $Genero;
    }

    public function setFechaNacimiento($FechaNacimiento) {
        $this->FechaNacimiento = $FechaNacimiento;
    }

    public function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    public function setCedula($Cedula) {
        $this->Cedula = $Cedula;
    }

    public function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    public function setNombreUsuario($NombreUsuario) {
        $this->NombreUsuario = $NombreUsuario;
    }

    public function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    public function __construct() {
        
    }

    public static function getConexion() {
        self::$cnx = conexion::conectar();
    }

    public static function desconectar() {
        self::$cnx = null;
    }

/*
a. Tines que validar 
    1. Cedula
    2. Nombre Usuario
    3. Correo
    4. Telefono

b. Encriptar la contrasena
*/


/* 
Validar datos (cedula, nombre Usuario, telefono, correo) y despues si algo sale mal, se lanza un error y ese error tiene que especificar cual fue el que estaba malo.
1. Definir las variables 
2. Hacer una condicion que valide si la cedula ya esta en la base de datos. (Ej. 11920433 == True {Tiene que lanzar un error} PERO 11920433 == False {Pasa la condicion y sigue con al otra })
3. Hacer una validacion de nombreUsuario
4. Hacer una validacion de correo 
5. Hacer una validacion de telefono 

a.Abrimos la funcion de insert 
b.Validamos los datos {Si algo sale mal, se corta}
c*. Insertamos los datos
d.Le decimos al usuario que todo salio correctamente.

Cuando ya todos estos datos se validen despues de tiene que hacer un insert sobre la base de datos.
*/
public function guardarUsuario() {
    // Consultas para validación
    $queryCedula = "SELECT COUNT(*) FROM usuarios WHERE cedula = :cedulaValPDO;";
    $queryNombreUsuario = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = :nombreUsuariaValPDO;";
    $queryTelefono = "SELECT COUNT(*) FROM usuarios WHERE telefono = :telefonoValPDO;";
    $queryCorreo = "SELECT COUNT(*) FROM usuarios WHERE correo = :correoValPDO;";

    // Variables de validación
    $cedulaValidacion = $this->getCedula();
    $nombreUsuarioValidacion = $this->getNombreUsuario();
    $telefonoValidacion = $this->getTelefono();
    $correoValidacion = $this->getCorreo();

    try {
        self::getConexion();

        // Validar cédula
        $resultadoCedula = self::$cnx->prepare($queryCedula);
        $resultadoCedula->bindParam(':cedulaValPDO', $cedulaValidacion);
        $resultadoCedula->execute();
        $countCedula = $resultadoCedula->fetchColumn();
        if ($countCedula > 0) {
            throw new Exception("Revisa tu cédula, esa ya se encuentra en uso");
        }

        // Validar nombre de usuario
        $resultadoNU = self::$cnx->prepare($queryNombreUsuario);
        $resultadoNU->bindParam(':nombreUsuariaValPDO', $nombreUsuarioValidacion);
        $resultadoNU->execute();
        $countNU = $resultadoNU->fetchColumn();
        if ($countNU > 0) {
            throw new Exception("Ese nombre de usuario ya está en uso");
        }

        // Validar teléfono
        $resultadoTelefono = self::$cnx->prepare($queryTelefono);
        $resultadoTelefono->bindParam(':telefonoValPDO', $telefonoValidacion);
        $resultadoTelefono->execute();
        $countTelefono = $resultadoTelefono->fetchColumn();
        if ($countTelefono > 0) {
            throw new Exception("Utiliza otro teléfono, ese ya está siendo utilizado");
        }

        // Validar correo
        $resultadoCorreo = self::$cnx->prepare($queryCorreo);
        $resultadoCorreo->bindParam(':correoValPDO', $correoValidacion);
        $resultadoCorreo->execute();
        $countCorreo = $resultadoCorreo->fetchColumn();
        if ($countCorreo > 0) {
            throw new Exception("Utiliza otro correo, ese parece ya estar en uso");
        }

        // Insertar registro si todo está bien
        $queryInsert = "INSERT INTO usuarios (cedula, nombre, primer_apellido, segundo_apellido, genero, fecha_nacimiento, nombre_usuario, telefono, correo, contrasena) 
                        VALUES (:cedulaPDO, :nombrePersonaPDO, :primerApellidoPDO, :segundoApellidoPDO, :generoPDO, STR_TO_DATE(:fechaNacimientoPDO, '%Y-%m-%d'), :nombreUsuarioPDO, :telefonoPDO, :correoPDO, :contraseniaPDO);";

        $resultadoInsert = self::$cnx->prepare($queryInsert);
        $resultadoInsert->bindParam(":cedulaPDO", $cedulaValidacion);
        $resultadoInsert->bindParam(":nombrePersonaPDO", $this->getNombrePersona());
        $resultadoInsert->bindParam(":primerApellidoPDO", $this->getPrimerApellido());
        $resultadoInsert->bindParam(":segundoApellidoPDO", $this->getSegundoApellido());
        $resultadoInsert->bindParam(":generoPDO", $this->getGenero());
        $resultadoInsert->bindParam(":fechaNacimientoPDO", $this->getFechaNacimiento());
        $resultadoInsert->bindParam(":nombreUsuarioPDO", $nombreUsuarioValidacion);
        $resultadoInsert->bindParam(":telefonoPDO", $telefonoValidacion);
        $resultadoInsert->bindParam(":correoPDO", $correoValidacion);
        $resultadoInsert->bindParam(":contraseniaPDO", $this->getContrasenia());

        $resultadoInsert->execute();
        self::desconectar();

        // Respuesta exitosa
        return json_encode(array("exito" => true, "msg" => "Usuario registrado correctamente"));

    } catch (PDOException $ex) {
        self::desconectar();
        // Respuesta de error en caso de problema con la base de datos
        return json_encode(array("exito" => false, "msg" => "Error en la base de datos: " . $ex->getMessage()));
    } catch (Exception $ex) {
        self::desconectar();
        // Respuesta de error en caso de excepción general
        return json_encode(array("exito" => false, "msg" => $ex->getMessage()));
    }
}
}
?>
