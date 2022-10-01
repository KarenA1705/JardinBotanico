<?php

require_once "models/familias_MO.php";

class familias_CO
{

  function __construct()
  {
  }

  function agregarfamilias()
  {

    $conexion = new conexion();

    $familias_MO = new  familias_MO($conexion);
   
    $familia = htmlentities($_POST['familia'], ENT_QUOTES);
    $carcateristica= ($_POST['carcateristica'], ENT_QUOTES);
   

    if ( empty($familia) or empty($carcateristica) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($familia) > 20) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre de la familia deber ser menor de 20 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($carcateristica) > 300) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de las caracteristicas de la familia deber ser menor de 300 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
 
    $arreglo_familias = $familias_MO->seleccionar_familia($familia);
    if ($arreglo_familias) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El nombre de la familia ($familia) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    $familias_MO->agregarfamilias( $familia, $carcateristica);

    $familia= $conexion->traerUltimoId();

    $arreglo_respuesta = [
      "marc_id" => $marc_id,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarfamilias()
  {

    $conexion = new conexion('all');
    $familias_MO = new  familias_MO($conexion);

    $marc_id = $_POST['marc_id'];
 
    $familia = htmlentities($_POST['familia'], ENT_QUOTES);
  

    if (  empty($familia)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($familia) > 45) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño de la marca deber ser menor de 45 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    


    $familias_MO->actualizarfamilias($familia, $marc_id);

    $actualizado = $conexion->filasAfectadas();

    if ($actualizado) {

      $mensaje = "Registro Actualizado";
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
