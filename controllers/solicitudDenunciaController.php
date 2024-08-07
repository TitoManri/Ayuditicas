<?php
require_once '../models/SolicitudDenunciaModel.php';

switch ($_GET["op"]) {
    case 'crearSoliDenuncia':
        //validar id de las cosas
        $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : "";
        $tipoDenuncia = isset($_POST["tipoDenuncia"]) ? trim($_POST["tipoDenuncia"]) : "";
        $detalle = isset($_POST["detalle"]) ? trim($_POST["detalle"]) : "";
        $img = isset($_POST["img"]) ? trim($_POST["img"]) : "";
        $latitud = isset($_POST["latitud"]) ? trim($_POST["latitud"]) : "";
        $longitud = isset($_POST["longitud"]) ? trim($_POST["longitud"]) : "";
        $fechaHoraEnvio = date("Y-m-d H:i:s");
        $fechaHoraConfirmacion = isset($_POST["fechaHoraConfirmacion"]) ? trim($_POST["fechaHoraConfirmacion"]) : "";
        $confirmacion = 'Pendiente';

        $soliDen = new SolicitudDenuncia();

        $soliDen->setCedula($cedula);
        $soliDen->setTipoDenuncia($tipoDenuncia);
        $soliDen->setDetalle($detalle);
        $soliDen->setImg($img);
        $soliDen->setLatitud($latitud);
        $soliDen->setFechaHoraEnvio($fechaHoraEnvio);
        $soliDen->setFechaHoraConfirmacion($fechaHoraConfirmacion);
        $soliDen->setConfirmacion($confirmacion);

        $soliDen->crearSoliDenuncia();
        break;
    case 'verSolicitudDenunciaEspec':
        $idDenuncia = isset($_POST["denuncia"]) ? $_POST["denuncia"] : "";
        $denuncia = new SolicitudDenuncia();
        $denuncia->setIdDenuncia($idDenuncia);
        $encontrado = $denuncia->verSolicitudDenunciaEspec($idDenuncia);
        if ($encontrado != null) {
            $datosDenuncia = array();
            $datosDenuncia[] = [
                "idDenuncia" => $encontrado->getIdDenuncia(),
                "cedula" => $encontrado->getCedula(),
                "tipoDenuncia" => $encontrado->getTipoDenuncia(),
                "detalle" => $encontrado->getDetalle(),
                "img" => $encontrado->getImg(),
                "latitud" => $encontrado->getLatitud(),
                "longitud" => $encontrado->getLongitud(),
                "fechaHoraEnvio" => $encontrado->getFechaHoraEnvio(),
                "fechaHoraConfirmacion" => $encontrado->getFechaHoraConfirmacion(),
                "confirmacion" => $encontrado->getConfirmacion()
            ];
            echo json_encode($datosDenuncia);
        } else {
            echo json_encode(["error" => "No se encontró la denuncia"]);
        }
        break;
    case 'verDenuncias':
        $denuncia = new SolicitudDenuncia();
        $soliDen = $denuncia->verDenuncias();
        $data = array();
        foreach ($soliDen as $reg) {
            $data[] = array(
                //cambiar esto para que muestre la denuncia específica
                "0" => "<a href='detalleDenuncia.php?id=" . $reg->getIdDenuncia() . "' class='ml-1'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                                    class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                    <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0' />
                                    <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7' />
                                </svg>
                            </a>",
                "1" => $reg->getTipoDenuncia(),
                "2" => $reg->getLatitud(),
                "3" => $reg->getLongitud(),
                "4" => $reg->getConfirmacion()
            );
        }
        $resultados = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($resultados);
        break;
    case 'rechazarSolicitudDenuncia':
        $ul = new SolicitudDenuncia();
        $ul->setIdDenuncia(trim($_POST['idDenuncia']));
        $rspta = $ul->rechazarSolicitudDenuncia();
        echo $rspta;
        break;
    case 'aceptarSolicitudDenuncia':
        $ul = new SolicitudDenuncia();
        $ul->setIdDenuncia(trim($_POST['idDenuncia']));
        $rspta = $ul->aceptarSolicitudDenuncia();
        echo $rspta;
        break;
}

?>