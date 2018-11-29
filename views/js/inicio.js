
function init() {

    
    cargarInformacion();
  
  }

function cargarInformacion(){

    $.post("views/ajax/admin_inicio.php?op=mostrar",function(data, status) {
        data = JSON.parse(data);
        console.log(data);
        
        if(data.encabezado ==""){
            $("#encabezado").html("Bienvenido al Sistema Check-Docs");    
        }else{
            $("#encabezado").html(data.encabezado);
        }

        if( data.descripcion == ""){

        }else{
            $("#descripcion").html(data.descripcion);
        }
        
        if( data.ruta == ""){
            $("#logoempresa").remove();
        }else{
            d = new Date();
            $("#logoempresa").attr('src', data.ruta+"?"+d.getTime());
        }
    
    
      });
}

init();