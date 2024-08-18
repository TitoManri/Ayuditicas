<?php
require_once '../config/conexion.php';

class Publicaciones_etiquetas extends Conexion
{

    //Conexion
    protected static $cnx;

    //Atributos
    private $id_etiqueta;
    private $id_publicacion;
    private $id_publicacion_blog;
    private $cantidad;
    private $nombre;

    //Getters
    public function getId_etiqueta()
    {
        return $this->id_etiqueta;
    }

    public function getIdPublicacion()
    {
        return $this->id_publicacion;
    }

    public function getIdPublicacionBlog()
    {
        return $this->id_publicacion_blog;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getNombre()
    {
        return $this -> nombre;
    }

    //Setters
    public function setIdEtiqueta($id_etiqueta)
    {
        $this->id_etiqueta = $id_etiqueta;
    }

    public function setIdPublicacion($id_publicacion)
    {
        $this->id_publicacion = $id_publicacion;
    }

    public function setIdPublicacionBlog($id_publicacion_blog)
    {
        $this->id_publicacion_blog = $id_publicacion_blog;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function setNombre($nombre)
    {
        $this ->nombre = $nombre;
    }

    //Conexion
    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }
    public static function desconectar()
    {
        self::$cnx = null;
    }

    public function SelectEtiquetasPosts($opcion)
    {
        $query = "";
        //Si la opcion es 1. Usar Publicaciones Sin Blogs
        $etiquetasArr = [];
        if ($opcion == 1) {
            $query = 'SELECT p.id_etiqueta, e.nombre, COUNT(*) as NumeroPosts 
                        FROM `publicaciones_etiquetas` p 
                        JOIN `etiquetas` e ON e.id_etiqueta = p.id_etiqueta
                        WHERE p.`id_publicacion_blog` IS NULL 
                        GROUP BY e.`id_etiqueta` 
                        ORDER BY e.`id_etiqueta`';
        } //Si es 0. Usar Blogs sin Publicaciones
        else if ($opcion == 0) {
            $query = 'SELECT p.id_etiqueta, e.nombre, COUNT(*) as NumeroPosts 
                        FROM `publicaciones_etiquetas` p 
                        JOIN `etiquetas` e ON e.id_etiqueta = p.id_etiqueta
                        WHERE p.`id_etiqueta` IS NULL 
                        GROUP BY e.`id_publicacion_blog` 
                        ORDER BY e.`id_publicacion_blog`';
        }
        if ($opcion == 1 || $opcion == 0) {
            try {
                self::getConexion();
                $resultado = self::$cnx->prepare($query);
                $resultado->execute();
                foreach ($resultado->fetchAll() as $encontrado) {
                    $etiquetaPost = new Publicaciones_etiquetas();
                    $etiquetaPost->setIdEtiqueta($encontrado['id_etiqueta']);
                    $etiquetaPost->setNombre($encontrado['nombre']);
                    $etiquetaPost->setCantidad($encontrado['NumeroPosts']);
                    $etiquetasArr[] = $etiquetaPost;
                }
                return $etiquetasArr;
            } catch (Exception $ex) {
                self::desconectar();
                $error = "Error " . $ex->getCode() . ": " . $ex->getMessage();;
                return json_encode($error);
            }
        }
    }
}
