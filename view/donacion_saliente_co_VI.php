<?php

class donacion_saliente_co_VI
{

    function __construct()
    {
    }

    function vizualizarPeticiones()
    {

        require_once "models/donacion_entrante_en_MO.php";
        require_once "models/municipio_MO.php";
        require_once "models/departamento_MO.php";
        require_once "models/lugar_MO.php";
        require_once "models/entidad_MO.php";
        require_once "models/plantas_MO.php";
        $conexion = new conexion();
        $donacion_en_MO = new donacion_entrante_en_MO($conexion);
        $arreglo_donacion= $donacion_en_MO->seleccionardc($_SESSION['documento']);
       
        
        $municipio_MO = new municipio_MO($conexion);
        $arreglo_municipio= $municipio_MO->seleccionar();
        $departamento_MO = new departamento_MO($conexion);
        $arreglo_departamento= $departamento_MO->seleccionar();
        $lugar_MO = new lugar_MO($conexion);
        $arreglo_lugar= $lugar_MO->seleccionar();
        $entidad_MO = new entidad_MO($conexion);
        $arreglo_entidad= $entidad_MO->seleccionar();
        $planta_MO = new plantas_MO($conexion);
        $arreglo_plantas= $planta_MO->seleccionar();
        //print_r($arreglo_donacion);
?>
         
 

        <div class="card">
            <div class="card-header">
                Listar Donaciones
            </div>
            <div class="card-body">

                <table id="example2" class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">N° Donacion</th>
                            <th style="text-align: center;">nit </th>
                            <th style="text-align: center;">nombre entidad </th>
                            <th style="text-align: center;">fecha </th>
                            <th style="text-align: center;">departamento</th>
                            <th style="text-align: center;">municipio</th>
                            <th style="text-align: center;">lugar</th>
                            <th style="text-align: center;">total</th>
                            <th style="text-align: center;">Validar</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_entidad">
                        <?php
                        if ($arreglo_donacion) {

                            foreach ($arreglo_donacion as $objeto_donacion) {
                                $cod_departamento = $objeto_donacion->cod_departamento;
                                $cod_municipio = $objeto_donacion->cod_municipio;
                                $cod_lugar = $objeto_donacion->cod_lugar;
                                $nit = $objeto_donacion->nit;

                                $arreglo_departamento = $departamento_MO->seleccionar($cod_departamento);
                                $objeto_departamento = $arreglo_departamento[0];
                                $nombre_departamento = $objeto_departamento->nombre_departamento;

                                $arreglo_municipio = $municipio_MO->seleccionar($cod_municipio);
                                $objeto_municipio = $arreglo_municipio[0];
                                $nombre_municipio = $objeto_municipio->nombre_municipio;

                                $arreglo_lugar = $lugar_MO->seleccionar($cod_lugar);
                                $objeto_lugar = $arreglo_lugar[0];
                                $nombre_lugar = $objeto_lugar->nombre_lugar;

                                $arreglo_entidad = $entidad_MO->seleccionar($nit);
                                $nombre = $arreglo_entidad[0]->nombre_entidad;
                                
                                $num = $objeto_donacion->id_donacion;
                                $fecha = $objeto_donacion->fecha;
                                $total = $objeto_donacion->total_plantas;
                                $estado= $objeto_donacion->estado;
                               
                        ?>
                                <tr><?php if($estado=='3'){ ?>
                                    <td class="table-danger" id="id_td_<?php echo $num; ?>"> <?php echo $num; ?> </td>
                                    <?php
                                    }else if($estado=='2'){?>
                                        <td class="table-success" id="id_td_<?php echo $num; ?>"> <?php echo $num; ?> </td>
                                    <?php
                                    }else if($estado=='1'){?>
                                        <td  class="table-secondary" id="id_td_<?php echo $num; ?>"> <?php echo $num; ?> </td>
                                    <?php
                                    }?>
                                    <td id="nombre_td_<?php echo $num; ?>"> <?php echo $nit; ?> </td>
                                    <td id="nombre_td_<?php echo $num; ?>"> <?php echo $nombre; ?> </td>
                                    <td id="fecha_td_<?php echo $num; ?>"> <?php echo $fecha; ?> </td>
                                    <td id="departamento_td_<?php echo $num; ?>"> <?php echo $nombre_departamento; ?> </td>
                                    <td id="municipio_td_<?php echo $num; ?>"> <?php echo $nombre_municipio; ?> </td>
                                    <td id="lugar_td_<?php echo $num; ?>"> <?php echo $nombre_lugar; ?> </td>
                                    <td id="total_td_<?php echo $num; ?>"> <?php echo $total; ?> </td>
                                    <td style="text-align: center;"> 
                                    <i class="fa fa-check-circle" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="visualizarDonacion('<?php echo $num; ?>')"></i>
                                    <i class="fa fa-times-circle" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="visualizarDonacion('<?php echo $num; ?>')"></i>

                                     </td>
                                    <td  style="text-align: center;">
                                        <input type="hidden" id="id_<?php echo $num; ?>" value="<?php echo $num; ?>">
                                        <input type="hidden" id="nombre_<?php echo $num; ?>" value="<?php echo $nombre; ?>">
                                        <input type="hidden" id="fehca_<?php echo $num; ?>" value="<?php echo $fecha; ?>">
                                        <input type="hidden" id="nombre_departamento_<?php echo $num; ?>" value="<?php echo $nombre_departamento; ?>">
                                        <input type="hidden" id="nombre_municipio_<?php echo $num; ?>" value="<?php echo $nombre_municipio; ?>">
                                        <input type="hidden" id="nombre_lugar_<?php echo $num; ?>" value="<?php echo $nombre_lugar; ?>">
                                        <input type="hidden" id="total_<?php echo $num; ?>" value="<?php echo $total; ?>">
                                        <input type="hidden" id="cod_departamento_<?php echo $num; ?>" value="<?php echo $cod_departamento; ?>">
                                        <input type="hidden" id="cod_municipio_<?php echo $num; ?>" value="<?php echo $cod_municipio; ?>">
                                        <input type="hidden" id="cod_lugar_<?php echo $num; ?>" value="<?php echo $cod_lugar; ?>">

                                        <i class="fa fa-eye" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="visualizarDonacion('<?php echo $num; ?>')"></i>

                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>


            </div>
        </div>
        <script type="text/javascript" src="datatables/don.js"></script>
        <script type="text/javascript" src="datatables/ent.js"></script>
        <script>
             function verModulo(ruta) {

                $.post(ruta, function(respuesta) {
                    $('#contenido').html(respuesta);
                });
                }
       

 
        
            

            /*function visualizarDonacion(id_donacion) {
                
                var data2 = {
                        "id_donacion":id_donacion,
                        
                        };
                fetch('detalle_entrante_en_CO/traerdetalle', {
                        method: 'POST',
                        body: JSON.stringify(data2),
                        headers: {
                            'Content-Type': 'application/json'// AQUI indicamos el formato
                        }
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        
                        if (respuesta.estado == 'EXITO') {

                            var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_entidad">

                              
                          
                                    <div class="form-group">
                                        <label for="nombre">nombre de la entidad</label>
                                        <input     type="text" class="form-control" id="nombre" name="nombre"
                                            value=" echo $fecha; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo">tipo de entidad</label>
                
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value=""></option>
                                            <option value="PRIVADA">PRIVADA</option>
                                            <option value="PUBLICA">PUBLICA</option>
                                        </select>
                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="nit">telefono de la entidad</label>
                                        <input   type="number" class="form-control" id="telefono" name="telefono"
                                            value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">correo</label>
                                        <input type="text" class="form-control" id="correo" name="correo"
                                            value="">
                                    </div>
                                    <input type="hidden" id="nit" name="nit" value="">
                                    <button type="button" onclick="actualizarentidad();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                        }
                    })

               
                document.querySelector('#titulo_modal').innerHTML = 'Datos donacion';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }*/

            function actualizarentidad() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_entidad'));

                fetch('entidades_CO/actualizarentidades', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {


                            let nit = document.querySelector('#formulario_actualizar_entidad #nit').value;
                            let nombre = document.querySelector('#formulario_actualizar_entidad #nombre').value;
                            let tipo = document.querySelector('#formulario_actualizar_entidad #tipo').value;
                            let telefono = document.querySelector('#formulario_actualizar_entidad #telefono').value;
                            let correo = document.querySelector('#formulario_actualizar_entidad #correo').value;
                            

                            document.querySelector('#nit_td_' + nit).innerHTML = nit;
                            document.querySelector('#nit_' + nit).value = nit;
                            document.querySelector('#nombre_td_' + nit).innerHTML = nombre;
                            document.querySelector('#nombre_' + nit).value = nombre;
                            document.querySelector('#tipo_td_' + nit).innerHTML = tipo;
                            document.querySelector('#tipo_' + nit).value = tipo;
                            document.querySelector('#telefono_td_' + nit).innerHTML = telefono;
                            document.querySelector('#telefono_' + nit).value = telefono;
                            document.querySelector('#correo_td_' + nit).innerHTML = correo;
                            document.querySelector('#correo_' + nit).value = correo;

                            toastr.success(respuesta.mensaje);

                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else if (respuesta.estado = 'ADVERTENCIA') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    });
            }
        </script>
<?php
    }
}
?>