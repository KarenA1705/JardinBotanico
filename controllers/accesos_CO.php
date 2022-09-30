<?php
require_once "models/accesos_MO.php";

class accesos_CO
{
    function __construct(){}

    function iniciarSesion($correo,$contrasena)
    {
        $conexion=new conexion();
        
        $accesos_MO=new accesos_MO($conexion);
        
        $arreglo=$accesos_MO->iniciarSesion($correo,$contrasena);
        echo "dddddddd";

       if($arreglo)
        {
            $objeto_accesos=$arreglo[0];
            $documento=$objeto_accesos->documento;
            
            $_SESSION['documento']=$documento;
        }

        header('Location: index.php');
    }

    function salir()
    {
        session_destroy();
        
    }

}
?>