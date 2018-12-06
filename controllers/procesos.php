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
      $subprocesosInsertados = self::mostrarSubprocesosController( $respuesta );

      $envio= array(
        0=>$mensaje,
        1=>$respuesta,
        2=> $subprocesosInsertados
      );

      echo json_encode($envio);

    }

    public function mostrarSubprocesosController($idproceso){

      

      $rows = ProcesosModels::mostrarSubprocesoModel($idproceso, "subprocesos");
        
        $tabla="";
        $tabla.='<table id="table-subprocesos" class="table table-condensed table-striped">
          <thead>
            <tr>
              <th ># POSICIÓN</th>
              <th class="text-center">SUBPROCESO</th>
              <th cclass="text-center">ESTADO</th>
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
                  
                  $tabla.='<tr>
                    <td class="text-center" >'.$row['consecutivo'].'</td>
                    <td >'.$row['descripcion'].'</td>';
  
                  if( $row['condicion']==1 ){
                    $tabla.='<td class="text-center"><span class="label bg-success">ACTIVO</span></td>';
                  }else{
                    $tabla.='<td class="text-center"><span class="label bg-danger">BAJA</span></td>';
                  }
  
                  $tabla.='
                    <td class="text-center">
                      <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="right" title="Editar registro" onclick="mostrarEdicionSubproceso('.$data.')"><i class="fa fa-pencil icon-color-info"></i></button>
                      <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="right" title="Eliminar registro" onclick="eliminarSubproceso('.$data.')"><i class="fa fa-trash icon-color-danger"></i></button></td>
                    </tr>';

                }

              }

              $tabla .='</tbody>
                      </table>';
            }

          return $tabla;

    }

  }
