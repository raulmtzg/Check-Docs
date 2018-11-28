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

      #Actualizar
       var_dump( $respuesta->mensaje );
    }



  }
