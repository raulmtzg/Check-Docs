var tabla;

//Función que se ejecuta al inicio
function init() {
  listar();
  $("#formulario").on("submit", function(e) {
    guardaryeditar(e);
  });

  $("#formularioAdmin").on("submit", function(even) {
    guardaryeditarAdmin(even);
  });

}

//Función limpiar
function limpiar() {

  $('#formulario')[0].reset();
}

//Función mostrar formulario
function mostrarform(flag) {
  limpiar();
  if (flag) {
    $("#listadoregistros").slideUp(500);
    $("#formularioregistros").slideDown(500);
    $("#btnGuardar").prop("disabled", false);
    //$("#btnagregar").hide();
    $("#btnagregar").fadeOut("slow");



  } else {
    $("#listadoregistros").slideDown(500);
    $("#formularioregistros").slideUp(500);
    //$("#btnagregar").show();
    $("#btnagregar").fadeIn("slow");

  }
}

//Función cancelarform
function cancelarform() {
  limpiar();
  mostrarform(false);
  tabla.ajax.reload();
}


//Función Listar
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
      url: 'views/ajax/admin_panel.php?op=listar',
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
//Función para guardar o editar

function guardaryeditar(e) {
  e.preventDefault();
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "views/ajax/admin_panel.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos) {
      //console.log('Respuesta Guardar/Editar Centro: '+ datos);
      switch (datos) {
        case "1":
          $("#exito-label").html('<strong>¡Bien hecho!</strong> ¡Se recibió la información correctamente!.').fadeIn(1000);
          $("#exito-label").delay(2000).fadeOut("slow");
          $('#rfc').focus();
          limpiar();
          $("#btnGuardar").removeAttr("disabled");
          break;
        case "2":
          $("#fail-label").html('<strong>¡Atención!</strong> Ocurrio un error al grabar el registro. Intente nuevamente').fadeIn(1000);
          $("#fail-label").delay(2000).fadeOut("slow");
          $('#rfc').focus();
          $("#btnGuardar").removeAttr("disabled");
          break;
        case "3":
          $("#fail-label").html('<strong>¡Atención!</strong> No existe la empresa').fadeIn(1000);
          $("#fail-label").delay(2000).fadeOut("slow");
          $('#rfc').focus();
          $("#btnGuardar").removeAttr("disabled");
          break;

        default:

      }



    }

  });

}

function mostrar(idsuscriptor) {

  $.post("views/ajax/admin_panel.php?op=mostrar", {
    idsuscriptor: idsuscriptor
  }, function(data, status) {
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

//Función para desactivar registros
function desactivar(info) {
  var result = info.split("-");
  //console.log(result[0]);
  swal({
            title: "¿Estás seguro?",
            text: "Se desactivará la empresa: "+ result[1] + " y no lo podrá utilizar.",
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

function confirmarDesactivar(idsuscriptor){

    var url = "views/ajax/admin_panel.php?op=desactivar";
      $.ajax({
        type: 'POST',
        url: url,
        data:('idsuscriptor='+ idsuscriptor),
        success: function (respuesta) {
            if (respuesta == 1) {
                swal("¡Bien hecho!", "La empresa ha sido desactivado correctamente.", "success");
                tabla.ajax.reload();
            }else{
              swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
            }
        }
      });
      return false;
}

//Función para activar registros
function activar(info) {
  var result = info.split("-");
  //console.log(result[0]);
  swal({
            title: "¿Estás seguro?",
            text: "Se activará la empresa: "+ result[1] + ", para utilizarlo en los registros.",
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

function confirmarActivar(idsuscriptor){

    var url = "views/ajax/admin_panel.php?op=activar";
      $.ajax({
        type: 'POST',
        url: url,
        data:('idsuscriptor='+ idsuscriptor),
        success: function (respuesta) {
            if (respuesta == 1) {
                swal("¡Bien hecho!", "La empresa ha sido activado correctamente.", "success");
                tabla.ajax.reload();
            }else{
              swal("Atención", "Ocurrio un error al actualizar el registro, intente nuevamente", "error");
            }
        }
      });
      return false;
}

//========================== Alta de usuario administrador suscriptor====================
function mostrarUsuario(idsuscriptor){
  $("#idsuscriptor_usuario").val(idsuscriptor);

  $.post("views/ajax/admin_panel.php?op=mostrarAdmin", {
    idsuscriptor: idsuscriptor
  }, function(data, status) {
    data = JSON.parse(data);

    mostrarformUsuario(true);
    //Como estan definidos los campos en la base de datos
    $("#idusuario_suscriptor").val(data.idusuario_suscriptor);
    $("#nombre_completo").val(data.nombre_completo);
    $("#email").val(data.email);

  });


}
function mostrarformUsuario(flag) {
  //limpiarUsuario();
  if (flag) {
    $("#listadoregistros").slideUp(500);
    $("#formulariousuariosuscriptor").slideDown(500);
    //$("#btnGuardar").prop("disabled", false);
    //$("#btnagregar").hide();
    $("#btnagregar").fadeOut("slow");



  } else {
    $('#formularioAdmin')[0].reset();
    $("#listadoregistros").slideDown(500);
    $("#formulariousuariosuscriptor").slideUp(500);
    //$("#btnagregar").show();
    $("#btnagregar").fadeIn("slow");

  }
}


function guardaryeditarAdmin(even){
  even.preventDefault();
  $("#btnGuardarUsuario").prop("disabled", true);
  var formData = new FormData($("#formularioAdmin")[0]);

  $.ajax({
    url: "views/ajax/admin_panel.php?op=guardaryeditarAdmin",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function(datos) {

      if (datos == "1" ){

        $("#exito-labelAdmin").html('<strong>¡Bien hecho!</strong> ¡Se recibió la información correctamente!.').fadeIn(1000);
        $("#exito-labelAdmin").delay(2000).fadeOut("slow");
        $('#nombre_completo').focus();
        $("#btnGuardarUsuario").removeAttr("disabled");

      }else{

        $("#fail-labelAdmin").html('<strong>¡Atención!</strong> Ocurrio un error al grabar el registro. Intente nuevamente').fadeIn(1000);
        $("#fail-labelAdmin").delay(2000).fadeOut("slow");
        $('#nombre_completo').focus();
        $("#btnGuardarUsuario").removeAttr("disabled");

      }

    }

  });

}

function crearArchivo(){

  $.ajax({
    url: "views/ajax/admin_panel.php?op=crearArchivo",
    type: "POST",
    //data: formData,
    contentType: false,
    processData: false,
    success: function(datos) {
      console.log(datos);
      if (datos == "1" ){

        console.log('ok');

      }else{

        console.log('fail');

      }

    }

  });

}



init();
