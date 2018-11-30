
function init() {

    
    cargarInformacion();
  
  }

function cargarInformacion(){

    $.post("views/ajax/admin_inicio.php?op=mostrar",function(data, status) {
        data = JSON.parse(data);
        console.log(data);
        
        if(data.encabezado == null){

            $("#encabezado").html("Bienvenido al Sistema Check-Docs");

        }else{
            $("#encabezado").html(data.encabezado);
        }

        if( data.descripcion == null){

        }else{
            $("#descripcion").html(data.descripcion);
        }
        
        if( data.ruta == null){
            $("#logoempresa").remove();
        }else{
            d = new Date();
            $("#logoempresa").attr('src', data.ruta+"?"+d.getTime());
        }
    
    
      });
}

init();