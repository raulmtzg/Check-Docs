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

  }
