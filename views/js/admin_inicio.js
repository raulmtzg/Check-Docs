

//Función que se ejecuta al inicio
function init() {

  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

  $("#formularioLogo").on("submit", function(ev) {
    cambiarLogo(ev);
  });


}

//Función cancelarform
function cancelarform() {

  //llama al load

}

//Función para guardar o editar

function guardaryeditar(e) {
  e.preventDefault();
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);
  var url = "views/ajax/admin_inicio.php?op=guardaryeditar";

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

  $.post("views/ajax/admin_panel.php?op=mostrar",function(data, status) {
    data = JSON.parse(data);
    mostrarform(true);

    //Como estan definidos los campos en la base de datos
    $("#rfc").val(data.rfc);
    $("#nombre_empresa").val(data.nombre_empresa);
    $("#telefono").val(data.telefono);
    $("#cantidad_admin").val(data.cantidad_admin);
    $("#limite_usuarios").val(data.limite_usuarios);
    $("#capacidad_almacenamiento").val(data.capacidad_almacenamiento);
    $("#idsuscriptor").val(data.idsuscriptor);

  })
}

function cambiarLogo(ev) {
  ev.preventDefault();
  var $btn = $("#btnCambiarLogo").button('Procesando...')
  //$("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formularioLogo")[0]);
  var url = "views/ajax/admin_inicio.php?op=cambiarLogo";

  $.ajax({
    url: url,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos) {
      //$("#btnGuardar").removeAttr('disabled');
      $btn.button('reset');
      if(datos == 1){

        console.log('ok');

      }else{
        $("#fail-logo").html('<strong>¡Atención!</strong> Ocurrio un error al grabar el registro. Intente nuevamente').fadeIn(1000);
        $("#fail-logo").delay(2000).fadeOut("slow");
        $('#encabezado').focus();
      }
    }

  });

  return false;
}


init();
