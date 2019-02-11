<?php
  class Enlaces{

    public function enlacesController(){

      if(isset($_GET["action"])){
        $enlaces =$_GET["action"];
      }
      else{
        $enlaces = "index";
      }

      $respuesta = EnlacesModels::enlacesModel($enlaces);

      if ($respuesta[0] == 1){

        include $respuesta[1];

      }else{

        session_start();
        if( isset($_SESSION['validar']) ){

          $enlacesDinamicos = EnlacesModels::getOpcionesDinamicas($_SESSION['idsuscriptor'], "1", "vwopciones_menu");
          $resp = EnlacesModels::getEnlacesDinamicos($enlacesDinamicos, $enlaces, $_SESSION['carpeta']);
          include $resp;

        }else{

          $module ="views/modules/ingreso.php";
          include $module;

        }

      }

    }
    
  }
