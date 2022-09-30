<?php
class accesos_MO
{
    private $conexion;
    
    function __construct($conexion)
    {
        $this->conexion=$conexion;
    }

    function iniciarSesion($usuario,$clave)
    {/*
        $sql="select pers_id from accesos where acce_usuario='$usuario' and acce_clave='$clave'";
        $this->conexion->consultar($sql);
        return $this->conexion->extraerRegistro();*/
    }

}
?>
