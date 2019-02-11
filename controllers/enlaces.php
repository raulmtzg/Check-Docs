<?php
  class Enlaces{

    public function enlacesController(){

      $ban = false;

      if(isset($_GET["action"])){

        $enlaces =$_GET["action"];

      }
      else{
        $enlaces = "index";
      }

      if( isset($_SESSION['idsuscriptor']) ){

        $enlacesDinamicos = EnlacesModels::getOpcionesDinamicas($_SESSION['idsuscriptor'], "1", "vwopciones_menu");

        $i = 0;
        while ($i < count($enlacesDinamicos)) {

          if($enlaces == $enlacesDinamicos[$i]['identificadorsubproceso']){
            $ban = true;
          }
          $i++;

        }
        echo "<pre>";
          print_r($enlacesDinamicos);
        echo "</pre>";

      }

      if( $ban == true ){
        $respuesta = EnlacesModels::getEnlacesDinamicos($enlaces, $_SESSION['carpeta']);

      }else{
        $respuesta = EnlacesModels::enlacesModel($enlaces);
        echo $respuesta;
      }

      include $respuesta;

    }
  }
