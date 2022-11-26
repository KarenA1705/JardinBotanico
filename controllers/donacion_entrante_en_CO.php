<?php

require_once "models/donacion_entrante_en_MO.php";

class donacion_entrante_en_CO
{

  function __construct()
  {
  }

  function agregardonacion()
  {

    $conexion = new conexion();
    $donacion_en_MO = new donacion_entrante_en_MO($conexion);
    date_default_timezone_set('UTC');
    date_default_timezone_set("America/Mexico_City");

    $fecha = date('Y-m-d');
    $id_donacion = htmlentities($_POST['numero'], ENT_QUOTES);
    $cod_departamento=htmlentities($_POST['departamento'], ENT_QUOTES);

    if(isset($_POST['municipio']) and isset($_POST['lugar']) ){
        $cod_municipio=htmlentities($_POST['municipio'], ENT_QUOTES);
        $cod_lugar=htmlentities($_POST['lugar'], ENT_QUOTES);
    }else{
        $arreglo_respuesta = [
            "estado" => "ERROR",
            "mensaje" => "seleccione todos los campos"
    
          ];
          exit(json_encode($arreglo_respuesta));
    }
    
  
    $nit=$_SESSION['nit'];
    $documento='1064836389';

    if ( empty($id_donacion) or empty($cod_departamento) or empty($cod_municipio) or empty($cod_lugar) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
 
 
    $donacion_en_MO->agregardonacion($id_donacion , $nit,$documento,$fecha,$cod_departamento,$cod_municipio,$cod_lugar);

    /*$codigo= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }
  function eliminardonacion()
  {

    $conexion = new conexion();
    $donacion_en_MO = new donacion_entrante_en_MO($conexion);
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
    if (strlen($codigo) > 4) {
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
