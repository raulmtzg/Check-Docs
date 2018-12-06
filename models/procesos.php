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

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idproceso = :idproceso");
      $stmt ->bindParam(":idproceso", $idproceso, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetchAll();  
      $stmt ->close();

    }

  }
