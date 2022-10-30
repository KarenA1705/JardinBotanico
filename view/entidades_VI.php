<?php

class entidades_VI
{

    function __construct()
    {
    }

    function agregarentidades()
    {

        require_once "models/entidad_MO.php";
        $conexion = new conexion();
        $entidades_MO = new entidad_MO($conexion);
        $arreglo_entidad= $entidades_MO->seleccionar();

?>
        <div class="card">
        <div class="card-header">
                Agregar entidades 
            </div>
            <div class="card-body">
                <form id="formulario_agregar_entidad">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nit">NIT Entidad</label>
                                <input    type="text" class="form-control" id="nit" name="nit">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">nombre Entidad</label>
                                <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">Tipo de Entidad</label>
                                <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="tipo" name="tipo">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">Telefono</label>
                                <input   type="number" class="form-control" id="telefono" name="telefono">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="nombre">Correo de la Entidad</label>
                                <input   type="text" class="form-control" id="correo" name="correo">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Contraseña</label>
                                <input    type="text" class="form-control" id="contrasena" name="contrasena">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <button type="button" onclick="agregarentidad();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Listar entidades
            </div>
            <div class="card-body">

                <table id="example1" class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nit</th>
                            <th style="text-align: center;">Nombre </th>
                            <th style="text-align: center;">Tipo </th>
                            <th style="text-align: center;">Telefono </th>
                            <th style="text-align: center;">correo</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_entidad">
                        <?php
                        if ($arreglo_entidad) {

                            foreach ($arreglo_entidad as $objeto_entidad) {

                                $nit = $objeto_entidad->nit;
                                $nombre = $objeto_entidad->nombre_entidad;
                                $tipo = $objeto_entidad->tipo_entidad;
                                $telefono = $objeto_entidad->telefono;
                                $correo = $objeto_entidad->correo;
                        ?>
                                <tr>
                                    <td id="nit_td_<?php echo $nit; ?>"> <?php echo $nit; ?> </td>
                                    <td id="nombre_td_<?php echo $nit; ?>"> <?php echo $nombre; ?> </td>
                                    <td id="tipo_td_<?php echo $nit; ?>"> <?php echo $tipo; ?> </td>
                                    <td id="telefono_td_<?php echo $nit; ?>"> <?php echo $telefono; ?> </td>
                                    <td id="correo_td_<?php echo $nit; ?>"> <?php echo $correo; ?> </td>
                                    <td style="text-align: center;">
                                        <input type="hidden" id="nit_<?php echo $nit; ?>" value="<?php echo $nit; ?>">
                                        <input type="hidden" id="nombre_<?php echo $nit; ?>" value="<?php echo $nombre; ?>">
                                        <input type="hidden" id="tipo_<?php echo $nit; ?>" value="<?php echo $tipo; ?>">
                                        <input type="hidden" id="telefono_<?php echo $nit; ?>" value="<?php echo $telefono; ?>">
                                        <input type="hidden" id="correo_<?php echo $nit; ?>" value="<?php echo $correo; ?>">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarestado('<?php echo $nit; ?>')"></i>
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
        <script type="text/javascript" src="datatables/ent.js"></script>
        <script>
            function agregarentidad() {


                var cadena = new FormData(document.querySelector('#formulario_agregar_entidad'));

                fetch('entidades_CO/agregarentidades', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let nit = document.querySelector('#formulario_agregar_entidad #nit').value;
                        let nombre = document.querySelector('#formulario_agregar_entidad #nombre').value;
                        let tipo = document.querySelector('#formulario_agregar_entidad #tipo').value;
                        let telefono = document.querySelector('#formulario_agregar_entidad #telefono').value;
                        let correo = document.querySelector('#formulario_agregar_entidad #correo').value;
                        let contrasena = document.querySelector('#formulario_agregar_entidad #contrasena').value;
                        if (respuesta.estado == 'EXITO') {

                            let fila = `
                                    <tr>
                                            <td id="nit_td_${nit}"> ${nit} </td>
                                            <td id="nombre_td_${nit}"> ${nombre } </td>
                                            <td id="tipo_td_${nit}"> ${tipo } </td>
                                            <td id="telefono_td_${nit}">${telefono }  </td>
                                            <td id="correo_td_${nit}">${contrasena }  </td>
                                            <td style="text-align: center;">
                                                <input type="hidden" id="nit_${nit}" value="${nit}">
                                                <input type="hidden" id="nombre_${nit}" value="${nombre }">
                                                <input type="hidden" id="tipo_${nit}" value="${tipo }">
                                                <input type="hidden" id="telefono_${nit}" value="${telefono }">
                                                <input type="hidden" id="correo_${nit}" value="${correo }">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarestado('${nit}')"></i>
                                            </td>
                                        </tr>

                                    <tr>`;
                            document.querySelector('#lista_entidad').insertAdjacentHTML('afterbegin', fila);
                            document.querySelector('#formulario_agregar_entidad ').reset();

                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarestado(cod) {

                let nit = document.querySelector('#nit_' + cod).value;
                let nombre = document.querySelector('#nombre_' + cod).value;
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_estado">

                              
                          
                                    <div class="form-group">
                                        <label for="nit">nit del origen</label>
                                        <input   type="text" class="form-control" id="nit" name="nit"
                                            value="${nit}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">nombre del origen</label>
                                        <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="nombre" name="nombre"
                                            value="${nombre}">
                                    </div>
                                    <input type="hidden" id="codige" name="codige" value="${nit}">
                                    <button type="button" onclick="actualizarestado();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar estado';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarestado() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_estado'));

                fetch('entidades_CO/actualizarentidades', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {


                            let nit = document.querySelector('#formulario_actualizar_estado #nit').value;

                            let codige = document.querySelector('#formulario_actualizar_estado #codige').value;

                            let nombre = document.querySelector('#formulario_actualizar_estado #nombre').value;

                            document.querySelector('#nit_td_' + codige).innerHTML = nit;
                            document.querySelector('#nit_' + codige).value = nit;
                            document.querySelector('#nombre_td_' + codige).innerHTML = nombre;
                            document.querySelector('#nombre_' + codige).value = nombre;



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