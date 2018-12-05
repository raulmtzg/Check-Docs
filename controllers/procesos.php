<?php

  class Procesos {

    public function insertarController($proceso, $listaSubprocesos){
      
      
      
      session_start();

      if( count($listaSubprocesos) > 0 ){
        $datosController['consubprocesos'] = "1";
      }else{
        $datosController['consubprocesos'] = "0";
      }

      $parametros = ParametrosModels::parametrosModel();
      $fechaAlta= date($parametros['formatoFecha']);
      
      $datosController['idsuscriptor'] = $_SESSION['idsuscriptor'];
      $datosController['descripcion'] = $proceso;
      $datosController['usuarioalta'] = $_SESSION['usuario'];
      $datosController['fechaalta'] = $fechaAlta;
      $datosController['serverName'] = $parametros['serverName'];
      $datosController['dataBaseName'] = $parametros['dataBaseName'];
      $datosController['userDataBase'] = $parametros['userDataBase'];
      $datosController['passwordDataBase'] = $parametros['passwordDataBase'];

      $respuesta = ProcesosModels::insertarModel($datosController, "procesos");

      if($respuesta > 0){
        #Insertar partidas
        
        #Insertar la posicion cero que es el proceso en el arreglo para creacion del menu
        array_unshift($listaSubprocesos,  (object) array("index" => 0, "subproceso"=>$proceso));
        
        $subprocesos = ProcesosModels::insertarSubprocesosModel($listaSubprocesos, $respuesta, $fechaAlta, $_SESSION['usuario'], "subprocesos");

        $mensaje = $subprocesos;

      }else{

        //No se pudo grabar el encabezado de la compra
        $mensaje = "ERR01";

      }

      $envio= array(
        0=>$mensaje,
        1=>$respuesta
      );

      echo json_encode($envio);

    }

  }
