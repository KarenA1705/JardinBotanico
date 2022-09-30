<?php
class accesos_MO
{
    private $conexion;
    
    function __construct($conexion)
    {
        $this->conexion=$conexion;
    }

    function iniciarSesion($correo,$contrasena)
    {
        $sql="select documento from coordinador where correo='$correo' and contrasena='$contrasena'";
        $this->conexion->consultar($sql);
        return $this->conexion->extraerRegistro();
    }

}
?>
