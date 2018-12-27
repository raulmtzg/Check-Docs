<?php
  class Enlaces{

    public function enlacesController(){
      //session_start();

      if(isset($_GET["action"])){

        $enlaces =$_GET["action"];

      }
      else{
        $enlaces = "index";
      }

      //$enlacesDinamicos = EnlacesModels::getEnlacesDinamicos()

      $respuesta= EnlacesModels::enlacesModel($enlaces);

      include $respuesta;
    }
  }
