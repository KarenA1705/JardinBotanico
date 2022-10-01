<?php
class familias_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarfamilias($familia, $carcateristica)
  {

    $sql = "insert into familia (nombre_familia, caracteristicas) values ('$familia','$caracteristica' )";

    $this->conexion->consultar($sql);
  }
  function actualizarfamilias($clie_documento, $clie_nombres, $clie_apellidos, $familia)
  {

    $sql = "update familias set clie_documento='$clie_documento', clie_nombres='$clie_nombres', clie_apellidos='$clie_apellidos' where familia='$familia'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($familia = '')
  {

    if (empty($familia)) {

      $sql = "select * from familia";
    } else {

      $sql = "select * from familia where nombre_familia='$familia'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_documento($clie_documento = '')
  {

    if ($clie_documento) {

      $sql = "select * from familias where clie_documento='$clie_documento'";
    } else {

      $sql = "select * from familias";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
