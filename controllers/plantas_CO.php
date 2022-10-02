<?php

require_once "models/plantas_MO.php";

class plantas_CO
{

  function __construct()
  {
  }

  function agregarplantas()
  {

    $conexion = new conexion();

    $plantas_MO = new  plantas_MO($conexion);
   
    $especie = htmlentities($_POST['especie'], ENT_QUOTES);
    $familia = htmlentities($_POST['familia'], ENT_QUOTES);
    $cod_origen = htmlentities($_POST['cod_origen'], ENT_QUOTES);
    $cod_estado = htmlentities($_POST['cod_estado'], ENT_QUOTES);
    $cod_habito = htmlentities($_POST['cod_habito'], ENT_QUOTES);
    $nombre_comun = htmlentities($_POST['nombre_comun'], ENT_QUOTES);
    $stock = htmlentities($_POST['stock'], ENT_QUOTES);
    $caracteristica = htmlentities($_POST['caracteristica'], ENT_QUOTES);

    $caracteristica=htmlentities($_POST['caracteristica'], ENT_QUOTES);
   
    if ( empty($familia) or empty($caracteristica) or empty($especie) or empty($cod_origen) or empty($cod_estado) or empty($cod_habito)or empty($nombre_comun)or empty($stock)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($especie) > 25) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre de la especie deber ser menor de 25 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($caracteristica) > 100) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de las caracteristicas de la planta deber ser menor de 100 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($nombre_comun) > 45) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del nombre comun de la planta deber ser menor de 45 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (!is_numeric($stock)) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El stock debe ser valor numerico"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
 
    $arreglo_plantas = $plantas_MO->seleccionar_planta($especie);
    if ($arreglo_plantas) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El nombre de la especie ($especie) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    $plantas_MO->agregarplantas($especie,$familia,$cod_estado,$cod_habito,$cod_origen,$nombre_comun, $stock, $caracteristica);
    /*$familia= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "especie" => $especie,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarplantas()
  {

    $conexion = new conexion();
    $plantas_MO = new  plantas_MO($conexion);
 
    $familia = htmlentities($_POST['familia'], ENT_QUOTES);
    $caracteristica = htmlentities($_POST['caracteristica'], ENT_QUOTES);
    $familia_org=htmlentities($_POST['family'], ENT_QUOTES);

    if (  empty($familia) or empty($caracteristica) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($familia) > 20) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre debe  ser menor de 20 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($caracteristica) > 300) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño de las caracteristicas de la familia deber ser menor de 300 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    if($familia == $familia_org){
      $plantas_MO->actualizarplantas($familia, $caracteristica,$familia_org);

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
    }else {
      $arreglo_plantas = $plantas_MO->seleccionar_familia($familia);
      if ($arreglo_plantas) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El nombre de la familia ($familia) esta duplicado"

        ];

        exit(json_encode($arreglo_respuesta));
      }

    }
    $plantas_MO->actualizarplantas($familia, $caracteristica,$familia_org);

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