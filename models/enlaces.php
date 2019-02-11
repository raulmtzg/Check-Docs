<?php

  class EnlacesModels{

    public function enlacesModel($enlaces){
      if($enlaces=="inicio"               ||
         $enlaces=="actualizar_password"  ||
         $enlaces=="admin_panel"          ||
         $enlaces=="admin_inicio"         ||
         $enlaces== "procesos"            ||
         $enlaces=="salir")

         {

           $module ="views/modules/".$enlaces.".php";

         }
          else if($enlaces =="index"){

            $module ="views/modules/ingreso.php";

          }else{

            $module ="views/modules/ingreso.php";

          }
          return $module;

    }

    public function getEnlacesDinamicos( $enlaces, $carpeta ){
      $module ="views/modules/".$carpeta."/".$enlaces.".php";
      return $module;
    }

    public function getOpcionesDinamicas($idsuscriptor, $condicionsubproceso, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT identificadorsubproceso FROM $tabla
                                            WHERE idsuscriptor = :idsuscriptor
                                            AND condicionsubproceso = :condicionsubproceso
                                            ORDER BY consecutivo ASC");
      $stmt->execute(array(
        ':idsuscriptor' => $idsuscriptor,
        ':condicionsubproceso' => $condicionsubproceso
      ));
      return $stmt->fetchAll();
      $stmt ->close();
    }

  }
