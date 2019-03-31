<?php

  class Documentos {

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

    public function insertarController($codigodocumento, $nombredocumento, $usuarioresponsable, $fecharevision, $version, $tipodocumento, $file){

      session_start();
      $parametros = ParametrosModels::parametrosModel();
      $fechaalta= date($parametros['formatoFecha']);

      $fechare = str_replace("/","-",$fecharevision);
      $fecha = date("Y-m-d", strtotime($fechare));

      #Obtener el tipo Documento
      $documento = DocumentosModels::getTipoDocumentoModels($tipodocumento, "tipodocumento");

      #Obtener el usuario responsable
      $responsable = DocumentosModels::getUsuarioResponsableModels($usuarioresponsable,"usuarios_suscriptores");

      $datosController = array("codigodocumento"       =>  $codigodocumento,
								               "nombredocumento"       =>  $nombredocumento,
                               "usuarioresponsable"    =>  $usuarioresponsable,
                               "fechaultimarevision"   =>  $fecha,
	                             "fechaalta"             =>  $fechaalta,
                               "version"               =>  $version,
                               "idtipodocumento"       =>  $tipodocumento,
                               "tipodocumento"         => $documento['descripcion'],
                               "idusuarioresponsable"  => $usuarioresponsable,
                               "usuarioresponsable"    => $responsable['nombre_documento'],
	                             "usuarioalta"       =>  $_SESSION['usuario']
								               );
      $respuesta = DocumentosModels::insertarModel($datosController, "tblcentrocosto");

    }

  }
