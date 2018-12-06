var tabla;
var idx=0;
var subprocesos= [];

//Función que se ejecuta al inicio
function init() {
  listar();
  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

  $("#formularioAdmin").on("submit", function(even) {
    guardaryeditarAdmin(even);
  });

}

//Función limpiar
function limpiar() {

  $('#formulario')[0].reset();

}

//Función mostrar formulario
function mostrarform(flag) {
  limpiar();
  if (flag) {
    $("#listadoregistros").slideUp(500);
    $("#formularioregistros").slideDown(500);
    $("#btnGuardar").prop("disabled", false);
    //$("#btnagregar").hide();
    $("#btnagregar").fadeOut("slow");



  } else {
    $("#listadoregistros").slideDown(500);
    $("#formularioregistros").slideUp(500);
    //$("#btnagregar").show();
    $("#btnagregar").fadeIn("slow");

  }
}

//Función cancelarform
function cancelarform() {
  limpiar();
  mostrarform(false);
  tabla.ajax.reload();
}


//Función Listar
function listar() {
  tabla = $('#tbllistado').dataTable({
    "aProcessing": true, //Activamos el procesamiento del datatables
    "aServerSide": true, //Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip', //Definimos los elementos del control de tabla
    buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],
    "ajax": {
      url: 'views/ajax/admin_panel.php?op=listar',
      type: "get",
      dataType: "json",
      error: function(e) {
        console.log(e.responseText);
      }
    },

    "bDestroy": true,
    "iDisplayLength": 5, //Paginación
    "order": [
      [0, "asc"]
    ] //Ordenar (columna,orden)
  }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
  e.preventDefault();
  
  $("#btnGuardar").prop("disabled", true);

  var idproceso = $("#idproceso").val();
  var proceso = $("#proceso").val();
  $.ajax({
    url: "views/ajax/procesos.php?op=guardaryeditar",
    type: "POST",
    data: {
            idproceso,
            proceso,
            'array': JSON.stringify(subprocesos)
          },
    success: function(data) {
      console.log(data);
      var datos = eval(data);

        if(datos[0] == "Ok"){
          $("#idcompra").val(datos[1]);
          $("#exito-label").html('<strong>Bien hecho!</strong> Se ha guardado correctamente la información.').fadeIn(1000);
          $("#exito-label").delay(2000).fadeOut("slow");
          $("#btnGuardar").removeAttr("disabled");
          $("#listado-subprocesos").html(datos[2]);
          //estadoControles(true);

        }else if (datos[0]=="ERR01") {
          console.log(datos[0]);
          $("#fail-label").html('<strong>Atención!</strong> Ocurrio un error al grabar la información, intenta nuevamente.').fadeIn(1000);
          $("#fail-label").delay(2000).fadeOut("slow");
          $('#proceso').focus();
          $("#btnGuardar").removeAttr("disabled");

        }else{
          console.log(datos[0]);
          $("#fail-label").html('<strong>Atención!</strong> Algunos Subprocesos no fueron grabadas, verifica la información.').fadeIn(1000);
          $("#fail-label").delay(2000).fadeOut("slow");
          $("#btnGuardar").removeAttr("disabled");
          $('#proceso').focus();

        }



    }

  });

}

function mostrar(idsuscriptor) {

  $.post("views/ajax/admin_panel.php?op=mostrar", {
    idsuscriptor: idsuscriptor
  }, function(data, status) {
    data = JSON.parse(data);
    mostrarform(true);

    //Como estan definidos los campos en la base de datos
    $("#rfc").val(data.rfc);
    $("#nombre_empresa").val(data.nombre_empresa);
    $("#telefono").val(data.telefono);
    $("#cantidad_admin").val(data.cantidad_admin);
    $("#limite_usuarios").val(data.limite_usuarios);
    $("#capacidad_almacenamiento").val(data.capacidad_almacenamiento);
    $("#carpeta").val(data.carpeta);
    $("#idsuscriptor").val(data.idsuscriptor);
    $("#carpeta").attr('disabled', true);
  });
}

