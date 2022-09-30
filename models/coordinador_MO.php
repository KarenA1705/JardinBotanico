<?php
class coordinador_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

 

  function seleccionar($documento= '')
  {

    if (empty($documento)) {

      $sql = "select * from coordinador";
    } else {

      $sql = "select * from coordinador where documento='$documento'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
 
}