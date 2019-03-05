var filaDocumento;

$('.derecho').on('contextmenu', function(e) {
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
      opc:'verDocto',
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

function process(option) {
  // alert('Processing user with ID ' + option.idRow + ' and role ' + option.role);

  switch (option.opc) {

    case 'verDocto':
      verDocto(option.identificador);
      break;
    case 'print':
      printDocto(option.identificador);
      break;
    default:

  }
  superCm.updateMenu(allowHorzReposition = true, allowVertReposition = true);
  superCm.destroyMenu();
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

  } else {
    $("#listadoregistros").slideDown(500);
    $("#formularioregistros").slideUp(500);
    $("#btnNuevoDocto").fadeIn("slow");

  }
}
function nuevoDocumento(){
  //$('#nuevo-documento').modal('show');
  $("#listadoregistros").slideUp(500);
  $("#formularioregistros").slideDown(500);
  $("#btnNuevoDocto").fadeOut("slow");
}
