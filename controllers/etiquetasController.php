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

    case 'mostrarEtiquetasAside':{
        $etiqueta = new Etiqueta();
        $etiquetas = $etiqueta->SelectEtiquetasNombresAside();
        $data = [];
        foreach($etiquetas as $reg){
            $data[] = array(
                "id_etiqueta" => $reg->getId_etiqueta(),
                "nombre" => $reg->getNombre_etiqueta()
            );
        }
        echo json_encode($data);
        break;
    }
}