<?php
require_once "librerias/constantes.php";
require_once "librerias/conexion.php";

if(isset($_SESSION['documento']))
{
    require_once "librerias/front_controller.php";

    if(isset($_GET['ruta'])){$ruta=$_GET['ruta'];}else{$ruta='';}

    $front_controller=new front_controller($ruta);
    echo "dsd";
}
else if(isset($_POST['correo']) and isset($_POST['contrasena']))
{
    echo "ddddd";
    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];

    require_once "controllers/accesos_CO.php";
    $accesos_CO=new accesos_CO();
    $accesos_CO->iniciarSesion($correo,$contrasena);
    
}
else
{
    require_once "view/accesos_VI.php";
    $accesos_VI=new accesos_VI();
    $accesos_VI->iniciarSesion();
    echo "aaa";
}
?>