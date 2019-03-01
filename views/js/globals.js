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
      icon: 'fa fa-print',
      label: 'Imprimir',
      opc: 'print',
      action: process,
      identificador: filaDocumento
    }
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
