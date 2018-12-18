var tabla;
//var idx=0;
var subprocesos = [];




// var fixHelperModified = function(e, tr) {
//     var $originals = tr.children();
//     var $helper = tr.clone();
//     $helper.children().each(function(index) {
//         $(this).width($originals.eq(index).width())
//     });
//     return $helper;
// },
//     updateIndex = function(e, ui) {
//         $('td.index', ui.item.parent()).each(function (i) {
//             $(this).html(i + 1);
//         });
//     };
//
// $("#table-autorizadores tbody").sortable({
//     helper: fixHelperModified,
//     stop: updateIndex
// }).disableSelection();



//Función que se ejecuta al inicio
function init() {
    listar();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    $("#formSubproceso").on("submit", function(event) {
        actualizarSubproceso(event);
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
    subprocesos = [];
    $("#table-subprocesos").find("tbody tr").remove();

    var filacero = '<tr id="filaCero" class="default sin-partidas">'+
          '<th class="text-center" colspan="4"><span class="sinDatos">No existen subprocesos<span> </th>'+
        '</tr>';
    $("#table-subprocesos tbody").append(filacero);



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
            url: 'views/ajax/procesos.php?op=listar',
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
        ], //Ordenar (columna,orden)
        "columnDefs": [
            { "width": "50%", "targets": 0 },
            { "width": "25%", "targets": 1 },
            { "width": "25%", "targets": 2 }
        ],
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

            var datos = eval(data);

            if (datos[0] == "Ok") {
                $("#idproceso").val(datos[1]);
                $("#exito-label").html('<strong>Bien hecho!</strong> Se ha guardado correctamente la información.').fadeIn(1000);
                $("#exito-label").delay(2000).fadeOut("slow");
                $("#btnGuardar").removeAttr("disabled");
                $("#listado-subprocesos").html(datos[2]);
                //estadoControles(true);
                subprocesos = [];

            } else if (datos[0] == "ERR01") {
                console.log(datos[0]);
                $("#fail-label").html('<strong>Atención!</strong> Ocurrio un error al grabar la información, intenta nuevamente.').fadeIn(1000);
                $("#fail-label").delay(2000).fadeOut("slow");
                $('#proceso').focus();
                $("#btnGuardar").removeAttr("disabled");

            } else {
                console.log(datos[0]);
                $("#fail-label").html('<strong>Atención!</strong> Algunos Subprocesos no fueron grabados, verifica la información.').fadeIn(1000);
                $("#fail-label").delay(2000).fadeOut("slow");
                $("#btnGuardar").removeAttr("disabled");
                $('#proceso').focus();

            }

        }

    });

}

function mostrar(info) {
    var result = info.split("|");

    mostrarform(true);
    $("#idproceso").val(result[0]);
    $("#proceso").val(result[1]);
    var idproceso = result[0];
    var condicion = 0;
    $.post("views/ajax/procesos.php?op=traerSubprocesos", {
        idproceso: idproceso,
        condicion: condicion
    }, function(data, status) {

        $("#listado-subprocesos").html(data);

    });

}

//Función para desactivar registros
function desactivar(info) {
    var result = info.split("-");
    //console.log(result[0]);
    swal({
            title: "¿Estás seguro?",
            text: "Se desactivará la empresa: " + result[1] + " y no lo podrá utilizar.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, Continuar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                confirmarDesactivar(result[0]);
            }
        });
}

