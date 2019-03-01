var fila;

$(document).ready(function(){

    $('.fila-proceso').on('contextmenu',function () {
        filaDocumento = $(this).data("id");
    });

});

$(document).on('contextmenu', function(e) {
  e.preventDefault();
  superCm.createMenu([
    {
      icon: 'fa fa-plus',
      label: 'Nuevo',
      opc:'Nuevo',
      action: process,
      identificador: filaDocumento
    },
    {
      icon: 'fa fa-user',
      label: 'User 2',
      action: process,
      userId: 'U8484PL',
      role: 'Member'
    }
  ], e);
});

function process(option) {
  // alert('Processing user with ID ' + option.idRow + ' and role ' + option.role);

  switch (option.opc) {
    case 'Nuevo':
      accionUno(option.identificador);
      break;
    default:

  }

  superCm.destroyMenu();
}

function accionUno(identificador){
  console.log('El documento es: ', identificador);
}

function nuevoDocumento(){
  $('#nuevo-documento').modal('show');
}
