<?php
require_once '../config/Conexion.php';

class BlogModel extends Conexion {

    protected static $cnx;

    private $idPublicacionBlog;
    private $cedula;
    private $titulo;
    private $contenido;
    private $img;
    private $numLike;
    private $fechaHoraCreacion;

    // Getters y Setters
    public function getIdPublicacionBlog() {
        return $this->idPublicacionBlog;
    }

    public function setIdPublicacionBlog($idPublicacionBlog) {
        $this->idPublicacionBlog = $idPublicacionBlog;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
    }

    public function getNumLike() {
        return $this->numLike;
    }

    public function setNumLike($numLike) {
        $this->numLike = $numLike;
    }

    public function getFechaHoraCreacion() {
        return $this->fechaHoraCreacion;
    }

    public function setFechaHoraCreacion($fechaHoraCreacion) {
        $this->fechaHoraCreacion = $fechaHoraCreacion;
    }

    public function __construct(){}

    public static function getConexion(){ 
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar(){
        self::$cnx = null;
    }

    // Guardar datos del blog
    public function guardarDatosBlog() {
        $query = "INSERT INTO `blogs` (`cedula`, `titulo`, `contenido`, `img`, `num_like`, `fecha_hora_creacion`) 
                  VALUES (:cedulaPDO, :tituloPDO, :contenidoPDO, :imgPDO, 0, NOW())";
        
        try {
            self::getConexion();
            
            $cedulaPDO = $this->getCedula();
            $tituloPDO = $this->getTitulo();
            $contenidoPDO = $this->getContenido();
            $imgPDO = $this->getImg();
            
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":cedulaPDO", $cedulaPDO, PDO::PARAM_INT);
            $resultado->bindParam(":tituloPDO", $tituloPDO, PDO::PARAM_STR);
            $resultado->bindParam(":contenidoPDO", $contenidoPDO, PDO::PARAM_STR);
            $resultado->bindParam(":imgPDO", $imgPDO, PDO::PARAM_STR);
            
            $resultado->execute();
            $idPublicacionBlog = self::$cnx->lastInsertId();
            
            self::desconectar();
            return $idPublicacionBlog;
        } catch (PDOException $ex) {
            self::desconectar();
            return json_encode(array("exitoFormulario" => false, "message" => "Error en la base de datos: " . $ex->getMessage()));
        }
    }
    
    // Mostrar blogs
    public function mostrarBlogs($cedula) {
        $query = "SELECT b.id_publicacion_blog, b.titulo, b.contenido, b.img, b.num_like, b.fecha_hora_creacion, u.nombre_usuario, 
          FROM blogs b
          LEFT JOIN likes l ON b.id_publicacion_blog = l.id_publicacion_blog AND l.cedula = :cedula
          JOIN usuarios u ON b.cedula = u.cedula
          ORDER BY b.fecha_hora_creacion DESC";  

        
        try {
            self::getConexion();
            
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(':cedula', $cedula, PDO::PARAM_INT);
            $resultado->execute();
            
            $blogs = $resultado->fetchAll(PDO::FETCH_ASSOC);
            
            self::desconectar();
            
            return json_encode($blogs);
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode($error);
        }
    }

    // Obtener una publicación
    public function obtenerBlog($id_publicacion_blog) {
        $query = "SELECT b.id_publicacion_blog, b.titulo, b.contenido, b.img, b.num_like, b.fecha_hora_creacion, u.nombre_usuario
                  FROM blogs b
                  JOIN usuarios u ON b.cedula = u.cedula
                  WHERE b.id_publicacion_blog = :id_publicacion_blog";
    
        try {
            self::getConexion();
    
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id_publicacion_blog", $id_publicacion_blog, PDO::PARAM_INT);
            $resultado->execute();
    
            $blog = $resultado->fetch(PDO::FETCH_ASSOC);
    
            self::desconectar();
    
            return json_encode($blog);
        } catch (PDOException $ex) {
            self::desconectar();
            $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();
            return json_encode(array("exitoFormulario" => false, "message" => $error));
        }
    }
public function actualizarImagen($idPublicacionBlog, $nuevaImagen) {
    $query = "UPDATE blogs SET img = :imgPDO WHERE id_publicacion_blog = :id_publicacion_blog";
    
    try {
        self::getConexion();
        
        $resultado = self::$cnx->prepare($query);
        $resultado->bindParam(":imgPDO", $nuevaImagen, PDO::PARAM_STR);
        $resultado->bindParam(":id_publicacion_blog", $idPublicacionBlog, PDO::PARAM_INT);
        
        $resultado->execute();
        
        self::desconectar();
        return true;
    } catch (PDOException $ex) {
        self::desconectar();
        return json_encode(array("exitoFormulario" => false, "message" => "Error en la base de datos: " . $ex->getMessage()));
    }
}

}
?>
