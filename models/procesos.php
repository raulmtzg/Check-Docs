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
          $identificadorproceso = uniqid();
          $link2 = new PDO ("$server;$basedatos","$usuariobd","$passwordDb", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

          $stmt = $link2->prepare("INSERT INTO $tabla (descripcion, consubprocesos, identificadorproceso, usuarioalta, fechaalta, idsuscriptor)
                                                      VALUES(:descripcion,
                                                              :consubprocesos,
                                                              :identificadorproceso,
                                                              :usuarioalta,
                                                              :fechaalta,
                                                              :idsuscriptor
                                                              )");

          $stmt -> bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
          $stmt -> bindParam(":consubprocesos", $datosModel["consubprocesos"], PDO::PARAM_INT);
          $stmt -> bindParam(":identificadorproceso", $identificadorproceso, PDO::PARAM_STR);
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

      while ($num_elementos < count($listaSubprocesos)){
            $identificadorsubproceso = uniqid();
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (descripcion, consecutivo, identificadorsubproceso, usuarioalta, fechaalta, idproceso)
                                                        VALUES (:descripcion,
                                                                :consecutivo,
                                                                :identificadorsubproceso,
                                                                :usuarioalta,
                                                                :fechaalta,
                                                                :idproceso
                                                              )");
            $stmt -> bindParam(":descripcion", $listaSubprocesos[$num_elementos]->subproceso, PDO::PARAM_STR);
            $stmt -> bindParam(":consecutivo", $listaSubprocesos[$num_elementos]->index, PDO::PARAM_INT);
            $stmt -> bindParam(":identificadorsubproceso", $identificadorsubproceso, PDO::PARAM_STR);
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
          $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE proceso = :proceso AND idproceso <> :idproceso  ");

          $statement->execute(array(
            ':proceso'      => $datosModel['proceso'],
            ':idproceso'    => $datosModel['idproceso'],

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
          $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE descripcion = :descripcion AND idsubproceso <> :idsubproceso AND consecutivo > :consecutivo ");

          $statement->execute(array(
            ':descripcion'    => $datosModel["descripcion"],
            ':idsubproceso'   => $datosModel["idsubproceso"],
            ':consecutivo'    => 0
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

    public function actualizarConsecutivosSubModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsubproceso = :idsubproceso ");
      $statement->execute(array(
        ':idsubproceso' => $datosModel["idsubproceso"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe la categoria
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET consecutivo = :consecutivo,
                                                                 fechamodificacion = :fechamodificacion,
                                                                 usuariomodificacion = :usuariomodificacion
                                               WHERE idsubproceso = :idsubproceso");

        $stmt -> bindParam(":consecutivo", $datosModel["consecutivo"], PDO::PARAM_STR);
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

    public function eliminarSubModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsubproceso = :idsubproceso ");
      $statement->execute(array(
        ':idsubproceso' => $datosModel["idsubproceso"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe la categoria
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET condicion = :condicion,
                                                                 consecutivo = :consecutivo,
                                                                 fechamodificacion = :fechamodificacion,
                                                                 usuariomodificacion = :usuariomodificacion
                                               WHERE idsubproceso = :idsubproceso");

        $stmt -> bindParam(":condicion", $datosModel["condicion"], PDO::PARAM_STR);
        $stmt -> bindParam(":consecutivo", $datosModel["consecutivo"], PDO::PARAM_INT);
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

    #============== Funciones para crear el archivo del Proceso con Subprocesos ============

    public function getSubprocesosModel($idproceso, $tabla){
      $stmt = Conexion::conectar()->prepare("SELECT idsubproceso, descripcion, identificadorsubproceso FROM $tabla
                                             WHERE idproceso = :idproceso AND condicion = :condicion AND archivocreado = :archivocreado
                                             ORDER BY descripcion ASC");
      $stmt->execute(array(
        ':idproceso' => $idproceso,
        ':condicion' => 1,
        ':archivocreado' => 0
      ));
      return $stmt->fetchAll();
      $stmt ->close();
    }

    public function crearProcesoModel($archivos, $carpeta){
      $sw = 0;
      $a = 0;
      while ($a < count($archivos)) {

        $ruta = "../modules/".$carpeta."/".$archivos[$a]['identificadorsubproceso'].".php";
        $miArchivo = fopen($ruta, "w+") or die("No se puede abrir/crear el archivo!");
        #Creamos una variable personalizada
        $var = 'testDatosPersonalizados';

        $php='<?php
                include "header.php";
                include "menu.php";
              ?>
              <!-- Content Wrapper. Contains page content -->
              <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box">
                        <div class="box-header with-border">
                          <h1 class="box-title">'.$archivos[$a]['descripcion'].'</h1>
                        </div>
                      </div><!-- /.box -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </section><!-- /.content -->
              </div><!-- /.content-wrapper -->

              <?php
                include "footer.php";
               ?>
                </body>';

        fwrite($miArchivo, $php);
        fclose($miArchivo);
        $sw = 1;

        $a++;

      }

      return $sw;

    }

    public function actualizarCrearArchivoModel($idproceso, $archivocreado, $tabla){

      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET archivocreado = :archivocreado
                                             WHERE idproceso = :idproceso");

      $stmt -> bindParam(":archivocreado", $archivocreado, PDO::PARAM_INT);
      $stmt -> bindParam(":idproceso", $idproceso, PDO::PARAM_INT);

      if($stmt -> execute()){
        #Se guardo correctamente
        return "1";
      }
      else{
        #Error al grabar un registro
        return "2";
      }

    }

    public function publicarProcesoModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idproceso = :idproceso ");
      $statement->execute(array(
        ':idproceso' => $datosModel["idproceso"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe la categoria
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET publicar = :publicar,
                                                                 ultimapublicacion = :ultimapublicacion,
                                                                 usuariopublica = :usuariopublica
                                               WHERE idproceso = :idproceso");

        $stmt -> bindParam(":publicar", $datosModel["publicar"], PDO::PARAM_STR);
        $stmt -> bindParam(":idproceso", $datosModel["idproceso"], PDO::PARAM_INT);
        $stmt -> bindParam(":ultimapublicacion", $datosModel["ultimapublicacion"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuariopublica", $datosModel["usuariopublica"], PDO::PARAM_STR);

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

    }

    public function ocultarProcesoModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idproceso = :idproceso ");
      $statement->execute(array(
        ':idproceso' => $datosModel["idproceso"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe la categoria
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET publicar = :publicar,
                                                                 fechamodificacion = :fechamodificacion,
                                                                 usuariomodificacion = :usuariomodificacion
                                               WHERE idproceso = :idproceso");

        $stmt -> bindParam(":publicar", $datosModel["publicar"], PDO::PARAM_STR);
        $stmt -> bindParam(":idproceso", $datosModel["idproceso"], PDO::PARAM_INT);
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

    }


  }
