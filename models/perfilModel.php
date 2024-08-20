<?php
require_once  '../config/conexion.php';
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

    public function mostrarPerfil($Cedula){
        $query = "SELECT * FROM `usuarios` WHERE `cedula`=:cedulaPDO";

        try {
            self::getConexion();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedulaPDO", $Cedula, PDO::PARAM_INT);
            $resultado->execute();

            $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC); 
            
            return json_encode($usuarios);
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }
    
    public function actualizarPerfil() {
        try {
            // Obtener los valores actuales del usuario para mantener los no modificados
            self::getConexion();
            $querySelect = "SELECT nombre, primer_apellido, segundo_apellido, genero, fecha_nacimiento, nombre_usuario, telefono, correo, contrasena, img FROM `usuarios` WHERE `cedula` = :cedulaPDO";
            $stmtSelect = self::$cnx->prepare($querySelect);
            $cedulaPDO = $this->getCedula();
            $stmtSelect->bindParam(":cedulaPDO", $cedulaPDO);
            $stmtSelect->execute();
            $valoresViejos = $stmtSelect->fetch(PDO::FETCH_ASSOC);
    
            $nombrePersonaPDO = $this->getNombrePersona() ?: $valoresViejos['nombre'];
            $primerApellidoPDO = $this->getPrimerApellido() ?: $valoresViejos['primer_apellido'];
            $segundoApellidoPDO = $this->getSegundoApellido() ?: $valoresViejos['segundo_apellido'];
            $generoPDO = $this->getGenero() ?: $valoresViejos['genero'];
            $fechaNacimientoPDO = $this->getFechaNacimiento() ?: $valoresViejos['fecha_nacimiento'];
            $nombreUsuarioPDO = $this->getNombreUsuario() ?: $valoresViejos['nombre_usuario'];
            $telefonoPDO = $this->getTelefono() ?: $valoresViejos['telefono'];
            $correoPDO = $this->getCorreo() ?: $valoresViejos['correo'];
            $contrasenaPDO = $this->getContrasenia() ?: $valoresViejos['contrasena'];
            $imgPDO = $this->getImg() ?: $valoresViejos['img'];
    
            $queryUpdate = "UPDATE `usuarios` SET 
                            `nombre`= :nombrePersonaPDO,
                            `primer_apellido`= :primerApellidoPDO,
                            `segundo_apellido`= :segundoApellidoPDO,
                            `genero`= :generoPDO,
                            `fecha_nacimiento`= :fechaNacimientoPDO,
                            `nombre_usuario`= :nombreUsuarioPDO,
                            `telefono`= :telefonoPDO,
                            `correo`= :correoPDO,
                            `contrasena`= :contrasenaPDO,
                            `img`= :imgPDO
                            WHERE `cedula`= :cedulaPDO";
    
            $usuUpdate = self::$cnx->prepare($queryUpdate);
    
            $usuUpdate->bindParam(":nombrePersonaPDO", $nombrePersonaPDO);
            $usuUpdate->bindParam(":primerApellidoPDO", $primerApellidoPDO);
            $usuUpdate->bindParam(":segundoApellidoPDO", $segundoApellidoPDO);
            $usuUpdate->bindParam(":generoPDO", $generoPDO);
            $usuUpdate->bindParam(":fechaNacimientoPDO", $fechaNacimientoPDO);
            $usuUpdate->bindParam(":nombreUsuarioPDO", $nombreUsuarioPDO);
            $usuUpdate->bindParam(":telefonoPDO", $telefonoPDO);
            $usuUpdate->bindParam(":correoPDO", $correoPDO);
            $usuUpdate->bindParam(":contrasenaPDO", $contrasenaPDO);
            $usuUpdate->bindParam(":imgPDO", $imgPDO);
            $usuUpdate->bindParam(":cedulaPDO", $cedulaPDO);
    
            // Ejecución de la actualización
            if ($usuUpdate->execute()) {
                $filasAfectadas = $usuUpdate->rowCount();
                if ($filasAfectadas > 0) {
                    self::desconectar();
                    return json_encode(array("exitoFormulario" => true, "message" => "Perfil actualizado correctamente"));
                } else {
                    self::desconectar();
                    return json_encode(array("exitoFormulario" => false, "message" => "No se actualizó el perfil. Verifica si los datos son correctos." . $filasAfectadas));
                }
            }
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode(array("exitoFormulario" => false, "message" => $error));
        }
    }
    
   
}
?>