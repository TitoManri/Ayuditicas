<?php
require_once '../config/conexion.php';

class Etiqueta extends Conexion{

    //Conexion
    protected static $cnx;

    //Atributos
    private $id_etiqueta = null;
    private $tipo_etiqueta = null;
    private $nombre_etiqueta = null;

    //Constructor
    public function __construct(){}

    //Getters
    public function getId_etiqueta(){
        return $this -> id_etiqueta;
    }
    public function getTipo_etiqueta(){
        return $this -> tipo_etiqueta;
    }
    public function getNombre_etiqueta(){
        return $this -> nombre_etiqueta;
    }

    //Setters
    public function setId_etiqueta($id_etiqueta){
        $this -> id_etiqueta = $id_etiqueta;
    }
    public function setTipo_etiqueta($tipo_etiqueta){
        $this -> tipo_etiqueta = $tipo_etiqueta;
    }
    public function setNombre_etiqueta($nombre_etiqueta){
        $this -> nombre_etiqueta = $nombre_etiqueta;
    }

    //Metodos 
    public static function getConexion(){
        self::$cnx = Conexion::conectar();
    }
    public static function desconectar(){
        self::$cnx = null;
    }

    public function SelectEtiquetas(){
        $query = "SELECT * FROM `etiquetas`";
        $etiquetas = [];

        try{
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach($resultado-> fetchAll() as $encontrado){
                $etiquetasIndividual = new Etiqueta();
                $etiquetasIndividual -> setId_etiqueta($encontrado['id_etiqueta']);
                $etiquetasIndividual -> setTipo_etiqueta($encontrado['tipo_etiqueta']);
                $etiquetasIndividual -> setNombre_etiqueta($encontrado['nombre']);
                $etiquetas[] = $etiquetasIndividual;
            }
            return $etiquetas;
        }catch (Exception $ex){
            self::desconectar();
            $error = "Hubo un error al conseguir las etiquetas.\n".$ex->getCode().": ".$ex->getMessage();
            return json_encode($error);
        } 
    }

    public function SelectEtiquetasNombresPost(){
        $query = "SELECT `id_etiqueta`,`nombre` FROM `etiquetas` WHERE `tipo_etiqueta` = 'publicacion'";
        $etiquetas = [];

        try{
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach($resultado-> fetchAll() as $encontrado){
                $etiquetasIndividual = new Etiqueta();
                $etiquetasIndividual -> setId_etiqueta($encontrado['id_etiqueta']);
                $etiquetasIndividual -> setNombre_etiqueta($encontrado['nombre']);
                $etiquetas[] = $etiquetasIndividual;
            }
            return $etiquetas;
        }catch (Exception $ex){
            self::desconectar();
            $error = "Hubo un error al conseguir las etiquetas.\n".$ex->getCode().": ".$ex->getMessage();
            return json_encode($error);
        } 
    }
}