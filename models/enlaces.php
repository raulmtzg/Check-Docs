<?php

  class EnlacesModels{

    public function enlacesModel($enlaces){

      if($enlaces=="inicio"               ||
         $enlaces=="actualizar_password"  ||
         $enlaces=="admin_panel"          ||
         $enlaces=="admin_inicio"         ||
         $enlaces== "procesos"            ||
         $enlaces== "usuarios"            ||
         $enlaces== "tipo_documento"     ||
         $enlaces=="salir")

         {

           $module ="views/modules/".$enlaces.".php";

           $respuesta = array('0' => 1,
                              '1' => $module);

         }
          else if($enlaces =="index"){

            $module ="views/modules/ingreso.php";

            $respuesta = array('0' => 1,
                               '1' => $module);

          }
          else{

            $module = $enlaces;
            $respuesta = array('0' => 0,
                               '1' => $module);

          }

          return $respuesta;

    }

    public function getEnlacesDinamicos($enlacesDinamicos, $enlaces, $carpeta ){

      if( count($enlacesDinamicos) > 0 ){
        $ban = false;
        $i = 0;
        while ($i < count($enlacesDinamicos)) {

          if($enlaces == $enlacesDinamicos[$i]['identificadorsubproceso']){
            $ban = true;
          }
          $i++;

        }
        if( $ban == true ){

          $module ="views/modules/".$carpeta."/".$enlaces.".php";

        }else{
          $module ="views/modules/ingreso.php";
        }

      }else{

         $module ="views/modules/ingreso.php";
      }
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
