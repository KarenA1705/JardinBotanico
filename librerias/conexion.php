<?php
class conexion
{
    private $enlace;
    private $resultado;

    function __construct($opcion)
    {
        $ip_maquina=IP_MAQUINA;
        $base_de_datos=BASE_DE_DATOS;
        
        if($opcion=='sel')
        {
            $usuario=SEL_C;
            $clave=CLAVE_SEL_C;
        }
        else if($opcion=='all')
        {
            $usuario=ALL_C;
            $clave=CLAVE_ALL_C;
        }
        
        try {
            //Creamos nuestra nueva instancia de PDO con el driver de Postgres
             $this->enlace = new PDO("pgsql:dbname=personas;host=localhost;user=postgres;password=123");
            
            //Habilitamos el modo de errores para visualizarlos
            $this->enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //Definimos el tipo de respuesta para todas las consultas realizadas sobre esta instancia
            $this->enlace->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            } catch (PDOException $e) {
             die("Error : " . $e->getMessage() . "<br/>");
             }
       /* try
        {
            $this->enlace = new PDO("mysql:host=$ip_maquina;dbname=$base_de_datos", $usuario, $clave);
           
            return $this->enlace;
        }
        catch (PDOException $e)
        {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            exit();
        }*/
    }

    function consultar($sql)
    {
        $this->resultado=$this->enlace->query($sql) or $this->errorConsulta($sql);
    }

    function extraerRegistro()
    {
        return $this->resultado->fetchAll(PDO::FETCH_OBJ);
    }

    function lastInsertId()
    {
        return $this->enlace->lastInsertId();
    }

    function errorConsulta()
    {
        $arreglo_respuesta=[
            "estado"=>"ERROR",
            "mensaje"=>"Consulta mal estructurada:sql",
            
        ];
            exit(json_encode($arreglo_respuesta));

    }
}
?>