var filaDocumento;
var subproceso;

$(document).ready(function(){
  var URLactual = window.location;
  getUbicacion(URLactual.pathname);

$('#fecharevision').datepicker({
    autoclose: true,
    language: 'es',
    startDate: '01/01/2018',
    format: 'dd/mm/yyyy'
  });



});


// $('.derecho').on('contextmenu', function(e) {
$('body').on('contextmenu','.derecho', function(e) {
  e.preventDefault();
  filaDocumento = $(this).data("id");
  superCm.createMenu([
    {
      icon: 'fa fa-eye',
      label: 'Ver documento',
      opc:'verDocto',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-edit',
      label: 'Editar documento',
      opc:'editarDocumento',
      action: process,
      identificador: filaDocumento
    },

    {
      icon: 'fa fa-upload',
      label: 'Subir nueva versión',
      opc:'versionDocto',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-download',
      label: 'Descargar original',
      opc:'versionDocto',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-print',
      label: 'Imprimir',
      opc: 'print',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-pencil',
      label: 'Cambios',
      opc: 'print',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-thumb-tack',
      label: 'Propuestas',
      opc: 'print',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-check',
      label: 'Revisión actual',
      opc: 'print',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-archive',
      label: 'Versiones obsoletas',
      opc: 'print',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-clock-o',
      label: 'Historial de revisiones',
      opc: 'print',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-print',
      label: 'Impresiones',
      opc: 'print',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-users',
      label: 'Usuarios',
      opc: 'print',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-times',
      label: 'Eliminar',
      opc: 'print',
      action: process,
      identificador: filaDocumento
    },
  ], e);
});

//==================================================
// Funciones para menu contextual
//==================================================
function process(option) {
  // alert('Processing user with ID ' + option.idRow + ' and role ' + option.role);

  switch (option.opc) {

    case 'verDocto':
    verDocto(option.identificador);
    break;
    case 'print':
    printDocto(option.identificador);
    break;
    case 'editarDocumento':
    editarDocumento(option.identificador);
    default:

  }
  superCm.updateMenu(allowHorzReposition = true, allowVertReposition = true);
  superCm.destroyMenu();
}

function init(){
  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });


}

function listarDocumentos() {

  var url = "views/ajax/documentos.php?op=listarDocumentos";
  var idsubproceso = $("#btnNuevoDocto").data("subproceso");

  $.ajax({
    url: url,
    type: "POST",
    data: {idsubproceso},
    beforeSend: function() {
      $("#listadoDocumentos").html('<div class="col-md-12 text-center">'+
                                      '<i class="fa fa-spinner fa-pulse fa-5x fa-fw icon-color-info"></i>'+
                                      '<span class="sr-only">Cargando...</span></div>');

    },
    success: function(datos) {
      //var resp = eval(datos);
      // console.log(datos);
      $("#listadoDocumentos").html(datos);
    }

  });

}


function verDocto(identificador){
  console.log('Ver el documento: ', identificador);
}

function printDocto(identificador){
  console.log('Imprimir el documento: ', identificador);
}

function mostrarform(flag) {
  //limpiar();
  if (flag) {
    $("#listadoregistros").slideUp(500);
    $("#formularioregistros").slideDown(500);
    $("#btnNuevoDocto").fadeOut("slow");
    var idsubproceso = $("#btnNuevoDocto").data("subproceso");
    $("#idsubproceso").val(idsubproceso);

  } else {
    $("#listadoregistros").slideDown(500);
    $("#formularioregistros").slideUp(500);
    $("#btnNuevoDocto").fadeIn("slow");
    // $("#idsubproceso").val("");
    limpiar();
    listarDocumentos();

  }
}

function limpiar(){
  $('#formulario')[0].reset();
  $('#responsable').selectpicker('refresh');
  $('#responsable').val("");
}

function getUbicacion(ruta){

  var url = "views/ajax/documentos.php?op=getRuta";

  $.ajax({
    url: url,
    type: "POST",
    data: {ruta},
    success: function(datos) {
      $("#ruta-documento").html(datos);
      listarDocumentos();
    }

  });

return false;

}

