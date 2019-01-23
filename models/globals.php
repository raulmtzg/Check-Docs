<?php

  require_once "conexion.php";

  class GlobalsModels{

    public function getProcesosModels($idsuscriptor, $publicar, $condicionproceso, $condicionsubproceso, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsuscriptor = :idsuscriptor AND publicar = :publicar
                                              AND condicionproceso = :condicionproceso
                                              AND condicionsubproceso = :condicionsubproceso");
      $stmt ->bindParam(":idsuscriptor", $idsuscriptor, PDO::PARAM_INT);
      $stmt ->bindParam(":publicar", $publicar, PDO::PARAM_INT);
      $stmt ->bindParam(":condicionproceso", $condicionproceso, PDO::PARAM_INT);
      $stmt ->bindParam(":condicionsubproceso", $condicionsubproceso, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetchAll();  #Si es mas de una fila es fetchAll
      $stmt ->close();

    }

  }
