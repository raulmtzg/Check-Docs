<?php

  require_once "conexion.php";

  class ProcesosModels{

    public function insertarModel($datosModel, $tabla){

      //Configuracion para cuando se tiene que regresar el ultimo id insertado
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


          $stmt = $link2->prepare("INSERT INTO $tabla (descripcion,
                                                       consubprocesos,
                                                       usuarioalta,
                                                       fechaalta,
                                                       idsuscriptor
                                                       )
                                                 VALUES(:descripcion,
                                                        :consubprocesos,
                                                        :usuarioalta,
                                                        :fechaalta,
                                                        :idsuscriptor,
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


  }
