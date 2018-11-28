<?php
  require_once "conexion.php";
  class IngresoModels{

    public function ingresoModel($datosModel, $tabla){
      //var_dump($datosModel);
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :email");
        $stmt ->bindParam(":email", $datosModel['email'], PDO::PARAM_STR);
        #$stmt ->bindParam(":password", $datosModel['password'],PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt->fetch();  #Si es mas de una fila es fetchAll
        $stmt ->close();
    }

    public function intentosModel($datosModel, $tabla){
      //var_dump($datosModel['actualizarIntentos']);
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos = :intentos WHERE email = :email");

      $stmt ->bindParam(":intentos", $datosModel['actualizarIntentos'], PDO::PARAM_INT);

      $stmt ->bindParam(":email", $datosModel['emailActual'], PDO::PARAM_STR);

      if($stmt -> execute()){
        return "ok";
      }
      else{
        return "error";
      }

    }

    public function listarPermisosUsuarioIngresoModel($idusuario, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT idpermiso FROM $tabla WHERE idusuario = :idusuario ORDER BY idpermiso ASC" );
      $stmt ->bindParam(":idusuario", $idusuario, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetchAll();  #Si es mas de una fila es fetchAll
      $stmt ->close();
    }

  }
