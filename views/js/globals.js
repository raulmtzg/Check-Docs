function init() {
  listarOpcionesMenu();
}

function listarOpcionesMenu(){
  
  $.ajax({
    type: 'POST',
    url: "views/ajax/globals.php?op=listarOpcionesMenu",
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta);
      //$("#totalNotificaciones").html(respuesta);

    }

  });

  return false;
}

init();
