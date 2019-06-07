<?php

  class Documentos {

    public function listarDocumentosController($idsubproceso) {
      session_start();

      $documentos = DocumentosModels::listarDocumentosModels($_SESSION['idsuscriptor'],$idsubproceso, "1", "documentos");
      $tabla = "";
      $tabla.='<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <!-- <th class="text-center">FECHA ALTA</th>-->
          <th></th>
          <th>ID</th>
          <th class="text-center">CÓDIGO</th>
          <th class="text-center">NOMBRE</th>
          <th class="text-center">RESPONSABLE</th>
          <th class="text-center">VERSIÓN</th>
          <th class="text-center">TIPO</th>
          <th class="text-center">ÚLTIMA REVISIÓN</th>
          <th class="text-center">ESTADO</th>
          <th class="text-center">OPCIONES</th>

        </thead>
        <tbody>';
        // <td class="documento-aprobado">
        //   <!-- <span data-toggle="tooltip" data-placement="top" title="Aprobado">&nbsp;</span> -->
        // </td>
        foreach ($documentos as $documento) {
          $classEstado ='';
          switch ($documento['estado']){
            case 'EN EDICIÓN':
              $classEstado= "documento-edicion";
              $btnEstado ="bg-info";
            break;
            case 'EN REVISIÓN':
              $classEstado= "documento-revision";
              $btnEstado ="bg-warning";
            break;
            case 'EN REVISIÓN':
              $classEstado= "documento-revision";
              $btnEstado ="bg-warning";
            break;
            case 'AUTORIZADO':
              $classEstado= "documento-aprobado";
              $btnEstado ="bg-green";
            break;
          }

          $tabla.='
          <tr class="derecho fila-proceso" data-id='.$documento['iddocumento'].'>
            <td class='.$classEstado.'></td>
            <td ><i class="fa fa-file-text-o icon-color-info" aria-hidden="true"></i> '.$documento['iddocumento'].' </td>
            <td>'.$documento['codigodocumento'].'</td>
            <td>'.$documento['nombredocumento'].'</td>
            <td>'.$documento['usuarioresponsable'].'</td>
            <td>'.$documento['version'].'</td>
            <td>'.$documento['tipodocumento'].'</td>
            <td>'.$documento['fechaultimarevision'].'</td>
            <td class="text-center"><span class="label '.$btnEstado.'">'.$documento['estado'].'</span></td>
            <td class="text-center">
            <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Enviar" onclick="">
            <i class="fa fa-paper-plane-o icon-color-info"></i>
            </button>
            <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Enviar" onclick="">
            <i class="fa fa-refresh icon-color-success" aria-hidden="true" ></i>
            </button>
            </td>
          </tr>';
        }
      //     <tr class="derecho fila-proceso" data-id="dos">
      //       <td class="documento-revision">
      //         <!-- <span data-toggle="tooltip" data-placement="top" title="Revisión">&nbsp;</span> -->
      //       </td>
      //       <td><i class="fa fa-file-text-o icon-color-info" aria-hidden="true"></i> 4852 </td>
      //       <td>SIS-PROD-2</td>
      //       <td>Procedimiento de Sistemas</td>
      //       <td>Admin</td>
      //       <td>0</td>
      //       <td>Procedimiento</td>
      //       <td>2019-01-25</td>
      //       <td class="text-center"><span class="label bg-warning">REVISIÓN</span></td>
      //       <td class="text-center">
      //          <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Enviar" onclick="">
      //            <i class="fa fa-paper-plane-o icon-color-info"></i>
      //          </button>
      //       </td>
      //     </tr>
      //     <tr class="derecho fila-proceso" data-id="tres">
      //       <td class="documento-edicion">
      //         <!-- <span data-toggle="tooltip" data-placement="top" title="Edición">&nbsp;</span> -->
      //       </td>
      //       <td><i class="fa fa-file-text-o icon-color-info" aria-hidden="true"></i> 4852 </td>
      //       <td>SIS-PROD-2</td>
      //       <td>Procedimiento de Sistemas</td>
      //       <td>Admin</td>
      //       <td>0</td>
      //       <td>Procedimiento</td>
      //       <td>2019-01-25</td>
      //       <td class="text-center"><span class="label bg-info">EDICIÓN</span></td>
      //       <td class="text-center">
      //          <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Enviar" onclick="">
      //            <i class="fa fa-paper-plane-o icon-color-info"></i>
      //          </button>
      //       </td>
      //     </tr>
      $tabla.='</tbody>
        </table>';
      echo $tabla;
    }

    public function getRutaController($identificadorsubproceso){
      $ruta = explode("/", $identificadorsubproceso);
      $total = count($ruta) -1;
      $identificador = $ruta[$total];

      $respuesta = DocumentosModels::getRutaModels($identificador, "vwopciones_menu");
      $html="";
      $html.='<li>'.$respuesta['proceso'].'</li>
        <li>'.$respuesta['subproceso'].'</li>
        <li class="active">
          <a id="btnNuevoDocto" href="javascript:mostrarform(true);" data-subproceso="'.$respuesta['idsubproceso'].'">
            <i class="fa fa-plus-circle"></i> Nuevo
          </a>
        </li>';
      echo $html;
    }

    public function insertarController($idsubproceso, $codigodocumento, $nombredocumento, $usuarioresponsable, $fecharevision, $version, $tipodocumento, $file){

      session_start();
      $parametros = ParametrosModels::parametrosModel();
      $fechaalta= date($parametros['formatoFecha']);

      $fechare = str_replace("/","-",$fecharevision);
      $fecha = date("Y-m-d", strtotime($fechare));

      #Obtener el tipo Documento
      $documento = DocumentosModels::getTipoDocumentoModels($tipodocumento, "tipodocumento");


      #Obtener el usuario responsable
      $responsable = DocumentosModels::getUsuarioResponsableModels($usuarioresponsable,"usuarios_suscriptores");

      #Grabar el documento en la carpeta del cliente/usuario
      $ruta = "../files/".$_SESSION['carpeta']."/";
      $respuestaDocumento = DocumentosModels::importarDocumentoOriginalModels($file, $ruta,$tipodocumento);

      if( $respuestaDocumento['mensaje'] == "1"){

        $datosController = array("codigodocumento"       =>  $codigodocumento,
  								               "nombredocumento"       =>  $nombredocumento,
                                 "tipodocumento"         => $documento['descripcion'],
                                 "estado"                => "EN EDICIÓN",
                                 "version"               =>  $version,
                                 "usuarioresponsable"    => $responsable['nombre_completo'],
                                 "fechaultimarevision"   =>  $fecha,
                                 "nombrearchivo"         => $respuestaDocumento['nombredocumento'],
                                 "fechaalta"             =>  $fechaalta,
  	                             "usuarioalta"           =>  $_SESSION['usuario'],
                                 "idusuarioresponsable"  =>  $usuarioresponsable,
                                 "idsubproceso"          => $idsubproceso,
                                 "idtipodocumento"       =>  $tipodocumento,
                                 "idsuscriptor"          => $_SESSION['idsuscriptor']
  								               );

                                 //var_dump($datosController);
        $respuesta = DocumentosModels::insertarDocumentoModels($datosController, "documentos");

        echo $respuesta;

      }else{
        #Error al cargar el archivo
      }



    }

    public function getDocumendoByIdController($iddocumento) {

      $respuesta = DocumentosModels::getDocumendoByIdModels($iddocumento, "documentos");
      echo json_encode($respuesta);

    }

    public function editarController( $iddocumento, $idsubproceso, $codigodocumento, $nombredocumento, $responsable, $fecharevision, $version, $tipodocumento ) {
        echo $iddocumento;
    }







  }
