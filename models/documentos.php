<?php

  require_once "conexion.php";

  class DocumentosModels{

    public function getRutaModels($identificadorsubproceso, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT proceso, subproceso, idsubproceso FROM $tabla
                                            WHERE identificadorsubproceso = :identificadorsubproceso");
      $stmt->execute(array(
        ':identificadorsubproceso' => $identificadorsubproceso
      ));
      return $stmt->fetch();
      $stmt ->close();

    }

    public function getTipoDocumentoModels($idtipodocumento, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT descripcion FROM $tabla
                                            WHERE idtipodocumento = :idtipodocumento");
      $stmt->execute(array(
        ':idtipodocumento' => $idtipodocumento
      ));
      return $stmt->fetch();
      $stmt ->close();
    }

    public function getUsuarioResponsableModels($idusuario_suscriptor, $tabla ){

      $stmt = Conexion::conectar()->prepare("SELECT nombre_completo FROM $tabla
                                            WHERE idusuario_suscriptor = :idusuario_suscriptor");
      $stmt->execute(array(
        ':idusuario_suscriptor' => $idusuario_suscriptor
      ));
      return $stmt->fetch();
      $stmt ->close();

    }

  }