function confirmarDesactivar(idsuscriptor) {

    var url = "views/ajax/admin_panel.php?op=desactivar";
    $.ajax({
        type: 'POST',
        url: url,
        data: ('idsuscriptor=' + idsuscriptor),
        success: function(respuesta) {
            if (respuesta == 1) {
                swal("¡Bien hecho!", "La empresa ha sido desactivado correctamente.", "success");
                tabla.ajax.reload();
            } else {
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
            text: "Se activará la empresa: " + result[1] + ", para utilizarlo en los registros.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, Continuar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                confirmarActivar(result[0]);
            }
        });
}

function confirmarActivar(idsuscriptor) {

    var url = "views/ajax/admin_panel.php?op=activar";
    $.ajax({
        type: 'POST',
        url: url,
        data: ('idsuscriptor=' + idsuscriptor),
        success: function(respuesta) {
            if (respuesta == 1) {
                swal("¡Bien hecho!", "La empresa ha sido activado correctamente.", "success");
                tabla.ajax.reload();
            } else {
                swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
            }
        }
    });
    return false;
}

//=================== Funciones para subprocesos======================
function insertarSubproceso(e) {
    if (e.keyCode === 13 && !e.shiftKey) {
        e.preventDefault();
        agregarSubproceso();
    }
}

function actualizarSubproceso(event){
  event.preventDefault();


  $("#btnGuardarSub").prop("disabled", true);
  var formData = new FormData($("#formSubproceso")[0]);

  $.ajax({
    url: "views/ajax/procesos.php?op=actualizarSubproceso",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(data) {
      var datos = eval(data);
      switch (datos[0]) {
         case "1":
           $("#exito-editarSubproceso").html('<strong>¡Bien hecho!</strong> ¡El Subproceso se actualizó correctamente!.').fadeIn(1000);
           $("#exito-editarSubproceso").delay(2000).fadeOut("slow");
           $('#subprocesomod').focus();
           $("#btnGuardarSub").removeAttr("disabled");
           $("#listado-subprocesos").html(datos[1]);
           break;
         case "2":
           console.log(datos);
           $("#fail-editarSubproceso").html('<strong>¡Atención!</strong> Lo sentimos, ocurrio un error al actualizar el registro').fadeIn(1000);
           $("#fail-editarSubproceso").delay(2000).fadeOut("slow");
           $('#subprocesomod').focus();
           $("#btnGuardarSub").removeAttr("disabled");
           break;
         case "3":
           console.log(datos);
           $("#fail-editarSubproceso").html('<strong>¡Atención!</strong> Ya existe un Subproceso con ese nombre').fadeIn(1000);
           $("#fail-editarSubproceso").delay(2000).fadeOut("slow");
           $('#subprocesomod').focus();
           $("#btnGuardarSub").removeAttr("disabled");
           break;
         case "4":
           console.log(datos);
           $("#fail-editarSubproceso").html('<strong>¡Atención!</strong> No existe el Id del Subproceso').fadeIn(1000);
           $("#fail-editarSubproceso").delay(2000).fadeOut("slow");
           $('#subprocesomod').focus();
           $("#btnGuardarSub").removeAttr("disabled");
           break;
         default:
           $("#fail-editarSubproceso").html('<strong>¡Atención!</strong> Ocurrio un error en el sistema. Intente nuevamente').fadeIn(1000);
           $("#fail-editarSubproceso").delay(2000).fadeOut("slow");
           $('#subprocesomod').focus();
           $("#btnGuardarSub").removeAttr("disabled");
           break;

       }

    }

  });

 return false;
}

function mostrarEdicionSubproceso (info){

  var result = info.split("|");
  $('#modalEditarSubproceso').modal({
    show: true
  });

  $("#idsubproceso").val(result[0]);
  $("#subprocesomod").val(result[1]);
  $("#idprocesomod").val(result[2]);

}

function agregarSubproceso() {

    //Evitar que inserte blanco o sin espacio o nulo
    var subp = $("#subproceso").val();
    if (subp == null || subp.length == 0 || /^\s+$/.test(subp)) {
        $("#subproceso").focus();
        return;
    }

    var idx = $('#table-subprocesos tr:last').attr('id');
    if ( idx == "filaCero"){
        idx = 1;
    }else{

        idx++;

    }

    if ($("#filaCero").length > 0) {

        $("#filaCero").remove();

    }
    //Obtiene el valor a ingresar
    var txtSub = $("#subproceso").val().toUpperCase();
    var data = $.trim(txtSub);

    //Valida si ya existe el proceso
    var yaexiste = false
    $("#table-subprocesos tbody tr").find('td:eq(1)').each(function () {
       //obtenemos el codigo de la celda
      codigo = $(this).html();
       //comparamos para ver si el código es igual a la busqueda
       if(codigo == data){
          yaexiste = true;
       }

     });

    if ( yaexiste ){

      $("#fail-label").html('<strong>Atención!</strong> Ya existe el Subproceso, intenta nuevamente.').fadeIn(1000);
      $("#fail-label").delay(2000).fadeOut("slow");
      $("#subproceso").focus();
      return false;

    }else{

      var filaPartida = '<tr id="' + idx + '">' +
          '<td class="text-center ">' + idx + '</td>' +
          '<td >' + data + '</td>' +
          '<td class="text-center"><span class="label bg-primary">PENDIENTE</span></td>' +
          '<td class="text-center">' +
          '<button type="button" class="eliminarfila btn btn-sm btn-default partidaCompra" data-toggle="tooltip" data-placement="top" title="Eliminar" >' +
          '<i class="fa fa-trash icon-color-danger"></i>' +
          '</button>' +
          '</td>' +
          '</tr>';
      //Inserta la nueva fila de partida
      $("#table-subprocesos tbody").append(filaPartida);

      subprocesos.push({
          index: idx,
          subproceso: data
      });

      //Limpia varlor de subproceso
      $("#subproceso").val("").focus();

    }

}


//Se ejecuta la hacer clic en el boton de eliminar y toma el id de la fila a eliminar
$(document).on("click", ".eliminarfila", function(){
  var fila = $(this).parents("tr").attr("id");
   eliminarSubprocesoSinGrabar(fila);
});

function eliminarSubprocesoSinGrabar(idx) {

  var idUsuario = $("#table-subprocesos tbody").parents("tr").attr("id");

    var indicador = 0;
    //Actualizar el arreglo eliminando la partida seleccionada
    for (var i = 0; i < subprocesos.length; i++) {

        if (subprocesos[i].index == idx) {
            indicador = subprocesos[i].index;
            subprocesos.splice(i, 1);
             break;
        }

    }

    $("#table-subprocesos").find("tbody tr#" + idx).remove();


    if ($('#table-subprocesos >tbody >tr').length == 0) {
        var fila = '<tr id="filaCero" class="default sin-partidas" >' +
            '<th class="text-center" colspan="4"><span class="sinDatos">No existen subprocesos<span> </th>' +
            '</tr>';
        $("#table-subprocesos tbody").append(fila);
        return;
    }

    //Recorrer filas para actualizar el consecutivo
    // var idx = $(this).find("td").eq(0).html();
    // console.log({idx, valor});
    var cont = 1;
    $('#table-subprocesos >tbody >tr').each(function () {
      var valor = $(this).find("td").eq(1).html();
      $(this).find("td:first").html(cont);
      $(this).attr('id', cont);
      cont++;

    });


    if( subprocesos.length > 0 ){
      for (var j = 0; j < subprocesos.length; j++) {

        if (subprocesos[j].index > indicador ) {
          subprocesos[j].index = subprocesos[j].index - 1;

        }
      }

    }


}

function desactivarSub(info){

  var result = info.split("|");
  //console.log(result[0]);
  swal({
            title: "¿Estás seguro?",
            text: "Se desactivará el Subproceso: "+ result[1] + " y no se podrá utilizar.",
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
            confirmarDesactivarSub(result[0], result[2]);
          }
      });
}

