<?php
class entidad_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

 

  function seleccionar($nit= '')
  {

    if (empty($nit)) {

      $sql = "select * from entidad";
    } else {

      $sql = "select * from entidad where nit='$nit'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
}