//==================================================
// Guardar y Editar DOCUMENTOS
//==================================================
function guardaryeditar(e){
  e.preventDefault();
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);


  $.ajax({
    url: "views/ajax/documentos.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos) {
      switch (datos) {
        case "1":
          $("#exito-label").html('<strong>¡Bien hecho!</strong> ¡Se ha creado un nuevo documento!.').fadeIn(1000);
          $("#exito-label").delay(2000).fadeOut("slow");
          $('#centroCosto').focus();
          limpiar();
          $("#btnGuardar").removeAttr("disabled");
          break;
        case "2":
          $("#fail-label").html('<strong>¡Atención!</strong> Ocurrio un error al grabar el registro. Intente nuevamente').fadeIn(1000);
          $("#fail-label").delay(2000).fadeOut("slow");
          $('#centroCosto').focus();
          $("#btnGuardar").removeAttr("disabled");
          break;
        case "3":
          $("#fail-label").html('<strong>¡Atención!</strong> Lo sentimos, ya existe un documento con ese código').fadeIn(1000);
          $("#fail-label").delay(2000).fadeOut("slow");
          $('#centroCosto').focus();
          $("#btnGuardar").removeAttr("disabled");
          break;
        case "4":
          $("#fail-label").html('<strong>¡Atención!</strong> Lo sentimos, no existe un documento  con ese código').fadeIn(1000);
          $("#fail-label").delay(2000).fadeOut("slow");
          $('#centroCosto').focus();
          $("#btnGuardar").removeAttr("disabled");
          break;
        case "5":
          $("#exito-label").html('<strong>¡Bien hecho!</strong> ¡El documento ha sido actualizado correctamente!.').fadeIn(1000);
          $("#exito-label").delay(2000).fadeOut("slow");
          $('#centroCosto').focus();
          $("#btnGuardar").removeAttr("disabled");
          break;
        case "6":
          $("#fail-label").html('<strong>¡Atención!</strong> Lo sentimos, no existe un documento con ese código').fadeIn(1000);
          $("#fail-label").delay(2000).fadeOut("slow");
          $('#centroCosto').focus();
          $("#btnGuardar").removeAttr("disabled");
          break;
        default:

      }

    }

  });

}

function limpiar(){
  $('#formulario')[0].reset();
  $("#responsable").selectpicker('refresh');
  $("#responsable").val("");
}

//==================================================
// Funcion Editar DOCUMENTOS Menu contextual
//==================================================

function editarDocumento(iddocumento) {
  console.log('iddocumento', iddocumento);
  $("#archivo").removeAttr('require');
  $("#archivo").attr('disabled','true');
  $.post("views/ajax/documentos.php?op=getDocumendoById", {
    iddocumento: iddocumento
  }, function(data, status) {
    data = JSON.parse(data);
    
    mostrarform(true);
    var fechaRev = data.fechaultimarevision.split("-");
    var fechaRevision = fechaRev[2] + '/' + fechaRev[1] + '/' + fechaRev[0];

    //Como estan definidos los campos en la base de datos
    $("#iddocumento").val(data.iddocumento);
    $("#idsubproceso").val(data.idsubproceso);

    $("#codigodocumento").val(data.codigodocumento);
    $("#nombredocumento").val(data.nombredocumento);
    $("#responsable").val(data.idusuarioresponsable);
    $('#fecharevision').datepicker('update', fechaRevision );
    //$("#fecharevision").val(data.fechaultimarevision);
    $("#version").val(data.version);
    $("#tipodocumento").val(data.idtipodocumento);
    $("#nombredocumento").val(data.nombredocumento);
    $("#nombredocumento").val(data.nombredocumento);
    $("#nombredocumento").val(data.nombredocumento);
    $("#nombredocumento").val(data.nombredocumento);
    $("#nombredocumento").val(data.nombredocumento);
    $("#nombredocumento").val(data.nombredocumento);
    $("#nombredocumento").val(data.nombredocumento);
    $("#nombredocumento").val(data.nombredocumento);


  });

}














init();
