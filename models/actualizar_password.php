<?php
  require_once "conexion.php";
  class ActualizarPasswordModels{

    public function getDatosUsuarioModel($datosModel, $tabla){
      //var_dump($datosModel);
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :email");
        $stmt ->bindParam(":email", $datosModel['email'], PDO::PARAM_STR);
        #$stmt ->bindParam(":password", $datosModel['password'],PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt->fetch();  #Si es mas de una fila es fetchAll
        $stmt ->close();
    }

    public function actualizarPasswordModel($datosModel, $tabla){
      //var_dump($datosModel['actualizarIntentos']);
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET password_usuario = :password_usuario WHERE email = :email");

      $stmt ->bindParam(":password_usuario", $datosModel['password_usuario'], PDO::PARAM_STR);

      $stmt ->bindParam(":email", $datosModel['email'], PDO::PARAM_STR);

      if($stmt -> execute()){
        return "1";
      }
      else{
        return "2";
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
