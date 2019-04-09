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

    public function importarDocumentoOriginalModels($file, $ruta, $tipodocumento){


      $mensaje="";
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $fileType = $file['type'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt');

      if(in_array($fileActualExt, $allowed)){
        if ($fileError === 0) {
          if( $fileSize < 3000000){
            #Hasta 3mb
            //$fileNameNew = uniqid('', true).".".$fileActualExt;
            $fiNameTemp =$tipodocumento.'-';
            $fileNameNew = uniqid($fiNameTemp).".".$fileActualExt;
            $fileDestination =$ruta.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            $mensaje ="1";

          }else{
            //$mensaje= "Tu archivo es demasiado grande. Debe ser menor a 1MB";
            $mensaje = "3";
            $fileNameNew ="";

          }
          // code...
        }else{
          //$mensaje= "Ocurrio un error al cargar el archivo";
          $mensaje = "2";
          $fileNameNew = "";

        }

      }else{
        //$mensaje= "No se permite cargar archivos de este tipo";
        $mensaje ="4";
        $fileNameNew = "";

      }

      $arrayName = array('mensaje' => $mensaje,
                        'nombredocumento' => $fileNameNew
                        );
      return $arrayName;

    }//Fin function subirDoctoModel

    public function insertarDocumentoModels($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codigodocumento = :codigodocumento AND idsuscriptor = :idsuscriptor");
      $statement->execute(array(
        ':codigodocumento' => $datosModel["codigodocumento"],
        ':idsuscriptor' => $datosModel["idsuscriptor"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        //la categoria ya existe
        return "3";
      }else{

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigodocumento, nombredocumento, tipodocumento, estado, version, usuarioresponsable,
                                                                  fechaultimarevision, nombrearchivo, fechaalta, usuarioalta, idusuarioresponsable,
                                                                  idsubproceso, idtipodocumento, idsuscriptor)
                                                    VALUES (:codigodocumento, :nombredocumento, :tipodocumento, :estado, :version,
                                                            :usuarioresponsable, :fechaultimarevision, :nombrearchivo, :fechaalta, :usuarioalta,
                                                            :idusuarioresponsable, :idsubproceso, :idtipodocumento, :idsuscriptor)");
    		$stmt -> bindParam(":codigodocumento", $datosModel["codigodocumento"], PDO::PARAM_STR);
    		$stmt -> bindParam(":nombredocumento", $datosModel["nombredocumento"], PDO::PARAM_STR);
        $stmt -> bindParam(":tipodocumento", $datosModel["tipodocumento"], PDO::PARAM_STR);
        $stmt -> bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
        $stmt -> bindParam(":version", $datosModel["version"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuarioresponsable", $datosModel["usuarioresponsable"], PDO::PARAM_STR);
        $stmt -> bindParam(":fechaultimarevision", $datosModel["fechaultimarevision"], PDO::PARAM_STR);
        $stmt -> bindParam(":nombrearchivo", $datosModel["nombrearchivo"], PDO::PARAM_STR);
    		$stmt -> bindParam(":fechaalta", $datosModel["fechaalta"], PDO::PARAM_STR);
    		$stmt -> bindParam(":usuarioalta", $datosModel["usuarioalta"], PDO::PARAM_STR);
        $stmt -> bindParam(":idusuarioresponsable", $datosModel["idusuarioresponsable"], PDO::PARAM_INT);
        $stmt -> bindParam(":idsubproceso", $datosModel["idsubproceso"], PDO::PARAM_INT);
        $stmt -> bindParam(":idtipodocumento", $datosModel["idtipodocumento"], PDO::PARAM_INT);
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
