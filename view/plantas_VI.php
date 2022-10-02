<?php

class plantas_VI
{

    function __construct()
    {
    }

    function agregarPlantas()
    {

        require_once "models/plantas_MO.php";
        require_once "models/estados_MO.php";
        require_once "models/familias_MO.php";
        require_once "models/habitos_MO.php";
        require_once "models/origenes_MO.php";
        $conexion = new conexion();
        $plantas_MO = new plantas_MO($conexion);
        $familias_MO = new familias_MO($conexion);
        $origenes_MO = new origenes_MO($conexion);
        $habitos_MO = new habitos_MO($conexion);
        $estados_MO = new estados_MO($conexion);
        $arreglo_plantas = $plantas_MO->seleccionar();     
        $arreglo_familias = $familias_MO->seleccionar();   
        $arreglo_origenes = $origenes_MO->seleccionar();  
        $arreglo_habitos = $habitos_MO->seleccionar();
        $arreglo_estados = $estados_MO->seleccionar();
        $existe=1;

?>
        <div class="card">
        <div class="card-header">
                consultar plantas del inventario
            </div>
            <div class="card-body">
                <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" placeholder="Ingresar nombre de la especie, comun o familia" class="form-control" id="especie" name="especie">
                                 
                            </div>
                        </div>
                        <div class="col-md-6">
                         
                            <button class="btn btn-outline-success  type="button" onclick="agregarplantas();" class="btn btn-success float-right">Consultar</button>
                        </div>
                </div>
        </div>
        </div>
        <div class="card">
            <div class="card-header">
                Agregar plantas al inventario
            </div>
            <div class="card-body">
                <form id="formulario_agregar_plantas">

                    <div class="row">
                       
                        <div class="col-md-3">
                            <label for="familia">Nombre familia</label>
                            <select class="form-control" name="familia" id="familia">
                                <option value=""></option>
                                <?php
                                if ($arreglo_familias) {

                                    foreach ($arreglo_familias as $objeto_familia) {
                                        $nombre_familia = $objeto_familia->nombre_familia;

                                ?>
                                        <option value="<?php echo $nombre_familia; ?>"><?php echo  $nombre_familia; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="cod_origen">Nombre origen</label>
                            <select class="form-control" name="cod_origen" id="cod_origen">
                                <option value=""></option>
                                <?php
                                if ($arreglo_origenes) {

                                    foreach ($arreglo_origenes as $objeto_origen) {
                                        $cod_origen = $objeto_origen->cod_origen;
                                        $nombre_origen = $objeto_origen->nombre_origen;

                                ?>
                                        <option value="<?php echo $cod_origen; ?>"><?php echo  $nombre_origen; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="cod_estado">Estado de conservacion</label>
                            <select class="form-control" name="cod_estado" id="cod_estado">
                                <option value=""></option>
                                <?php
                                if ($arreglo_estados) {

                                    foreach ($arreglo_estados as $objeto_estado) {
                                        $cod_estado = $objeto_estado->cod_estado;
                                        $nombre = $objeto_estado->nombre;

                                ?>
                                        <option value="<?php echo $cod_estado; ?>"><?php echo  $nombre; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="cod_habito">Habito de crecimiento</label>
                            <select class="form-control" name="cod_habito" id="cod_habito">
                                <option value=""></option>
                                <?php
                                if ($arreglo_habitos) {

                                    foreach ($arreglo_habitos as $objeto_habito) {
                                        $cod_habito = $objeto_habito->cod_habito;
                                        $nombre = $objeto_habito->nombre;

                                ?>
                                        <option value="<?php echo $cod_habito; ?>"><?php echo  $nombre; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="especie">Nombre Especie</label>
                                <input type="text" class="form-control" id="especie" name="especie">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre_comun">Nombre comun</label>
                                <input type="text" class="form-control" id="nombre_comun" name="nombre_comun">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="caracteristica">Caracteristicas</label>
                                <input type="text" class="form-control" id="caracteristica" name="caracteristica">

                            </div>
                        </div>
                        <div class="col-md-12">
                        <br>
                            <button type="button" onclick="agregarplantas();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <?php 
        
          if($existe==1){
            ?>
             <div class="card">
                <div class="card-header">
                    Listar plantas del inventario
                </div>
                <div class="card-body">
                   <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th style="text-align: center;">Especie</th>
                                <th style="text-align: center;">Familia</th>
                                <th style="text-align: center;">Origen</th>
                                <th style="text-align: center;">Estado</th>
                                <th style="text-align: center;">Habito</th>
                                <th style="text-align: center;">Nombre Comun</th>
                                <th style="text-align: center;">Stock</th>
                                <th style="text-align: center;">Accion</th>
                            </tr>
                        </thead>
                        <tbody id="lista_plantas">
                            <?php
                            if ($arreglo_plantas) {

                                foreach ($arreglo_plantas as $objeto_plantas) {
                                    $cod_origen= $objeto_plantas->cod_origen;
                                    $cod_estado= $objeto_plantas->cod_estado;
                                    $cod_habito= $objeto_plantas->cod_habito;
    
                                    $arreglo_origen = $origenes_MO->seleccionar($cod_origen);
                                    $objeto_origen = $arreglo_origen[0];
                                    $nombre_origen = $objeto_origen->nombre_origen;
                                    $arreglo_estado = $estados_MO->seleccionar($cod_estado);
                                    $objeto_estado = $arreglo_estado[0];
                                    $nombre_estado = $objeto_estado->nombre;
                                    $arreglo_habito = $habitos_MO->seleccionar($cod_habito);
                                    $objeto_habito = $arreglo_habito[0];
                                    $nombre_habito = $objeto_habito->nombre;

                                    $especie= $objeto_plantas->nombre_familia;
                                    $familia = $objeto_plantas->nombre_familia;
                                    $nombre_comun = $objeto_plantas->nombre_comun;
                                    $stock = $objeto_plantas->stock;
                            ?>
                                    <tr>
                                        <td id="especie_td_<?php echo $especie; ?>"> <?php echo $especie; ?> </td>
                                        <td id="familia_td_<?php echo $especie; ?>"> <?php echo $familia; ?> </td>
                                        <td id="nombre_origen_td_<?php echo $especie; ?>"> <?php echo $nombre_origen; ?> </td>
                                        <td id="nombre_estado_td_<?php echo $especie; ?>"> <?php echo $nombre_estado; ?> </td>
                                        <td id="nombre_habito_td_<?php echo $especie; ?>"> <?php echo $nombre_habito; ?> </td>
                                        <td id="nombre_comun_td_<?php echo $especie; ?>"> <?php echo $nombre_comun; ?> </td>
                                        <td id="stock_td_<?php echo $especie; ?>"> <?php echo $stock; ?> </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="especie_<?php echo $especie; ?>" value="<?php echo $especie; ?>">
                                            <input type="hidden" id="familia_<?php echo $especie; ?>" value="<?php echo $familia; ?>">
                                            <input type="hidden" id="nombre_origen_<?php echo $especie; ?>" value="<?php echo $nombre_origen; ?>">
                                            <input type="hidden" id="nombre_estado_<?php echo $especie; ?>" value="<?php echo $nombre_estado; ?>">
                                            <input type="hidden" id="nombre_habito_<?php echo $especie; ?>" value="<?php echo $nombre_habito; ?>">
                                            <input type="hidden" id="nombre_comun_<?php echo $especie; ?>" value="<?php echo $nombre_comun; ?>">
                                            <input type="hidden" id="stock_<?php echo $especie; ?>" value="<?php echo $stock; ?>">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarplantas('<?php echo $especie; ?>')"></i>
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
            </div>
        <?php }

         ?>
        <script>
            function agregarplantas() {


                var cadena = new FormData(document.querySelector('#formulario_agregar_plantas'));

                fetch('plantas_CO/agregarplantas', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let familia = document.querySelector('#formulario_agregar_plantas #familia').value;
                        let caracteristica = document.querySelector('#formulario_agregar_plantas #caracteristica').value;
                        if (respuesta.estado == 'EXITO') {
             /*
                            let fila = `
                                    <tr>
                                            <td id="familia_td_${familia}"> ${familia} </td>
                                            <td id="caracteristica_td_${familia}"> ${caracteristica} </td>
                                            <td style="text-align: center;">
                                                <input type="hidden" id="familia_${familia}" value="${familia}">
                                                <input type="hidden" id="caracteristica_${familia}" value="${caracteristica}">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarplantas('${familia}')"></i>
                                            </td>
                                        </tr>

                                    <tr>`;
                            document.querySelector('#lista_plantas').insertAdjacentHTML('afterbegin', fila);
                            document.querySelector('#formulario_agregar_plantas ').reset();
*/
                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarplantas(especie) {
                let especie = document.querySelector('#especie_' + especie).value;
                let familia = document.querySelector('#familia_' + especie).value;
                let nombre_origen = document.querySelector('#nombre_origen__' + especie).value;
                let nombre_estado = document.querySelector('#nombre_estado_' + especie).value;
                let nombre_habito = document.querySelector('#nombre_habito_' + especie).value;
                let nombre_comun = document.querySelector('#nombre_comun_' + especie).value;
                let stock = document.querySelector('#stock_' + especie).value;

                var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_plantas">

                              
                          
                                    <div class="form-group">
                                        <label for="familia">nombre de la  familia</label>
                                        <input type="text" class="form-control" id="familia" name="familia"
                                            value="${familia}">
                                    </div>
                                    <div class="form-group">
                                        <label for="caracteristica">caracteristica</label>
                                        <input type="text" class="form-control" id="caracteristica" name="caracteristica"
                                            value="${caracteristica}">
                                    </div>
                                    <input type="hidden" id="family" name="family" value="${familia}">
                                    <button type="button" onclick="actualizarplantas();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar plantas';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarplantas() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_plantas'));

                fetch('plantas_CO/actualizarplantas', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {


                            let familia = document.querySelector('#formulario_actualizar_plantas #familia').value;

                            let nombre = document.querySelector('#formulario_actualizar_plantas #family').value;

                            let caracteristica = document.querySelector('#formulario_actualizar_plantas #caracteristica').value;

                            document.querySelector('#familia_td_' + nombre).innerHTML = familia;
                            document.querySelector('#familia_' + nombre).value = familia;
                            document.querySelector('#caracteristica_td_' + nombre).innerHTML = caracteristica;
                            document.querySelector('#caracteristica_' + nombre).value = caracteristica;



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