//Función para desactivar registros
function desactivar(info) {
  var result = info.split("-");
  //console.log(result[0]);
  swal({
            title: "¿Estás seguro?",
            text: "Se desactivará la empresa: "+ result[1] + " y no lo podrá utilizar.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, Continuar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            showLoaderOnConfirm:true,
            closeOnCancel: true
      },
      function(isConfirm){
          if (isConfirm) {
            confirmarDesactivar(result[0]);
          }
      });
}

function confirmarDesactivar(idsuscriptor){

    var url = "views/ajax/admin_panel.php?op=desactivar";
      $.ajax({
        type: 'POST',
        url: url,
        data:('idsuscriptor='+ idsuscriptor),
        success: function (respuesta) {
            if (respuesta == 1) {
                swal("¡Bien hecho!", "La empresa ha sido desactivado correctamente.", "success");
                tabla.ajax.reload();
            }else{
              swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
            }
        }
      });
      return false;
}

//Función para activar registros
function activar(info) {
  var result = info.split("-");
  //console.log(result[0]);
  swal({
            title: "¿Estás seguro?",
            text: "Se activará la empresa: "+ result[1] + ", para utilizarlo en los registros.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, Continuar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            showLoaderOnConfirm:true,
            closeOnCancel: true
      },
      function(isConfirm){
          if (isConfirm) {
            confirmarActivar(result[0]);
          }
      });
}

function confirmarActivar(idsuscriptor){

    var url = "views/ajax/admin_panel.php?op=activar";
      $.ajax({
        type: 'POST',
        url: url,
        data:('idsuscriptor='+ idsuscriptor),
        success: function (respuesta) {
            if (respuesta == 1) {
                swal("¡Bien hecho!", "La empresa ha sido activado correctamente.", "success");
                tabla.ajax.reload();
            }else{
              swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
            }
        }
      });
      return false;
}

//=================== Funciones para insertar subprocesos======================
function insertarSubproceso(e) {
    if (e.keyCode === 13 && !e.shiftKey) {
        e.preventDefault();
        agregarSubproceso();
    }
}


function agregarSubproceso(){

  //Evitar que inserte blanco o sin espacio o nulo
  var subp = $("#subproceso").val();
  if( subp == null || subp.length == 0 || /^\s+$/.test(subp) ){
    $("#subproceso").focus();
    return;
  }


  idx++;

  if ( $("#filaCero").length > 0 ) {

    $("#filaCero").remove();

  }
  var data = $("#subproceso").val().toUpperCase();

  var filaPartida='<tr id="fila'+ idx +'">'+
                     '<td >'+ idx +'</td>'+
                     '<td >'+ data +'</td>'+
                     '<td ><span class="label bg-primary">PENDIENTE</span></td>'+
                     '<td class="text-center col-sm-3">'+
                        '<button type="button" class="btn btn-sm btn-default partidaCompra" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarSubprocesoSinGrabar('+idx+')">'+
                            '<i class="fa fa-trash icon-color-danger"></i>'+
                        '</button>'+
                        '</td>'+
                   '</tr>';
   //Inserta la nueva fila de partida
   $("#table-subprocesos tbody").append(filaPartida);

   subprocesos.push({
     index : idx,
     subproceso : data
   });

   //Limpia varlor de subproceso
   $("#subproceso").val("").focus();
   //$("#subproceso").focus();
   console.log(subprocesos);

}

function eliminarSubprocesoSinGrabar(idx){

  //Actualizar el arreglo eliminando la partida seleccionada
  for(var i = 0; i < subprocesos.length; i++) {
    if (subprocesos[i].indice== idx) {
        subprocesos.splice(i,1);
        break;
    }
  }




  $("#table-subprocesos").find("tbody tr#fila"+idx).remove();

  
  if ($('#table-subprocesos >tbody >tr').length == 0){
    var fila='<tr id="filaCero" class="default sin-partidas" >' +
              '<th class="text-center" colspan="4"><span class="sinDatos">No existen subprocesos<span> </th>' +
            '</tr>';
    $("#table-subprocesos tbody").append(fila);
    
  }

}

init();
