<?php
require_once '../config/conexion.php';
class inicioSesionModel extends conexion {
    protected static $cnx; 
    private $nombreUsuario=null;
    private $contrasenia=null;

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }
    
    public function getContrasenia() {
        return $this->contrasenia;
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

    public function verificarExistenciaDb() {
        try {
            self::getConexion();

            if ($this->getNombreUsuario() && $this->getContrasenia()) {
                // Verificar existencia de un usuario
                $query = "SELECT * FROM `usuarios` WHERE nombre_usuario = :nombreUsuario AND contrasena = :contrasenia";
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(':nombreUsuario', $this->nombreUsuario, PDO::PARAM_STR);
                $resultado->bindParam(':contrasenia', $this->contrasenia, PDO::PARAM_STR);
                $resultado->execute();

                if ($resultado->rowCount() > 0) {
                    $usuario = $resultado->fetch(PDO::FETCH_ASSOC);

                    if ($usuario['contrasena'] === $this->getContrasenia()) {
                        self::desconectar();
                        return true;
                    }
                }
                self::desconectar();
                return false;
            } else {
                return false;
            }
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

}
?>