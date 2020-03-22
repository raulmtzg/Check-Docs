
var tabla;

function init(){

  listar();

  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

}


//=======================================
// Listar TIPOS Documentos
//=======================================
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
      url: 'views/ajax/tipo_documento.php?op=listar',
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


//=======================================
// Insertar / editar usuario
//=======================================
function guardaryeditar(e){
  e.preventDefault();
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "views/ajax/tipo_documento.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos) {

      if (datos == "1" ){

        $("#exito-label").html('<strong>¡Bien hecho!</strong> ¡Se grabo correctamente el registro!.').fadeIn(1000);
        $("#exito-label").delay(2000).fadeOut("slow");
        $('#nombre_completo').focus();
        $("#btnGuardar").removeAttr("disabled");

      }else if (datos == "2") {

        $("#fail-label").html('<strong>¡Atención!</strong> Ocurrio un error al grabar el registro. Intente nuevamente').fadeIn(1000);
        $("#fail-label").delay(2000).fadeOut("slow");
        $('#nombre_completo').focus();
        $("#btnGuardar").removeAttr("disabled");

      }else if (datos == "3") {
        $("#fail-label").html('<strong>¡Atención!</strong> Ya existe un tipo con esa descripción. Intente nuevamente.').fadeIn(1000);
        $("#fail-label").delay(2000).fadeOut("slow");
        $('#nombre_completo').focus();
        $("#btnGuardar").removeAttr("disabled");

      }else if (datos == "4") {
        $("#fail-label").html('<strong>¡Atención!</strong> Ocurrio un error al grabar el registro. Intente nuevamente.').fadeIn(1000);
        $("#fail-label").delay(2000).fadeOut("slow");
        $('#nombre_completo').focus();
        $("#btnGuardar").removeAttr("disabled");

      }else{

        $("#fail-label").html('<strong>¡Atención!</strong> Ocurrio un error. Intente nuevamente').fadeIn(1000);
        $("#fail-label").delay(2000).fadeOut("slow");
        $('#nombre_completo').focus();
        $("#btnGuardar").removeAttr("disabled");

      }

    }

  });

}

//=======================================
// Mostrar fomrulario para editar usuario
//=======================================
function mostrarDatos(idtipodocumento){
  $.post("views/ajax/tipo_documento.php?op=mostrar", {
    idtipodocumento: idtipodocumento
  }, function(data, status) {
    data = JSON.parse(data);
    //Como estan definidos los campos en la base de datos
    $("#idtipodocumento").val(data.idtipodocumento);
    $("#descripcion").val(data.descripcion);

    mostrarform(true);

  });

}


//=======================================
// mostrar / ocultar formulario
//=======================================
function mostrarform(flag) {
  //limpiar();
  if (flag) {
    $("#listadoregistros").slideUp(500);
    $("#formularioregistros").slideDown(500);
    $("#btnNuevoDocto").fadeOut("slow");

  } else {
    $("#listadoregistros").slideDown(500);
    $("#formularioregistros").slideUp(500);
    $("#btnNuevoDocto").fadeIn("slow");

  }
}

//=======================================
// Cancelar nuevo / edicion de tipo documento
//=======================================
function cancelarform(){
  $('#formulario')[0].reset();
  //limpiar();
  mostrarform(false);
  tabla.ajax.reload();
}

//=======================================
// Desactivar tipo documento
//=======================================
function desactivar(info){
  console.log(info);
  var result = info.split("|");
  swal({
            title: "¿Estás seguro?",
            text: "Se desactivará el tipo: "+ result[1] + ", y no lo podrá ser utilizado en Check-Docs.",
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

function confirmarDesactivar(idtipodocumento){

    var url = "views/ajax/tipo_documento.php?op=desactivar";
      $.ajax({
        type: 'POST',
        url: url,
        data:('idtipodocumento='+ idtipodocumento),
        success: function (respuesta) {
            if (respuesta == 1) {
                swal("¡Bien hecho!", "El tipo de documento ha sido desactivado correctamente.", "success");
                tabla.ajax.reload();
            }else{
              swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
            }
        }
      });
      return false;
}

//=======================================
// Activar usuario
//=======================================


function activar(info) {
  var result = info.split("|");
  swal({
            title: "¿Estás seguro?",
            text: "Se activará el tipo de documento: "+ result[1] + ", para poder usarse en Check-Docs.",
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

function confirmarActivar(idtipodocumento){

    var url = "views/ajax/tipo_documento.php?op=activar";
      $.ajax({
        type: 'POST',
        url: url,
        data:('idtipodocumento='+ idtipodocumento),
        success: function (respuesta) {
            if (respuesta == 1) {
                swal("¡Bien hecho!", "El tipo de documento ha sido activado correctamente.", "success");
                tabla.ajax.reload();
            }else{
              swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
            }
        }
      });
      return false;
}



init();
