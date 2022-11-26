<?php

require_once "models/detalle_entrante_en_MO.php";
require_once "models/plantas_MO.php";

class detalle_entrante_en_CO
{

  function __construct()
  {
  }

  function agregardetalle()
  {

    $conexion = new conexion();
    $detalle_en_MO = new detalle_entrante_en_MO($conexion);
    $json = file_get_contents('php://input');
    $datos=json_decode($json, true);
    //print_r($datos);
    $id_donacion=$datos['id_donacion'];
    $cantidad=$datos['cantidad'];
    $id_detalle=$datos['id_detalle'];
    $especie=$datos['especie'];
    
    //print_r($cantidad);

    /*$id_donacion = htmlentities($_POST['numero1'], ENT_QUOTES);
    $id_detalle=htmlentities($_POST['numero_detalle'], ENT_QUOTES);
    $especie=htmlentities($_POST['planta'], ENT_QUOTES);
    $cantidad=htmlentities($_POST['cantidad'], ENT_QUOTES);*/

    if ( empty($id_donacion) or empty($id_detalle) or empty($especie) or empty($cantidad) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if ( $cantidad==0 ) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "La cantidad no puede ser cero"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
    $planta_MO= new plantas_MO($conexion);
    $arreglo_planta=$planta_MO->seleccionar_planta($especie);
    
    foreach($arreglo_planta as $objeto_planta){
        $stock = $objeto_planta->stock;
    }
    
  
    if ($cantidad>$stock) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "Stock de plantas no disponible"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      $resta=$stock-$cantidad;
    $detalle_en_MO->restarStock($especie,$resta);
    $detalle_en_MO->agregardetalle($id_donacion,$id_detalle,$especie,$cantidad);

    /*$codigo= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }
  function eliminardetalle()
  {

    $conexion = new conexion();
    $detalle_en_MO = new detalle_entrante_en_MO($conexion);
    $json = file_get_contents('php://input');
    $datos=json_decode($json, true);
    //print_r($datos);
    $id_donacion=$datos['id_donacion'];
    $id_detalle=$datos['id_detalle'];
    $cantidad=$datos['cantidad'];
    $especie=$datos['especie'];

    $detalle_en_MO->eliminardetalle($id_donacion,$id_detalle);
    $detalle_en_MO->restar_donacion($id_donacion,$cantidad);
    $detalle_en_MO->actualizarPlanta($especie, $cantidad);
    $eliminado = $conexion->filasAfectadas();
    if ($eliminado) {
  
      $mensaje = "Registro Eliminado";
      $estado = 'EXITO';
    } else {

      $mensaje = "No se realizaron cambios";
      $estado = 'ADVERTENCIA';
    }

    $arreglo_respuesta = [
      "estado" => $estado,
      "mensaje" => $mensaje
    ];

    exit(json_encode($arreglo_respuesta, true));
  }


}