function confirmarDesactivarSub(idsubproceso, idproceso){

    var url = "views/ajax/procesos.php?op=desactivarSub";
      $.ajax({
        type: 'POST',
        url: url,
        data:{
            idsubproceso,
            idproceso
          },
        success: function (respuesta) {
            var datos = eval(respuesta);

            if (datos[0] == 1) {
                swal("¡Bien hecho!", "El Subproceso ha sido desactivado correctamente.", "success");
                $("#listado-subprocesos").html(datos[1]);
            }else{
              swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
            }
        }
      });
      return false;
}

//Función para activar registros
function activarSub(info) {
  var result = info.split("|");
  //console.log(result[0]);
  swal({
            title: "¿Estás seguro?",
            text: "Se activará el Subproceso: "+ result[1] + ", y podrá ser utilizado.",
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
            confirmarActivarSub(result[0], result[2]);
          }
      });
}

function confirmarActivarSub(idsubproceso, idproceso){

    var url = "views/ajax/procesos.php?op=activarSub";
      $.ajax({
        type: 'POST',
        url: url,
        data:{
            idsubproceso,
            idproceso
          },
        success: function (respuesta) {
          var datos = eval(respuesta);
          if (datos[0] == 1) {
              swal("¡Bien hecho!", "El Subproceso ha sido activado correctamente.", "success");
              $("#listado-subprocesos").html(datos[1]);
          }else{
            swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
          }
        }
      });
      return false;
}

function eliminarSubproceso(info){
  var result = info.split("|");
  console.log(result);
  swal({
            title: "¿Estás seguro?",
            text: "Se enviará a la bandeja de recicle el Subproceso: "+ result[1] + ".",
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
            confirmarEliminarSub(result[0], result[2]);
          }
      });
}

function confirmarEliminarSub(idsubproceso, idproceso){

    var url = "views/ajax/procesos.php?op=eliminarSub";
      $.ajax({
        type: 'POST',
        url: url,
        data:{
            idsubproceso,
            idproceso
          },
        success: function (respuesta) {
          var datos = eval(respuesta);
          if (datos[0] == 1) {
              swal("¡Bien hecho!", "El Subproceso ha sido eliminado correctamente.", "success");
              $("#listado-subprocesos").html(datos[1]);
          }else{
            console.log(datos);
            swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
          }
        }
      });
      return false;
}


//===================== Funciones para Publicar Proceso y Subprocesos

function publicar(info){
  var result = info.split("|");
  //console.log(result[0]);
  swal({
            title: "¿Estás seguro?",
            text: "Se publicará el Proceso: "+ result[1] + ", y será visible a los usuarios del sistema.",
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
            confirmarPublicarProceso(result[0], result[1]);
          }
      });
}

function confirmarPublicarProceso(idproceso, proceso){

    var url = "views/ajax/procesos.php?op=publicarProceso";
      $.ajax({
        type: 'POST',
        url: url,
        data:{
            idproceso,
            proceso
          },
        success: function (respuesta) {
          //console.log(respuesta);
          // var datos = eval(respuesta);
          if (respuesta == 1) {
              swal("¡Bien hecho!", "El Subproceso ha sido publicado correctamente, en el siguiente inicio de sesión será visible.", "success");

          }else{
            swal("Atención", "Ocurrio un error al publicar el proceso, intente nuevamente", "error");
          }
        }
      });
      return false;
}

init();
