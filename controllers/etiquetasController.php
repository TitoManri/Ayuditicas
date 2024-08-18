<?php
require_once '../models/etiquetas.php';
switch($_GET["op"]){
    case 'listar_etiquetas':{
        $etiqueta = new Etiqueta();
        $etiquetas = $etiqueta->SelectEtiquetasNombresPost();
        $data = [];
        foreach($etiquetas as $reg){
            $data[] = array(
                "id_etiqueta" => $reg->getId_etiqueta(),
                "nombre_etiqueta" => $reg->getNombre_etiqueta()
            );
        }
        echo json_encode($data);
        break;
    }

    case 'mostrarPostPorEtiquetas':{
        //$idArray = explode('&',$_SERVER["QUERY_STRING"]);
        $etiquetas = isset($_GET["SelectEtiqueta"]) ? $_GET["SelectEtiqueta"] : [];
        echo json_encode($etiquetas);
    }
}