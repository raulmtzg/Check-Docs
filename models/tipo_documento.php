<?php
  require_once "conexion.php";

  class TipoDocumentoModels{

    public function listarModel($idsuscriptor, $tabla){
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsuscriptor = :idsuscriptor");
      $stmt ->bindParam(":idsuscriptor", $idsuscriptor, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetchAll();  #Si es mas de una fila es fetchAll
      $stmt ->close();
    }

    public function insertarModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE descripcion = :descripcion AND idsuscriptor = :idsuscriptor");
      $statement->execute(array(
        ':descripcion' => $datosModel["descripcion"],
        ':idsuscriptor' => $datosModel["idsuscriptor"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        // ya existe
        return "3";
      }else{

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (descripcion, fechaalta, usuarioalta, idsuscriptor)
                                                    VALUES (:descripcion, :fechaalta, :usuarioalta, :idsuscriptor)");
    		$stmt -> bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
    		$stmt -> bindParam(":fechaalta", $datosModel["fechaalta"], PDO::PARAM_STR);
    		$stmt -> bindParam(":usuarioalta", $datosModel["usuarioalta"], PDO::PARAM_STR);
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

    public function mostrarModel($idtipodocumento, $tabla){
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idtipodocumento = :idtipodocumento");
      $stmt ->bindParam(":idtipodocumento", $idtipodocumento, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetch();  #Si es mas de una fila es fetchAll
      $stmt ->close();
    }

    public function editarModel($datosModel, $tabla){
      #Validar que exista el usuario
      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idtipodocumento = :idtipodocumento");
      $statement->execute(array(
        ':idtipodocumento' => $datosModel["idtipodocumento"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe

        //Validar que el email no exista en otro registro
          $statement="";
          $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE descripcion = :descripcion AND idtipodocumento <> :idtipodocumento ");

          $statement->execute(array(
            ':descripcion'        => $datosModel["descripcion"],
            ':idtipodocumento'      => $datosModel["idtipodocumento"]
          ));
          $resp= $statement->fetch();
          if($resp != false){
            //Ya existe un usuario con ese email
            return "3";
          }else{

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion      = :descripcion,
                                                                     fechamodificacion   = :fechamodificacion,
                                                                     usuariomodificacion = :usuariomodificacion
                                                   WHERE idtipodocumento = :idtipodocumento");

            $stmt -> bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
         		$stmt -> bindParam(":fechamodificacion", $datosModel["fechamodificacion"], PDO::PARAM_STR);
         		$stmt -> bindParam(":usuariomodificacion", $datosModel["usuariomodificacion"], PDO::PARAM_STR);
            $stmt -> bindParam(":idtipodocumento", $datosModel["idtipodocumento"], PDO::PARAM_INT);

            if($stmt -> execute()){
              #Se guardo correctamente
              return "1";
            }
            else{
              #Error al grabar un registro
              return "2";
            }

          }

      }else{
        #No existe el id de la categoria
        return "4";
      }

    }

    public function desactivarActivarModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idtipodocumento = :idtipodocumento ");
      $statement->execute(array(
        ':idtipodocumento' => $datosModel["idtipodocumento"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe el usuario
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET condicion = :condicion,
                                                                 fechamodificacion = :fechamodificacion,
                                                                 usuariomodificacion = :usuariomodificacion
                                               WHERE idtipodocumento = :idtipodocumento");

        $stmt -> bindParam(":condicion", $datosModel["condicion"], PDO::PARAM_STR);
        $stmt -> bindParam(":idtipodocumento", $datosModel["idtipodocumento"], PDO::PARAM_INT);
        $stmt -> bindParam(":fechamodificacion", $datosModel["fechamodificacion"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuariomodificacion", $datosModel["usuariomodificacion"], PDO::PARAM_STR);

        if($stmt -> execute()){
          #Se guardo correctamente
          return "1";
        }
        else{
          #Error al grabar un registro
          return "2";
        }


      }else{
        //No existe la categoria
        return "3";

      }

    }//Fin function desactivarModel

    #==============================================================================
    # Esta funcion es consumida en:
    # -Cargar un nuevo documento
    #==============================================================================
    public function listarTiposActivosModel($idsuscriptor, $condicion, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT idtipodocumento, descripcion FROM $tabla
                                                WHERE condicion = :condicion AND idsuscriptor = :idsuscriptor
                                                ORDER BY descripcion ASC");
      $stmt ->bindParam(":condicion", $condicion, PDO::PARAM_INT);
      $stmt ->bindParam(":idsuscriptor", $idsuscriptor, PDO::PARAM_STR);
      $stmt -> execute();
      return $stmt->fetchAll();  #Si es mas de una fila es fetchAll
      $stmt ->close();

    }

  }
