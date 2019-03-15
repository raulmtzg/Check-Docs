<?php
  require_once "conexion.php";

  class UsuarioModels{

    public function insertarModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :email AND idsuscriptor = :idsuscriptor");
      $statement->execute(array(
        ':email' => $datosModel["email"],
        ':idsuscriptor' => $datosModel["idsuscriptor"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        //el usuario ya existe
        return "3";
      }else{

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_completo, nombre_usuario, perfil, email, password_usuario, fecha_alta, usuario_alta, idsuscriptor)
                                                    VALUES (:nombre_completo, :nombre_usuario, :perfil, :email, :password_usuario, :fecha_alta, :usuario_alta, :idsuscriptor)");
    		$stmt -> bindParam(":nombre_completo", $datosModel["nombre_completo"], PDO::PARAM_STR);
    		$stmt -> bindParam(":nombre_usuario", $datosModel["nombre_usuario"], PDO::PARAM_STR);
        $stmt -> bindParam(":perfil", $datosModel["perfil"], PDO::PARAM_INT);
    		$stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":password_usuario", $datosModel["password_usuario"], PDO::PARAM_STR);
    		$stmt -> bindParam(":fecha_alta", $datosModel["fecha_alta"], PDO::PARAM_STR);
    		$stmt -> bindParam(":usuario_alta", $datosModel["usuario_alta"], PDO::PARAM_STR);
        $stmt -> bindParam(":idsuscriptor", $datosModel["idsuscriptor"], PDO::PARAM_INT);

    		if($stmt->execute()){
          #Insertado correctamente
    			return "1";
    		}

    		else{
          #Error al insertar el registro
    			return "2";
    		}

    		$stmt->close();

      }


    }

  }