<?php

  class TipoDocumento {

    public function listarController(){
      session_start();
      $rows= TipoDocumentoModels::listarModel($_SESSION['idsuscriptor'], "tipodocumento");

      $data= Array();
      foreach ($rows as $row) {
        $info="";
        $perfil="";
        $info= "'".$row['idtipodocumento']."|".$row['descripcion']."'";

        $data[]=array(
          "0"=>$row["descripcion"],
          "1"=>($row['condicion']==1)?'<p class="text-center"><span class="label label-success label-rounded">ACTIVO</span></p>':
          '<p class="text-center"><span class="label label-danger label-rounded">BAJA</span></p>',
          "2"=>($row['condicion']==1)?'<p class="text-center"><button class="btn btn-outline-info btn-sm"  data-toggle="tooltip" data-placement="top" title="Editar" onclick="mostrarDatos('.$row['idtipodocumento'].')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-outline-danger btn-sm"  data-toggle="tooltip" data-placement="top" title="Desactivar" onclick="desactivar('.$info.')"><i class="fa fa-ban"></i></button>':
            '<p class="text-center"><button class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Editar" onclick="mostrarDatos('.$row['idtipodocumento'].')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Activar" onclick="activar('.$info.')"><i class="fa fa-check"></i></button></p>'
          );
      }
      $results = array(
        "sEcho"=>1, //Información para el datatables
        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
        "aaData"=>$data);
       echo json_encode($results);
    }

    public function insertarController($descripcion){

      session_start();

      $parametros = ParametrosModels::parametrosModel();
      $fechaalta= date($parametros['formatoFecha']);
      $datosController = array("descripcion"  =>  $descripcion,
	                             "fechaalta"       =>  $fechaalta,
	                             "usuarioalta"     =>  $_SESSION['usuario'],
                               "idsuscriptor"     =>  $_SESSION['idsuscriptor']
								               );

      $respuesta = TipoDocumentoModels::insertarModel($datosController, "tipodocumento");

      echo $respuesta;

    }

    public function mostrarController($idtipodocumento){

      $respuesta = TipoDocumentoModels::mostrarModel($idtipodocumento, "tipodocumento");
      echo json_encode($respuesta);

    }

    public function editarController($idtipodocumento, $descripcion){

      session_start();
      $parametros = ParametrosModels::parametrosModel();
      $fechamodificacion= date($parametros['formatoFecha']);
      $datosController = array("descripcion"          =>  $descripcion,
                                "idtipodocumento"    =>  $idtipodocumento,
  	                             "fechamodificacion"     =>  $fechamodificacion,
  	                             "usuariomodificacion"   =>  $_SESSION['usuario']
  								             );

      $respuesta = TipoDocumentoModels::editarModel($datosController, "tipodocumento");
      echo $respuesta;

    }

    public function desactivarController($idtipodocumento){
        session_start();
        $parametros = ParametrosModels::parametrosModel();
        $fechamodificacion= date($parametros['formatoFecha']);
        $datosController = array("idtipodocumento"   =>  $idtipodocumento,
                                 "condicion"              => "0",
                                 "fechamodificacion"     =>  $fechamodificacion,
                                 "usuariomodificacion"   =>  $_SESSION['usuario']
                                );

        $respuesta = TipoDocumentoModels::desactivarActivarModel($datosController, "tipodocumento");

        echo $respuesta;

      }

      public function activarController($idtipodocumento){
        session_start();
        $parametros = ParametrosModels::parametrosModel();
        $fechamodificacion= date($parametros['formatoFecha']);
        $datosController = array("idtipodocumento"   =>  $idtipodocumento,
                                 "condicion"              => "1",
                                 "fechamodificacion"     =>  $fechamodificacion,
                                 "usuariomodificacion"   =>  $_SESSION['usuario']
                                );

        $respuesta = TipoDocumentoModels::desactivarActivarModel($datosController, "tipodocumento");

        echo $respuesta;

      }

      #==============================================================================
      # Esta funcion es consumida en:
      # -Cargar un nuevo documento
      #==============================================================================
      public function listarTiposActivosController(){
          session_start();
          $rows= TipoDocumentoModels::listarTiposActivosModel($_SESSION['idsuscriptor'], "1", "tipodocumento");
          $html="";
          foreach($rows as $row){
            $html.='<option value="'.$row['idtipodocumento'].'">'.$row['descripcion'].'</option>';
          }
          echo $html;


      }

  }
