

//Función que se ejecuta al inicio
function init() {

  $("#formulario").on("submit", function(e) {
    editarInicio(e);
  });

  $("#formularioLogo").on("submit", function(ev) {
    cambiarLogo(ev);
  });

  mostrar();

}

//Función cancelarform
function cancelarform() {

  //llama al load

}

//Función para guardar o editar
function editarInicio(e) {
  e.preventDefault();
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);
  var url = "views/ajax/admin_inicio.php?op=editarInicio";

  $.ajax({
    url: url,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos) {
      $("#btnGuardar").removeAttr('disabled');
      if(datos == 1){

        $("#exito-label").html('<strong>¡Bien hecho!</strong> ¡Se recibió la información correctamente!.').fadeIn(1000);
        $("#exito-label").delay(2000).fadeOut("slow");
        $('#encabezado').focus();


      }else{
        $("#fail-label").html('<strong>¡Atención!</strong> Ocurrio un error al grabar el registro. Intente nuevamente').fadeIn(1000);
        $("#fail-label").delay(2000).fadeOut("slow");
        $('#encabezado').focus();
      }
    }

  });

return false;

}

function mostrar() {

  $.post("views/ajax/admin_inicio.php?op=mostrar",function(data, status) {
    data = JSON.parse(data);


    //Como estan definidos los campos en la base de datos
    $("#encabezado").val(data.encabezado);
    $("#descripcion").val(data.descripcion);
    d = new Date();
    $("#logoempresa").attr('src', data.ruta+"?"+d.getTime() );


  })
}

//Funciones para actualizar y mostrar el logotipo
function cambiarLogo(ev) {
  ev.preventDefault();
  //var $btn = $("#btnCambiarLogo").button('Procesando...')
  $("#btnCambiarLogo").prop("disabled", true);
  var formData = new FormData($("#formularioLogo")[0]);
  var url = "views/ajax/admin_inicio.php?op=cambiarLogo";

  $.ajax({
    url: url,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function() {
      $("#btnCambiarLogo").html('<i class="fa fa-refresh fa-spin " aria-hidden="true"></i> Actualizando logotipo...')
    },
    success: function(datos) {
      //data = JSON.parse(datos);
      //console.log(data);
      if(datos == 1){

        $("#btnCambiarLogo").removeAttr('disabled');
        $("#btnCambiarLogo").html('<i class="fa fa-save"></i> Guardar');
        $('#formularioLogo')[0].reset();
        $("#exito-logo").html('<strong>¡Bien hecho!</strong> ¡Se actualizó el logotipo correctamente!.').fadeIn(1000);
        $("#exito-logo").delay(2000).fadeOut("slow");
        mostrar();
        //Aqui hace el refresh del logotipo
      }else{
        $("#btnCambiarLogo").removeAttr('disabled');
        $("#btnCambiarLogo").html('<i class="fa fa-save"></i> Guardar')
        $("#fail-logo").html('<strong>¡Atención!</strong> Ocurrio un error al grabar el registro. Intente nuevamente').fadeIn(1000);
        $("#fail-logo").delay(2000).fadeOut("slow");
        $('#encabezado').focus();
      }
    }

  });

  return false;
}

init();
