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
            // <li>
            //   <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
            //     <i class="mdi mdi-gauge"></i>
            //     <span class="hide-menu">Dashboard</span>
            //   </a>
            //     <ul aria-expanded="false" class="collapse">
            //         <li><a href="index.html">Minimal </a></li>
            //         <li><a href="index2.html">Analytical</a></li>
            //         <li><a href="index3.html">Demographical</a></li>
            //         <li><a href="index4.html">Modern</a></li>
            //     </ul>
            // </li>



            $menu.='<li class="treeview">
                      <a href="#">
                        <i class="fa fa-folder-o"></i>
                        <span>'.$procesos[$a]['descripcion'].'</span>
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">';
            $j = 1;
            while ($j < count($subprocesos)) {
               $menu.='<li><a href="'.$subprocesos[$j]['identificadorsubproceso'].'"><i class="fa fa-folder-open"></i> '.$subprocesos[$j]['descripcion'].'</a></li>';
               $j++;
            }

            $menu.='</ul>
                   </li>';

          }else{
            #Sin subprocesos
            $menu.='<li>
              <a href="'.$subprocesos[0]['identificadorsubproceso'].'">
                <i class="fa fa-folder-o"></i> <span>'.$subprocesos[0]['descripcion'].'</span>
              </a>
            </li>';

          }
          $a++;
        }

      }
      echo $menu;
    }

  } //Fin Class
