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
      //$respuesta = 2;

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

      #Obtener subprocesos insertados
      $condicion = 1;
      $subprocesosInsertados = self::mostrarSubprocesosController( $respuesta, $condicion );

      $envio= array(
        0=>$mensaje,
        1=>$respuesta,
        2=> $subprocesosInsertados
      );

      echo json_encode($envio);

    }

    public function editarController($idproceso, $proceso, $listaSubprocesos){

       session_start();
       $subprocesos=0;
       $parametros = ParametrosModels::parametrosModel();
       $fechaModificacion= date($parametros['formatoFecha']);
       $datosController = array("proceso"             =>  $proceso,
                                "idproceso"           =>  $idproceso,
  	                            "fechamodificacion"   =>  $fechaModificacion,
  	                            "usuariomodificacion" =>  $_SESSION['usuario']
  								            );

      $respuesta = ProcesosModels::editarModel($datosController, "procesos");

      if( $respuesta == "Ok" ){

        if( count($listaSubprocesos) > 0 ){

          $subprocesos = ProcesosModels::insertarSubprocesosModel($listaSubprocesos, $idproceso, $fechaModificacion, $_SESSION['usuario'], "subprocesos");
          $mensaje = $subprocesos;

        }else{

          $mensaje = $respuesta;

        }
      }else{

        //No se pudo grabar el encabezado de la compra
        $mensaje = "ERR01";

      }

      #Obtener subprocesos insertados
      $condicion = 1;
      $subprocesosInsertados = self::mostrarSubprocesosController( $idproceso, $condicion );

      $envio= array(
        0=>$mensaje,
        1=>$idproceso,
        2=> $subprocesosInsertados
      );

      echo json_encode($envio);


    }

    public function mostrarSubprocesosController($idproceso, $condicion){

      $rows = ProcesosModels::mostrarSubprocesoModel($idproceso, "subprocesos");

        $tabla="";
        $tabla.='<table id="table-subprocesos" class="table table-condensed table-striped">
          <thead>
            <tr>
              <th class="text-center"># POSICIÓN</th>
              <th class="text-center">SUBPROCESO</th>
              <th class="text-center">ESTADO</th>
              <th class="text-center col-sm-3">OPCIONES</th>
            </tr>
          </thead>
          <tbody>';

            if(count($rows)==1){

              $tabla.='<tr id="filaCero" class="default sin-partidas">
                          <th class="text-center" colspan="3"><span class="sinDatos">No existen subprocesos<span> </th>
                        </tr>
                      </tbody>
                    </table>';
            }else {
              $acumProyectado=(double)0.00;
              foreach($rows as $row){
                if( $row['consecutivo'] > 0 ){

                  $data="";
                  $data= "'".$row['idsubproceso']."|".$row['descripcion']."|".$row['idproceso']."'";

                  $tabla.='<tr id="'.$row['consecutivo'].'">
                    <td id="'.$row['consecutivo'].'" class="text-center" >'.$row['consecutivo'].'</td>
                    <td >'.$row['descripcion'].'</td>';

                  if( $row['condicion']==1 ){
                    $tabla.='<td class="text-center"><span class="label bg-success">ACTIVO</span></td>
                              <td class="text-center">
                                <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Editar" onclick="mostrarEdicionSubproceso('.$data.')"><i class="fa fa-pencil icon-color-info"></i></button>
                                <button class="btn  btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Desactivar" onclick="desactivarSub('.$data.')"><i class="fa fa-ban"></i></button>
                                <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarSubproceso('.$data.')"><i class="fa fa-trash icon-color-danger"></i></button>
                              </td>
                              </tr>';
                  }else{
                    $tabla.='<td class="text-center"><span class="label bg-danger">BAJA</span></td>
                              <td class="text-center">
                                <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Editar" onclick="mostrarEdicionSubproceso('.$data.')"><i class="fa fa-pencil icon-color-info"></i></button>
                                <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Activar" onclick="activarSub('.$data.')"><i class="fa fa-check"></i></button>
                                <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarSubproceso('.$data.')"><i class="fa fa-trash icon-color-danger"></i></button>
                              </td>
                              </tr>';
                  }



                }

              }

              $tabla .='</tbody>
                      </table>';
            }

          if ($condicion == 0){
            echo $tabla;
          }else{

            return $tabla;
          }

    }

    public function listarProcesosController(){
      session_start();

      $rows= ProcesosModels::listarProcesosModel($_SESSION['idsuscriptor'], "procesos");

      $data= Array();
      foreach ($rows as $row) {
        $info="";
        $info= "'".$row['idproceso']."|".$row['descripcion']."'";

        if( $row['condicion'] == 1){
          $estado =' <button class="btn  btn-sm btn-default"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Desactivar"
                    onclick="desactivar('.$info.')">
                      <i class="fa fa-ban"></i>
                  </button> ';
        }else{
          $estado=' <button class="btn btn-sm btn-default"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Activar"
                          onclick="activar('.$info.')">
                            <i class="fa fa-check"></i>
                  </button> ';
        }

        if( $row['publicar']== 0){
          $publicar=' <button class="btn  btn-sm btn-default"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Publicar"
                    onclick="publicar('.$info.')">
                      <i class="fa fa-globe"></i>
                  </button> ';
        }else{
          $publicar=' <button class="btn btn-sm btn-default"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Ocultar"
                          onclick="ocultar('.$info.')">
                            <i class="fa fa-power-off"></i>
                  </button> ';
        }

        #$date = date_create($row["fechaalta"]);

        $data[]=array(
          //"0"=>'<p class="text-center">'.date_format($date, 'Y-m-d').'</p>',
          "0"=>$row["descripcion"],
          "1"=>($row['condicion']==1)?'<p class="text-center"><span class="label bg-green ">ACTIVO</span></p>':
          '<span class="label bg-red text-center">BAJA</span>',
          "2"=>'<p class="text-center"><button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Editar" onclick="mostrar('.$info.')"><i class="fa fa-pencil"></i></button>'.
                $estado.
                $publicar.
                ' <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="mostrar('.$row['idproceso'].')"><i class="fa fa-trash"></i></button></p>'
          );
      }
      $results = array(
   			"sEcho"=>1, //Información para el datatables
   			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
   			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
   			"aaData"=>$data);
 		   echo json_encode($results);

    }

    public function actualizarSubprocesoController($idsubproceso, $subproceso, $idproceso){

       session_start();
       $parametros = ParametrosModels::parametrosModel();
       $fechaModificacion= date($parametros['formatoFecha']);
       $datosController = array("idsubproceso"           =>  $idsubproceso,
    							                "descripcion"           =>  $subproceso,
                                  "fechamodificacion"     =>  $fechaModificacion,
                                  "usuariomodificacion"   =>  $_SESSION['usuario']
    							               );

       $respuesta = ProcesosModels::actualizarSubprocesoModel($datosController, "subprocesos");

       #Obtener subprocesos insertados
       $condicion = 1;
       $subprocesosInsertados = self::mostrarSubprocesosController( $idproceso, $condicion );

       $envio= array(
         0=>$respuesta,
         1=> $subprocesosInsertados
       );

       echo json_encode($envio);

       //echo $respuesta;


    }

    public function desactivarSubController($idsubproceso, $idproceso){

        session_start();
        $parametros = ParametrosModels::parametrosModel();
        $fechaModificacion= date($parametros['formatoFecha']);
        $datosController = array("idsubproceso"         =>  $idsubproceso,
                                 "condicion"             => "0",
                                 "fechamodificacion"     =>  $fechaModificacion,
                                 "usuariomodificacion"   =>  $_SESSION['usuario']
                                );

        $respuesta = ProcesosModels::desactivarActivarSubModel($datosController, "subprocesos");
        #Obtener subprocesos insertados
        $condicion = 1;
        $subprocesosInsertados = self::mostrarSubprocesosController( $idproceso, $condicion );

        $envio= array(
          0=>$respuesta,
          1=> $subprocesosInsertados
        );

        echo json_encode($envio);
        //echo $respuesta;

      }

    public function activarSubController($idsubproceso, $idproceso){

          session_start();
          $parametros = ParametrosModels::parametrosModel();
          $fechaModificacion= date($parametros['formatoFecha']);
          $datosController = array("idsubproceso"         =>  $idsubproceso,
                                   "condicion"             => "1",
                                   "fechamodificacion"     =>  $fechaModificacion,
                                   "usuariomodificacion"   =>  $_SESSION['usuario']
                                  );

          $respuesta = ProcesosModels::desactivarActivarSubModel($datosController, "subprocesos");
          #Obtener subprocesos insertados
          $condicion = 1;
          $subprocesosInsertados = self::mostrarSubprocesosController( $idproceso, $condicion );

          $envio= array(
            0=>$respuesta,
            1=> $subprocesosInsertados
          );

          echo json_encode($envio);
          //echo $respuesta;

        }

    public function eliminarSubController($idsubproceso, $idproceso){

      #Obtiene todos los subprocesos existentes
      $rows = ProcesosModels::getSubprocesosDeleteModel($idproceso, "subprocesos");

      #identificar el consecutivo eliminado para reordenar a partir de ahi
      $inicio = 0;
      $valor = "";

      foreach ($rows as $key => $row) {
        if( $idsubproceso == $row['idsubproceso']){
          $inicio = $key;
          $valor = $row['consecutivo'];
          break;
        }
      }

      foreach ($rows as $key => $row) {
        if( $valor > $row['consecutivo']){
          $inicio = $key;
          $row['consecutivo'] = $row['consecutivo'] -1;
        }
      }

      var_dump($rows);


      
      // session_start();
      // $parametros = ParametrosModels::parametrosModel();
      // $fechaModificacion= date($parametros['formatoFecha']);
      // $datosController = array("idsubproceso"         =>  $idsubproceso,
      //                          "condicion"             => "2",
      //                          "fechamodificacion"     =>  $fechaModificacion,
      //                          "usuariomodificacion"   =>  $_SESSION['usuario']
      //                         );
      //
      // $respuesta = ProcesosModels::desactivarActivarSubModel($datosController, "subprocesos");
      // #Obtener subprocesos insertados
      // $condicion = 1;
      // $subprocesosInsertados = self::mostrarSubprocesosController( $idproceso, $condicion );
      //
      // $envio= array(
      //   0=>$respuesta,
      //   1=> $subprocesosInsertados
      // );
      //
      // echo json_encode($envio);
      //echo $respuesta;

    }

  }
