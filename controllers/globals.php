<?php

  class Globals {

    public function getRutaController($identificadorsubproceso){
      $ruta = explode("/", $identificadorsubproceso);
      $total = count($ruta) -1;
      $identificador = $ruta[$total];

      $respuesta = GlobalsModels::getRutaModels($identificador, "vwopciones_menu");
      $html="";
      $html.='<li>'.$respuesta['proceso'].'</li>
        <li>'.$respuesta['subproceso'].'</li>
        <li class="active">
          <a id="btnNuevoDocto" href="javascript:mostrarform(true);">
            <i class="fa fa-plus-circle"></i> Nuevo
          </a>
        </li>';
      echo $html;
    }

  }
