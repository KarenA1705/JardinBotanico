<?php

require_once "models/entidad_MO.php";

class entidades_CO
{

  function __construct()
  {
  }

  function agregarentidades()
  {

    $conexion = new conexion();

    $entidades_MO = new  entidad_MO($conexion);
   
    $nit = htmlentities($_POST['nit'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES);
    $tipo = htmlentities($_POST['tipo'], ENT_QUOTES);
    $telefono = htmlentities($_POST['telefono'], ENT_QUOTES);
    $correo = htmlentities($_POST['correo'], ENT_QUOTES);
    $contrasena = htmlentities($_POST['contrasena'], ENT_QUOTES);
   
    if ( empty($nit) or empty($nombre) or empty($tipo) or empty($telefono) or empty($correo) or empty($contrasena)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nit) > 20) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nit debe ser menor de 20 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nombre) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "el nombre de la entidad debe ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if ($tipo!="privada" and $tipo!="publica" ) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "el tipo de entidad solo puede ser publica o privada"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($telefono) > 20) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "el telefono debe tener menos 20 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($correo) > 50) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "el correo debe tener menos de 50 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($contrasena) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "la contraseña debe tener menos de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
 
    $arreglo_entidades = $entidades_MO->seleccionar_entidad($nit);
    if ($arreglo_entidades) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El nit de la entidad ($nit) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    $arreglo_entidad_email = $entidades_MO->seleccionar_entidadem($correo);
    if ($arreglo_entidad_email) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El correo  ($correo) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    $entidades_MO->agregarentidades($nit,$nombre,$tipo,$telefono,$correo,$contrasena);
    /*$familia= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "nit" => $nit,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarentidades()
  {

    $conexion = new conexion();
    $entidades_MO = new  entidades_MO($conexion);
 
    $especie = htmlentities($_POST['especie'], ENT_QUOTES);
    $familia = htmlentities($_POST['familia'], ENT_QUOTES);
    $cod_origen = htmlentities($_POST['cod_origen'], ENT_QUOTES);
    $cod_estado = htmlentities($_POST['cod_estado'], ENT_QUOTES);
    $cod_habito = htmlentities($_POST['cod_habito'], ENT_QUOTES);
    $nombre_comun = htmlentities($_POST['nombre_comun'], ENT_QUOTES);
    $stock = htmlentities($_POST['stock'], ENT_QUOTES);

    if (empty($familia)or empty($cod_origen) or empty($cod_estado) or empty($cod_habito)or empty($nombre_comun)or empty($stock) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($especie) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre de la especie deber ser menor de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
      if (strlen($nombre_comun) > 50) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del nombre comun de la planta deber ser menor de 50 caracteres"
  
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

    $entidades_MO->actualizarentidades($especie,$familia,$cod_estado,$cod_habito,$cod_origen,$nombre_comun, $stock);

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
