<?php

  class AdminInicio {

    public function insertarController($encabezado, $descripcion){
      session_start();

      $respuesta = AdminInicioModels::insertarModel($_SESSION['idsuscriptor'], $encabezado, $descripcion, "detalle_suscriptores");

      echo $respuesta;
    }

    public function cambiarLogoController($file){
      session_start();
      $respuesta = AdminInicioModels::subirLogoModel( $_SESSION['carpeta'], $file);

      if( $respuesta['mensaje']== 1 ){

        $actualizar = AdminInicioModels::actualizarLogoModel($_SESSION['idsuscriptor'], $respuesta, "detalle_suscriptores");
        if( $actualizar == 1){
          $_SESSION['logo'] = $respuesta['ubicacion'];
        }
      }
      echo $actualizar;

    }



  }
