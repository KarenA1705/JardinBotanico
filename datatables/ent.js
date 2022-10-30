$(document).ready(function(){
    //$('#example').DataTable();
$('#example1').DataTable({
    "language":{
       "lengthMenu":"Mostrar _MENU_  Registros",
       "zeroRecords":"no se encontraron resultados",
       "info":"registros del _START_ al _END_ de un total de _TOTAL_ registros",
       "infoEmpty":"no hay registros",
       "infoFiltered":"(filtrado de un total de _MAX_ registros)",
       "sSearch":"buscar por nombre:",
       "oPaginate":{
          "sFirst":"primero",
          "sLast":"ultimo",
          "sNext":"siguiente",
          "sPrevious":"anterior"
       },
       "sProcessing":"procesando....",
    }
  });
});