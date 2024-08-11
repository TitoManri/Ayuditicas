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
    public function validarDatos() {
        //Query's de Validacion
        $queryCedula = "SELECT count(`cedula`) FROM `usuarios` WHERE cedula = ;";
        $queryNombreUsuario = "SELECT count(`nombre_usuario`) FROM `usuarios` WHERE nombre_usuario = :nombreUsuariaValPDO;";
        $queryTelefono = "SELECT count(`telefono`) FROM `usuarios` WHERE telefono = :telefonoValPDO;";
        $queryCorreo = "SELECT count(`correo`) FROM `usuarios` WHERE correo = :correoValPDO;";

        //Variables de Validacion
        $cedulaValidacion = $this->getCedula();
        $nombreUsuarioValidacion = $this->getNombreUsuario();
        $telefonoValidacion = $this->getTelefono();
        $correoValidacion = $this->getCorreo();

        try{
            self::getConexion();
            $resultadoCedula = self::$cnx->prepare($queryCedula);
            $resultadoCedula->bindParam(':cedulaValPDO', $cedulaValidacion);
            $resultadoCedula->execute();
            $countCedula = $resultadoCedula->fetchColumn();
            if($countCedula == 0){
                $resultadoNU = self::$cnx->prepare($queryNombreUsuario);
                $resultadoNU->bindParam(':nombreUsuariaValPDO', $nombreUsuarioValidacion);
                $resultadoNU->execute();
                $countNU = $resultadoNU->fetchColumn();
                if($countNU == 0){
                    $resultadoTelefono = self::$cnx->prepare($queryTelefono);
                    $resultadoTelefono->bindParam(':telefonoValPDO', $telefonoValidacion);
                    $resultadoTelefono->execute();
                    $countTelefono = $resultadoTelefono->fetchColumn();
                    if($countTelefono == 0){
                        $resultadoCorreo = self::$cnx->prepare($queryCorreo);
                        $resultadoCorreo->bindParam(':correoValPDO', $correoValidacion); 
                        $resultadoCorreo->execute();
                        $countCorreo = $resultadoCorreo->fetchColumn(); 
                        if($countCorreo == 0){
                            //o que cuando se temine de validar se guarde
                        }else{
                            throw new Exception("Utiliza otro correo, ese parece ya estar en uso");
                        }
                    }else{
                        throw new Exception("Utiliza otro telefono, ese ya esta siendo utilizado");
                    }
                }else{
                    throw new Exception("Ese nombre de usuario ya esta en uso");
                }
            }else{
                throw new Exception("Revisa tu cedula, esa ya se encuentra en uso");
            }
        }catch(PDOException $ex){
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }

    public function guardarRegistro() {
        $this->validarDatos();

        $query = "INSERT INTO USUARIOS (cedula, nombre, primer_apellido, segundo_apellido, genero,fecha_nacimiento, nombre_usuario, telefono, correo, contrasena) 
        VALUES (:cedulaPDO, :nombrePersonaPDO, :primerApellidoPDO, :segundoApellidoPDO, :generoPDO ,STR_TO_DATE(:fechaNacimientoPDO, '%Y-%m-%d'), :nombreUsuarioPDO, :telefonoPDO, :correoPDO, :contraseniaPDO);";

        try {
            self::getConexion();
            $cedula = $this->getCedula();
            $nombrePersona = $this->getNombrePersona();
            $PrimerApellido = $this->getPrimerApellido();
            $SegundoApellido = $this->getSegundoApellido();
            $Genero = $this->getGenero();
            $FechaNacimiento = $this->getFechaNacimiento();
            $nombreUsuario = $this->getNombreUsuario();
            $Telefono = $this->getTelefono();
            $Correo = $this->getCorreo();
            $contrasenia = $this->getContrasenia();

            $resultado = self::$cnx->prepare($query);

            $resultado->bindParam(":cedulaPDO", $cedula, PDO::PARAM_STR);
            $resultado->bindParam(":nombrePersonaPDO", $nombrePersona, PDO::PARAM_STR);
            $resultado->bindParam(":primerApellidoPDO", $PrimerApellido, PDO::PARAM_STR);
            $resultado->bindParam(":segundoApellidoPDO", $SegundoApellido, PDO::PARAM_STR);
            $resultado->bindParam(":generoPDO", $Genero, PDO::PARAM_STR);
            $resultado->bindParam(":fechaNacimientoPDO", $FechaNacimiento, PDO::PARAM_STR);
            $resultado->bindParam(":nombreUsuarioPDO", $nombreUsuario, PDO::PARAM_STR);
            $resultado->bindParam(":telefonoPDO", $Telefono, PDO::PARAM_STR);
            $resultado->bindParam(":correoPDO", $Correo, PDO::PARAM_STR);
            $resultado->bindParam(":contraseniaPDO", $contrasenia, PDO::PARAM_STR);

            $resultado->execute();
            self::desconectar();
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }
}
?>
