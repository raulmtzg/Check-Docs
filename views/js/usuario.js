
function init(){

  //listar();
  console.log('entro');
  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

}

function guardaryeditar(e){
  e.preventDefault();
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "views/ajax/usuario.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos) {

      if (datos == "1" ){

        $("#exito-label").html('<strong>¡Bien hecho!</strong> ¡Se creo correctamente el registro!.').fadeIn(1000);
        $("#exito-label").delay(2000).fadeOut("slow");
        $('#nombre_completo').focus();
        $("#btnGuardar").removeAttr("disabled");

      }else if (datos == "2") {

        $("#fail-label").html('<strong>¡Atención!</strong> Ocurrio un error al grabar el registro. Intente nuevamente').fadeIn(1000);
        $("#fail-label").delay(2000).fadeOut("slow");
        $('#nombre_completo').focus();
        $("#btnGuardar").removeAttr("disabled");

      }else if (datos == "3") {
        $("#fail-label").html('<strong>¡Atención!</strong> Ya existe un usuario con el correo ingresado. Intente nuevamente.').fadeIn(1000);
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

init();
