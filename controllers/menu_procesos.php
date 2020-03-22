<?php

  class MenuProcesos {

    public function listarOpcionesMenuController(){

      $procesos = MenuProcesosModels::getProcesosModels($_SESSION['idsuscriptor'], "1", "1", "procesos");

      if( count($procesos) > 0 ){

        $menu ="";
        $a = 0;
        while ($a < count($procesos)) {

          $subprocesos = MenuProcesosModels::getSubprocesosModels($procesos[$a]['idproceso'], "1", "subprocesos");
          if( count($subprocesos) > 1 ){
            #Tiene mas de una opcion
            $menu.='<li>
                      <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i>
                        <span class="hide-menu">'.$procesos[$a]['descripcion'].'</span></a>
                        <ul aria-expanded="false" class="collapse">';
            $j = 1;
            while ($j < count($subprocesos)) {
               $menu.='<li><a href="'.$subprocesos[$j]['identificadorsubproceso'].'">'.$subprocesos[$j]['descripcion'].'</a></li>';
               $j++;
            }

            $menu.='</ul>
                   </li>';

          }else{
            #Sin subprocesos
            $menu.='<li>
              <a href="'.$subprocesos[0]['identificadorsubproceso'].'">
                <span>'.$subprocesos[0]['descripcion'].'</span>
              </a>
            </li>';

          }
          $a++;
        }

      }
      echo $menu;
    }

  } //Fin Class
