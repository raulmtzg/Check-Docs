
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
  console.log('aqui');
  var formData = new FormData($("#formulario")[0]);
  var url = "views/ajax/ingreso.php?op=iniciarSesion";

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
      if(datos == 1){

        window.location = "inicio";


      }else if (datos == 2) {
        swal("Atención", "El usuario o contraseña es incorrecta, intente nuevamente.", "error");
        // var widgetId= grecaptcha.render($("#robot"));
        // grecaptcha.reset(widgetId);
      }else{
        $("#recaptchaGoogle").removeClass("ocultar-contenido");
        swal("Atención", "Ha superado el numero de intentos, marque la casilla para verificar que no es un robot.", "error");
      }
    }

  });

return false;

}

init();
