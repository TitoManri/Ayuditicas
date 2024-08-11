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

    public function listarTodosDb(){
        $query = "SELECT * FROM `usuarios`";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $user = new inicioSesionModel();
                $user->setNombreUsuario($encontrado['nombre_usuario']);
                $user->setContrasenia($encontrado['contrasena']);
                $arr[] = $user;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error ".$Exception->getCode( ).": ".$Exception->getMessage( );;
            return json_encode($error);
        }
    }

    public function verificarExistenciaDb($nombreUsuario, $contrasenia){
        $query = "SELECT * FROM usuarios where nombre_usuario = :nombreUsuario AND contrasena = :contrasenia";
     try {
         self::getConexion();

            $resultado = self::$cnx->prepare($query);	
            $resultado->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
            $resultado->execute();
            
            //Verifica si encuentra el usuario
            if ($resultado->rowCount() > 0) {
                $usuario = $resultado->fetch(PDO::FETCH_ASSOC);
                
                //Comparacion de contraseña, si la contraseña es igual a la que esta con el usuario todo bien
                if (password_verify($contrasenia, $usuario['contrasena'])) {
                    self::desconectar();
                    return true;
                }
            }
            self::desconectar();
            return false;

        } catch (PDOException $Exception) {
            // Manejar cualquier excepción
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
}
?>