<?php

  class EnlacesModels{

    public function enlacesModel($enlaces){
      if($enlaces=="inicio"               ||
         $enlaces=="admin_panel"          ||
         $enlaces=="admin_inicio"         ||

         $enlaces=="salir"){

           $module ="views/modules/".$enlaces.".php";

          }
          else if($enlaces =="index"){

            $module ="views/modules/ingreso.php";

          }else{

            $module ="views/modules/ingreso.php";

          }
          return $module;

    }

  }
