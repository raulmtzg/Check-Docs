<?php

  class Procesos {

    public function insertarController($proceso, $listaSubprocesos){
      session_start();

      if( count($listaSubprocesos) > 0 ){
        $datosController['consubprocesos'] = "1";
      }else{
        $datosController['consubprocesos'] = "0";
      }
      $fechaAlta= date($parametros['formatoFecha']);
      $datosController['idsuscriptor'] = $_SESSION['idsuscriptor'];
      $datosController['descripcion'] = $proceso;
      $datosController['usuarioalta'] = $_SESSION['usuarioalta'];
      $datosController['fechaalta'] = $fechaAlta;
      $datosController['serverName'] = $parametros['serverName'];
      $datosController['dataBaseName'] = $parametros['dataBaseName'];
      $datosController['userDataBase'] = $parametros['userDataBase'];
      $datosController['passwordDataBase'] = $parametros['passwordDataBase'];

      $respuesta = ProcesosModels::insertarModel($datosController, "procesos");


    }

  }
