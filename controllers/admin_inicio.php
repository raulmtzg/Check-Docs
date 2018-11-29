<?php

  class AdminInicio {

    public function editarController($encabezado, $descripcion){
      session_start();

      $respuesta = AdminInicioModels::insertarModel($_SESSION['idsuscriptor'], $encabezado, $descripcion, "suscriptores");

      echo $respuesta;
    }

    public function cambiarLogoController($file){
      session_start();
      $respuesta = AdminInicioModels::subirLogoModel( $_SESSION['carpeta'], $file);

      if( $respuesta['mensaje']== 1 ){

        $ruta = "views/img/".$_SESSION['carpeta']."/".$respuesta['nombredocumento'];
        $actualizar = AdminInicioModels::actualizarLogoModel($_SESSION['idsuscriptor'], $ruta, "suscriptores");
        if( $actualizar == 1){
          $_SESSION['logo'] = $respuesta['ubicacion'];
        }
      }else{
        $actualizar =$respuesta['mensaje'];
      }
      echo $actualizar;

    }

    public function mostrarController(){

      session_start();
      $respuesta = AdminInicioModels::mostrarModel($_SESSION['idsuscriptor'], "suscriptores");
      //$ruta = "views/img/".$_SESSION['carpeta']."/".$respuesta['logo'];
      $datos = array('encabezado' => $respuesta['encabezado'],
                     'descripcion' => $respuesta['descripcion'],
                     'ruta' => $respuesta['logo']);
      //var_dump($datos);
      echo json_encode($datos);

    }



  }
