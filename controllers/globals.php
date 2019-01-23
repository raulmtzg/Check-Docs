<?php

  class Globals {

    public function listarOpcionesMenuController(){

      session_start();

      $procesos = GlobalsModels::getProcesosModels($_SESSION['idsuscriptor'], "1", "1", "1", "vwopciones_menu");
      var_dump($procesos);

    }

  } //Fin Class
