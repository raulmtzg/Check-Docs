
//Función que se ejecuta al inicio
function init() {

  $("#formulario").on("submit", function(e) {
    ingresar(e);
  });


}

function ingresar(e) {
  e.preventDefault();
  e.stopImmediatePropagation();

  //Aquí validar si es ingreso via web
  // if( isMobile.any() ){
  //   console.log('movil');
  //   return window.location = "movil";
  // }

  var formData = new FormData($("#formulario")[0]);
  var url = "views/ajax/actualizar_password.php?op=actualizar_password";

  $.ajax({
    url: url,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function() {
      $("#btnIniciar").attr('disabled', true);
    },
    success: function(datos) {
      $("#btnIniciar").removeAttr('disabled');
      console.log(datos);
      if(datos == 1){
        swal("Bien hecho!", "Se actualizó correctamente el password.", "success");
        $("#btnIniciar").addClass('ocultar-contenido');
        $("#btnRegresar").removeClass('ocultar-contenido');
        $('#formulario')[0].reset();
        //window.location = "ingreso";
      }else{
        swal("Atención", "El usuario o contraseña son incorrectos, intente nuevamente.", "error");
      }
    }

  });

return false;

}

init();
