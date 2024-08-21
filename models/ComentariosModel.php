<?php
require_once '../config/Conexion.php';

class ComentariosModel extends Conexion {

    protected static $cnx;

    private $idComentario;
    private $cedula;
    private $idPublicacion;
    private $idPadre;
    private $tipoComentario;
    private $numLike;
    private $contenido;

    public function getIdComentario() {
        return $this->idComentario;
    }
    
    public function setIdComentario($idComentario) {
        $this->idComentario = $idComentario;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    public function getIdPublicacion() {
        return $this->idPublicacion;
    }
    
    public function setIdPublicacion($idPublicacion) {
        $this->idPublicacion = $idPublicacion;
    }

    public function getIdPadre() {
        return $this->idPadre;
    }
    
    public function setIdPadre($idPadre) {
        $this->idPadre = $idPadre;
    }

    public function getTipoComentario() {
        return $this->tipoComentario;
    }
    
    public function setTipoComentario($tipoComentario) {
        $this->tipoComentario = $tipoComentario;
    }

    public function getNumLike() {
        return $this->numLike;
    }
    
    public function setNumLike($numLike) {
        $this->numLike = $numLike;
    }

    public function getContenido() {
        return $this->contenido;
    }
    
    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    public function __construct() {}

    public static function getConexion() { 
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar() {
        self::$cnx = null;
    }
    public function guardarComentario() {
        $query = "INSERT INTO COMENTARIOS (cedula, id_publicacion, id_publicacion_blog, id_padre, num_like, contenido, fecha_hora_creacion) 
                  VALUES (:cedulaPDO, :idPublicacionPDO, null, :idPadrePDO, 0, :contenidoPDO, NOW())";
        
        try {
            self::getConexion();
            
            $cedula = $this->getCedula();
            $idPublicacion = $this->getIdPublicacion();
            $idPadre = null;
            $contenido = $this->getContenido();

    
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedulaPDO", $cedula, PDO::PARAM_INT);
            $resultado->bindParam(":idPublicacionPDO", $idPublicacion, PDO::PARAM_INT);
            $resultado->bindParam(":idPadrePDO", $idPadre, PDO::PARAM_INT);
            $resultado->bindParam(":contenidoPDO", $contenido, PDO::PARAM_STR);
            
            $resultado->execute();
            $idComentario = self::$cnx->lastInsertId();
            
            self::desconectar();
            return $idComentario;
        } catch (PDOException $ex) {
            self::desconectar();
            error_log("Error en la base de datos: " . $ex->getMessage()); 
            return json_encode(array("exitoFormulario" => false, "message" => "Error en la base de datos: " . $ex->getMessage()));
        }
    }
    
    

    public function mostrarComentariosPorPublicacion($idPublicacion) {
        $query = "SELECT c.id_comentario, c.contenido, c.num_like, c.fecha_hora_creacion, u.nombre_usuario
                  FROM comentarios c
                  JOIN usuarios u ON c.cedula = u.cedula
                  WHERE c.id_publicacion = :idPublicacion
                  ORDER BY c.fecha_hora_creacion ASC";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":idPublicacion", $idPublicacion, PDO::PARAM_INT);
            $resultado->execute();

            $comentarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
            self::desconectar();
            return json_encode($comentarios);
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }

}
?>