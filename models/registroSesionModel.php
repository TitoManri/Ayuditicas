<?php
require_once '../config/conexion.php';
class registroSesionModel extends conexion{
    protected static $cnx;

    private $id=null;
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

    public function getId() {
        return $this->id;
    }
    
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
    
    public function setId($id) {
        $this->id = $id;
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

    public function __construct(){}

    public static function getConexion(){
        self::$cnx = conexion::conectar();
    }

    public static function desconectar(){
        self::$cnx = null;
    }

    public function guardarconOO(){ 
        $query = "INSERT INTO `USUARIOS`(`nombrePersona`, `PrimerApellido`, `SegundoApellido`, `Genero`, `FechaNacimiento`, `Correo`, `Cedula`, `Telefono`, `Nombre_usuario`, `contrasenia`) 
            VALUES (:nombrePersonaPDO, :PrimerApellidoPDO, :SegundoApellidoPDO, :GeneroPDO, :FechaNacimientoPDO, :CorreoPDO, :CedulaPDO, :TelefonoPDO, :Nombre_usuarioPDO, :contraseniaPDO)";
        try {
            self::getConexion();

            $nombrePersona = $this->getNombrePersona();
            $PrimerApellido = $this->getPrimerApellido();
            $SegundoApellido = $this->getSegundoApellido();
            $Genero = $this->getGenero();
            $FechaNacimiento = $this->getFechaNacimiento();
            $Correo = $this->getCorreo();
            $Cedula = $this->getCedula();
            $Telefono = $this->getTelefono();
            $nombreUsuario = $this->getNombreUsuario();
            $contrasenia = $this->getContrasenia();

            $resultado = self::$cnx->prepare($query);   

            $resultado->bindParam(":nombrePersonaPDO",$nombrePersona,PDO::PARAM_STR);
            $resultado->bindParam(":PrimerApellidoPDO", $PrimerApellido, PDO::PARAM_STR);
            $resultado->bindParam(":SegundoApellidoPDO", $SegundoApellido, PDO::PARAM_STR);
            $resultado->bindParam(":GeneroPDO", $Genero, PDO::PARAM_STR);
            $resultado->bindParam(":FechaNacimientoPDO", $FechaNacimiento, PDO::PARAM_STR);
            $resultado->bindParam(":CorreoPDO", $Correo, PDO::PARAM_STR);
            $resultado->bindParam(":CedulaPDO", $Cedula, PDO::PARAM_STR);
            $resultado->bindParam(":TelefonoPDO", $Telefono, PDO::PARAM_STR);
            $resultado->bindParam(":nombreUsuarioPDO",$nombreUsuario,PDO::PARAM_STR);
            $resultado->bindParam(":contraseniaPDO", $contrasenia, PDO::PARAM_STR);

            $resultado->execute();
            self::desconectar();
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error ".$ex->getCode().": ".$ex->getMessage();
            return json_encode($error);
        }
    }
}
?>