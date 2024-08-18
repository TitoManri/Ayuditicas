<?php
require_once '../config/conexion.php';
class perfilModel extends conexion {
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
    private $img=null;
    private $FechaUnion=null;

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

    public function getImg() {
        return $this->img;
    }

    public function getFechaUnion() {
        return $this->FechaUnion;
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

    public function setImg($img) {
        $this->img = $img;
    }

    public function setFechaUnion($FechaUnion) {
        $this->FechaUnion = $FechaUnion;
    }

    public function __construct() {
        
    }

    public static function getConexion() {
        self::$cnx = conexion::conectar();
    }

    public static function desconectar() {
        self::$cnx = null;
    }

    public function actualizarPerfil($Cedula) {
        $queryUpdate = "UPDATE `usuarios` SET `cedula`=':ceduloPDO',`nombre`=':nombrePersonaPDO',`primer_apellido`=':primerApellidoPDO',
                        `segundo_apellido`=':segundoApellidoPDO',`genero`=':generoPDO',`fecha_nacimiento`=':fechaNacimientoPDO',
                        `nombre_usuario`=':nombreUsuarioPDO',`telefono`=':telefonoPDO',`correo`=':correoPDO',`contrasena`=':contraseniaPDO',
                        `img`=':imgPDO',`fecha_creacion`=':FechaUnionPDO' WHERE 1";

        try {

            $cedulaPDO = $this->getCedula();
            $nombrePersonaPDO = $this->getNombrePersona();
            $primerApellidoPDO = $this->getPrimerApellido();
            $segundoApellidoPDO = $this->getSegundoApellido();
            $generoPDO = $this->getGenero();
            $fechaNacimientoPDO = $this->getFechaNacimiento();
            $nombreUsuarioPDO = $this->getNombreUsuario();
            $telefonoPDO = $this->getTelefono();
            $correoPDO = $this->getCorreo();
            $contrasenaPDO = $this->getContrasenia();
            $imgPDO = $this->getImg();
            $FechaUnionPDO = $this->getFechaUnion();

            self::getConexion();
            
            $usuUpdate = self::$cnx->prepare($queryUpdate);
            $usuUpdate->bindParam(":cedulaPDO", $cedulaPDO);
            $usuUpdate->bindParam(":nombrePersonaPDO", $nombrePersonaPDO);
            $usuUpdate->bindParam(":primerApellidoPDO", $primerApellidoPDO);
            $usuUpdate->bindParam(":segundoApellidoPDO", $segundoApellidoPDO);
            $usuUpdate->bindParam(":generoPDO", $generoPDO);
            $usuUpdate->bindParam(":fechaNacimientoPDO", $fechaNacimientoPDO);
            $usuUpdate->bindParam(":nombreUsuarioPDO", $nombreUsuarioPDO);
            $usuUpdate->bindParam(":telefonoPDO", $telefonoPDO);
            $usuUpdate->bindParam(":correoPDO", $correoPDO);
            $usuUpdate->bindParam(":contraseniaPDO", $contrasenaPDO);
            $usuUpdate->bindParam(":imgPDO", $imgPDO);
            $usuUpdate->bindParam(":FechaUnionPDO", $FechaUnionPDO);
            
            $usuUpdate->execute();
            self::desconectar();
            
            return json_encode($usuUpdate);
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }

    }


}
?>