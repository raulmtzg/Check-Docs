var tabla;

function init(){

  listar();

  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

}

//=======================================
// Listar usuarios
//=======================================
function listar() {
  tabla = $('#tbllistado').dataTable({
    "aProcessing": true, //Activamos el procesamiento del datatables
    "aServerSide": true, //Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip', //Definimos los elementos del control de tabla
    buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],
    "ajax": {
      url: 'views/ajax/usuario.php?op=listar',
      type: "get",
      dataType: "json",
      error: function(e) {
        console.log(e.responseText);
      }
    },

    "bDestroy": true,
    "iDisplayLength": 5, //Paginación
    "order": [
      [0, "asc"]
    ] //Ordenar (columna,orden)
  }).DataTable();
}

//=======================================
// mostrar / ocultar formulario
//=======================================
function mostrarformu(flag) {
  //limpiar();
  if (flag) {
    $("#listadoregistros").slideUp(500);
    $("#formularioregistros").slideDown(500);
    $("#btnNuevo").fadeOut("slow");

  } else {
    $("#listadoregistros").slideDown(500);
    $("#formularioregistros").slideUp(500);
    $("#btnNuevo").fadeIn("slow");

  }
}

//=======================================
// Insertar / editar usuario
//=======================================
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

        $("#exito-label").html('<strong>¡Bien hecho!</strong> ¡Se grabo correctamente el registro!.').fadeIn(1000);
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

      }else if (datos == "4") {
        $("#fail-label").html('<strong>¡Atención!</strong> No existe un usuario con ese identificador. Intente más tarde.').fadeIn(1000);
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

//=======================================
// Cancelar nuevo / edicion de usuario
//=======================================
function cancelarform(){
  $('#formulario')[0].reset();
  //limpiar();
  mostrarformu(false);
  tabla.ajax.reload();
}

//=======================================
// Mostrar fomrulario para editar usuario
//=======================================
function mostrarDatosUsuario(idusuario_suscriptor){
  $.post("views/ajax/usuario.php?op=mostrar", {
    idusuario_suscriptor: idusuario_suscriptor
  }, function(data, status) {
    data = JSON.parse(data);
    console.log(data);
    //Como estan definidos los campos en la base de datos
    $("#idusuario_suscriptor").val(data.idusuario_suscriptor);
    $("#nombre_completo").val(data.nombre_completo);
    $("#nombre_usuario").val(data.nombre_usuario);
    $("#perfil").val(data.perfil);
    $("#email").val(data.email);

    mostrarformu(true);

  });

}

//=======================================
// Desactivar usuario
//=======================================
function desactivar(info){
  console.log(info);
  var result = info.split("|");
  swal({
            title: "¿Estás seguro?",
            text: "Se desactivará el usuario: "+ result[1] + " con todos sus permisos y no lo podrá ser utilizado en Check-Docs.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, Continuar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            showLoaderOnConfirm:true,
            closeOnCancel: true
      },
      function(isConfirm){
          if (isConfirm) {
            confirmarDesactivar(result[0]);
          }
      });
}

function confirmarDesactivar(idusuario_suscriptor){

    var url = "views/ajax/usuario.php?op=desactivar";
      $.ajax({
        type: 'POST',
        url: url,
        data:('idusuario_suscriptor='+ idusuario_suscriptor),
        success: function (respuesta) {
            if (respuesta == 1) {
                swal("¡Bien hecho!", "El usuario ha sido desactivado correctamente.", "success");
                tabla.ajax.reload();
            }else{
              swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
            }
        }
      });
      return false;
}

//=======================================
// Activar usuario
//=======================================


function activar(info) {
  var result = info.split("|");
  swal({
            title: "¿Estás seguro?",
            text: "Se activará el usuario: "+ result[1] + ", con sus permisos asignados en Check-Docs.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, Continuar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            showLoaderOnConfirm:true,
            closeOnCancel: true
      },
      function(isConfirm){
          if (isConfirm) {
            confirmarActivar(result[0]);
          }
      });
}

function confirmarActivar(idusuario_suscriptor){

    var url = "views/ajax/usuario.php?op=activar";
      $.ajax({
        type: 'POST',
        url: url,
        data:('idusuario_suscriptor='+ idusuario_suscriptor),
        success: function (respuesta) {
            if (respuesta == 1) {
                swal("¡Bien hecho!", "El usuario ha sido activado correctamente.", "success");
                tabla.ajax.reload();
            }else{
              swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
            }
        }
      });
      return false;
}


init();
