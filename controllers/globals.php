<?php

  class Globals {

    public function getRutaController($identificadorsubproceso){
      $identificadorsubproceso = substr($identificadorsubproceso,1);

      $respuesta = GlobalsModels::getRutaModels($identificadorsubproceso, "vwopciones_menu");
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
