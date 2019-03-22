<?php

  require_once "conexion.php";

  class DocumentosModels{

    public function getRutaModels($identificadorsubproceso, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT proceso, subproceso FROM $tabla
                                            WHERE identificadorsubproceso = :identificadorsubproceso");
      $stmt->execute(array(
        ':identificadorsubproceso' => $identificadorsubproceso
      ));
      return $stmt->fetch();
      $stmt ->close();

    }

  }
