<?php

  require_once "conexion.php";

  class ProcesosModels{

    public function insertarModel($datosModel, $tabla){

      #Configuracion para cuando se tiene que regresar el ultimo id insertado
      $server="";
      $basedatos="";
      $usuariobd="";
      $password="";
      $server=$datosModel["serverName"];
      $basedatos=$datosModel["dataBaseName"];
      $usuariobd=$datosModel["userDataBase"];
      $passwordDb=$datosModel["passwordDataBase"];

      try{

          $link2 = new PDO ("$server;$basedatos","$usuariobd","$passwordDb", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

          $stmt = $link2->prepare("INSERT INTO $tabla (descripcion, consubprocesos, usuarioalta, fechaalta, idsuscriptor)
                                                      VALUES(:descripcion,
                                                              :consubprocesos,
                                                              :usuarioalta,
                                                              :fechaalta,
                                                              :idsuscriptor
                                                              )");

          $stmt -> bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
          $stmt -> bindParam(":consubprocesos", $datosModel["consubprocesos"], PDO::PARAM_INT);
          $stmt -> bindParam(":usuarioalta", $datosModel["usuarioalta"], PDO::PARAM_STR);
          $stmt -> bindParam(":fechaalta", $datosModel["fechaalta"], PDO::PARAM_STR);
          $stmt -> bindParam(":idsuscriptor", $datosModel["idsuscriptor"], PDO::PARAM_INT);
          $stmt ->execute();

          return $link2->lastInsertId($tabla);
          $stmt->close();
        }
        catch(PDOException $e){

          echo "Error: " . $e->GetMessage() . " En la Linea " .  $e->getline();
          die ();

        }

    }

    public function insertarSubprocesosModel($listaSubprocesos, $idproceso, $fechaalta, $usuarioalta, $tabla){

      $num_elementos=0;
      $sw="Ok";

      while ($num_elementos< count($listaSubprocesos)){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (descripcion, consecutivo, usuarioalta, fechaalta, idproceso)
                                                        VALUES (:descripcion,
                                                                :consecutivo,
                                                                :usuarioalta,
                                                                :fechaalta,
                                                                :idproceso
                                                              )");
            $stmt -> bindParam(":descripcion", $listaSubprocesos[$num_elementos]->subproceso, PDO::PARAM_STR);
            $stmt -> bindParam(":consecutivo", $listaSubprocesos[$num_elementos]->index, PDO::PARAM_INT);
            $stmt -> bindParam(":usuarioalta", $usuarioalta, PDO::PARAM_STR);
            $stmt -> bindParam(":fechaalta", $fechaalta, PDO::PARAM_STR);
            $stmt -> bindParam(":idproceso", $idproceso, PDO::PARAM_INT);

            if($stmt->execute()){
              #Insertado correctamente
            }
            else{
              #Error al insertar el registro partidas
              $sw="ERR02";
            }

        $num_elementos=$num_elementos + 1;

      }//Fin ciclo While

      return $sw;

    }

    public function mostrarSubprocesoModel($idproceso, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idproceso = :idproceso AND condicion <> :condicion ORDER BY consecutivo ASC");
      $stmt->execute(array(
        ':idproceso' => $idproceso,
        ':condicion' => 2
      ));

      // $stmt ->bindParam(":idproceso", $idproceso, PDO::PARAM_INT);
      // $stmt -> execute();
      return $stmt->fetchAll();
      $stmt ->close();

    }

    public function listarProcesosModel($idsuscriptor, $tabla){
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
      $stmt->execute();
      return $stmt->fetchAll();
      $stmt ->close();
    }

    public function editarModel($datosModel, $tabla){

      #Validar que exista el id
      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idproceso = :idproceso");
      $statement->execute(array(
        ':idproceso' => $datosModel['idproceso']
      ));

      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe
        //Validar que la clave no exista en otro registro
          $statement="";
          $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE proceso = :proceso AND idproceso <> :idproceso ");

          $statement->execute(array(
            ':proceso'   => $datosModel['proceso'],
            ':idproceso' => $datosModel['idproceso']
          ));
          $resp= $statement->fetch();
          if($resp != false){
            //Ya existe un codigo de categoria
            return "3";
          }else{

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion              = :descripcion,
                                                                     fechamodificacion    = :fechamodificacion,
                                                                     usuariomodificacion  = :usuariomodificacion
                                                   WHERE idproceso = :idproceso");

            $stmt -> bindParam(":descripcion", $datosModel["proceso"], PDO::PARAM_STR);
         		$stmt -> bindParam(":fechamodificacion", $datosModel["fechamodificacion"], PDO::PARAM_STR);
         		$stmt -> bindParam(":usuariomodificacion", $datosModel["usuariomodificacion"], PDO::PARAM_STR);
            $stmt -> bindParam(":idproceso", $datosModel["idproceso"], PDO::PARAM_INT);

            if($stmt -> execute()){
              #Se guardo correctamente
              return "Ok";
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

    public function actualizarSubprocesoModel($datosModel, $tabla){
      #Validar que exista el id
      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsubproceso = :idsubproceso");
      $statement->execute(array(
        ':idsubproceso' => $datosModel["idsubproceso"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe

        //Validar que la clave no exista en otro registro
          $statement="";
          $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE descripcion = :descripcion AND idsubproceso <> :idsubproceso ");

          $statement->execute(array(
            ':descripcion'        => $datosModel["descripcion"],
            ':idsubproceso'      => $datosModel["idsubproceso"]
          ));
          $resp= $statement->fetch();
          if($resp != false){
            //Ya existe un codigo de categoria
            return "3";
          }else{

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion          = :descripcion,
                                                                     fechamodificacion    = :fechamodificacion,
                                                                     usuariomodificacion  = :usuariomodificacion
                                                   WHERE idsubproceso = :idsubproceso");

         		$stmt -> bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
         		$stmt -> bindParam(":fechamodificacion", $datosModel["fechamodificacion"], PDO::PARAM_STR);
         		$stmt -> bindParam(":usuariomodificacion", $datosModel["usuariomodificacion"], PDO::PARAM_STR);
            $stmt -> bindParam(":idsubproceso", $datosModel["idsubproceso"], PDO::PARAM_INT);

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

    public function desactivarActivarSubModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsubproceso = :idsubproceso ");
      $statement->execute(array(
        ':idsubproceso' => $datosModel["idsubproceso"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe la categoria
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET condicion = :condicion,
                                                                 fechamodificacion = :fechamodificacion,
                                                                 usuariomodificacion = :usuariomodificacion
                                               WHERE idsubproceso = :idsubproceso");

        $stmt -> bindParam(":condicion", $datosModel["condicion"], PDO::PARAM_STR);
        $stmt -> bindParam(":idsubproceso", $datosModel["idsubproceso"], PDO::PARAM_INT);
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

    #================ Funciones para reorder subprocesos despuesde eliminarlo=============
    public function getSubprocesosDeleteModel($idproceso, $tabla){

      $stmt = Conexion::conectar()->prepare("SELECT idsubproceso, consecutivo, descripcion FROM $tabla WHERE idproceso = :idproceso AND condicion <> :condicion AND consecutivo > :consecutivo ORDER BY consecutivo ASC");
      $stmt->execute(array(
        ':idproceso' => $idproceso,
        ':condicion' => 2,
        ':consecutivo' => 0
      ));

      // $stmt ->bindParam(":idproceso", $idproceso, PDO::PARAM_INT);
      // $stmt -> execute();
      return $stmt->fetchAll();
      $stmt ->close();

    }

  }
