<?php

  require_once "conexion.php";

  class MenuProcesosModels{

    public function getProcesosModels($idsuscriptor, $publicar, $condicion, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsuscriptor = :idsuscriptor AND publicar = :publicar
                                              AND condicion = :condicion");
      $stmt ->bindParam(":idsuscriptor", $idsuscriptor, PDO::PARAM_INT);
      $stmt ->bindParam(":publicar", $publicar, PDO::PARAM_INT);
      $stmt ->bindParam(":condicion", $condicion, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetchAll();  #Si es mas de una fila es fetchAll
      $stmt ->close();

    }

    public function getSubprocesosModels($idproceso, $condicion, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idproceso = :idproceso
                                              AND condicion = :condicion");
      $stmt ->bindParam(":idproceso", $idproceso, PDO::PARAM_INT);
      $stmt ->bindParam(":condicion", $condicion, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetchAll();  #Si es mas de una fila es fetchAll
      $stmt ->close();

    }

  }
