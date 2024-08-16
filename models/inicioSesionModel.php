<?php
require_once '../config/conexion.php';
class inicioSesionModel extends conexion {
    protected static $cnx; 
    private $nombreUsuario=null;
    private $contrasenia=null;
    private $cedula = null;
    private $nombre = null;
    private $primerApellido = null;
    private $segundoApellido = null;
    private $genero = null;
    private $fechaNacimiento = null;
    private $telefono = null;
    private $correo = null;
    private $numSeguidores = null;
    private $img = null;

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
    public function getCedula() { 
        return $this->cedula; 
    }
    public function setCedula($cedula) { 
        $this->cedula = $cedula; 
    }

    public function getNombre() { 
        return $this->nombre; 
    }
    public function setNombre($nombre) { 
        $this->nombre = $nombre; 
    }

    public function getPrimerApellido() { 
        return $this->primerApellido; 
    }
    public function setPrimerApellido($primerApellido) { 
        $this->primerApellido = $primerApellido; 
    }

    public function getSegundoApellido() { 
        return $this->segundoApellido; 
    }
    public function setSegundoApellido($segundoApellido) { 
        $this->segundoApellido = $segundoApellido; 
    }

    public function getGenero() { 
        return $this->genero; 
    }
    public function setGenero($genero) { 
        $this->genero = $genero; 
    }

    public function getFechaNacimiento() { 
        return $this->fechaNacimiento; 
    }
    public function setFechaNacimiento($fechaNacimiento) { 
        $this->fechaNacimiento = $fechaNacimiento; 
    }

    public function getTelefono() { 
        return $this->telefono; 
    }
    public function setTelefono($telefono) { 
        $this->telefono = $telefono; 
    }

    public function getCorreo() { 
        return $this->correo; 
    }
    public function setCorreo($correo) { 
        $this->correo = $correo; 
    }

    public function getNumSeguidores() { return $this->numSeguidores; }
    public function setNumSeguidores($numSeguidores) { $this->numSeguidores = $numSeguidores; }

    public function getImg() { return $this->img; }
    public function setImg($img) { $this->img = $img; }

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
                $query = "SELECT cedula, nombre, primer_apellido, segundo_apellido, genero, fecha_nacimiento, nombre_usuario, telefono, correo, num_seguidores, img, contrasena 
                          FROM `usuarios` 
                          WHERE nombre_usuario = :nombreUsuario";
                $resultado = self::$cnx->prepare($query);
                $resultado->bindParam(':nombreUsuario', $this->nombreUsuario, PDO::PARAM_STR);
                $resultado->bindParam(':contrasenia', $this->contrasenia, PDO::PARAM_STR);
                $resultado->execute();

                if ($resultado->rowCount() > 0) {
                    $usuario = $resultado->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($this->getContrasenia(), $usuario['contrasena'])) {
                        $this->setCedula($usuario['cedula']);
                        $this->setNombre($usuario['nombre']);
                        $this->setPrimerApellido($usuario['primer_apellido']);
                        $this->setSegundoApellido($usuario['segundo_apellido']);
                        $this->setGenero($usuario['genero']);
                        $this->setFechaNacimiento($usuario['fecha_nacimiento']);
                        $this->setTelefono($usuario['telefono']);
                        $this->setCorreo($usuario['correo']);
                        $this->setNumSeguidores($usuario['num_seguidores']);
                        $this->setImg($usuario['img']);
                        
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