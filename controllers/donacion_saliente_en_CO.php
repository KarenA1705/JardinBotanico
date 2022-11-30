<?php

require_once "models/donacion_saliente_en_MO.php";

class donacion_saliente_en_CO
{

  function __construct()
  {
  }

  function agregardonacion()
  {

    $conexion = new conexion();
    $donacion_en_MO = new donacion_saliente_en_MO($conexion);
    date_default_timezone_set('UTC');
    date_default_timezone_set("America/Bogota");

    $fecha = date('Y-m-d');
    $id_donacion = htmlentities($_POST['numero'], ENT_QUOTES);
    $nit=$_SESSION['nit'];
    $documento='1064836389';

    if ( empty($id_donacion)  ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
 
 
    $donacion_en_MO->agregardonacion($id_donacion,$nit,$documento,$fecha);

    /*$codigo= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }
  function actualizar()
  {

    $conexion = new conexion();
    $donacion_en_MO = new donacion_saliente_en_MO($conexion);
   
    $id_donacion = htmlentities($_POST['numero'], ENT_QUOTES);
    
    if ( empty($id_donacion) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
 
 
    $donacion_en_MO->actualizar($id_donacion);

    /*$codigo= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro actualizado"

    ];

    exit(json_encode($arreglo_respuesta));
  }
  function aceptar_solicitud(){
    $conexion = new conexion();
    $donacion_en_MO = new donacion_saliente_en_MO($conexion);
    $json = file_get_contents('php://input');
    $datos=json_decode($json, true);
    //print_r($datos);
    $id_donacion=$datos['id_donacion'];
    $donacion_en_MO->aceptar($id_donacion);

    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "validacion correcta"

    ];
    exit(json_encode($arreglo_respuesta));
  }
  function rechazar_solicitud()
  {

    $conexion = new conexion();
    $donacion_en_MO = new donacion_saliente_en_MO($conexion);
    $json = file_get_contents('php://input');
    $datos=json_decode($json, true);
    //print_r($datos);
    $id_donacion=$datos['id_donacion'];

    $arreglo_detalle= $donacion_en_MO->seleccionarDetalle($id_donacion);
    if ($arreglo_detalle) {

      foreach ($arreglo_detalle as $objeto_detalle) {
          $especie = $objeto_detalle->especie;
          $cantidad = $objeto_detalle->cantidad;
          $donacion_en_MO->actualizarPlanta($especie, $cantidad);
        
        }
      }
     
    $donacion_en_MO->rechazar($id_donacion);
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

  function eliminardonacion()
  {

    $conexion = new conexion();
   $donacion_en_MO = new donacion_saliente_en_MO($conexion);
    $json = file_get_contents('php://input');
    $datos=json_decode($json, true);
    //print_r($datos);
    $id_donacion=$datos['id_donacion'];

    $arreglo_detalle= $donacion_en_MO->seleccionarDetalle($id_donacion);
    if ($arreglo_detalle) {

      foreach ($arreglo_detalle as $objeto_detalle) {
          $especie = $objeto_detalle->especie;
          $cantidad = $objeto_detalle->cantidad;
          $donacion_en_MO->actualizarPlanta($especie, $cantidad);
        
        }
      }
    $donacion_en_MO->eliminardonaciondet($id_donacion);
    $donacion_en_MO->eliminardonacion($id_donacion);
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

  function actualizarestados()
  {

    $conexion = new conexion();
    $estados_MO = new  estados_MO($conexion);
 
    $codigo = htmlentities($_POST['codigo'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES);
    $codigo_org=htmlentities($_POST['codige'], ENT_QUOTES);

    if (  empty($codigo) or empty($nombre) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($codigo) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del codigo debe ser menor de 4 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nombre) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre  deber ser menor de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    if($codigo == $codigo_org){
      $estados_MO->actualizarestados($codigo, $nombre,$codigo_org);

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
      $arreglo_estados = $estados_MO->seleccionar_codigo($codigo);
      if ($arreglo_estados) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El codigo ($codigo) esta duplicado"

        ];

        exit(json_encode($arreglo_respuesta));
      }

    }
    $estados_MO->actualizarestados($codigo, $nombre,$codigo_org);

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
