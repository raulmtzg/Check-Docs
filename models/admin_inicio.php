<?php

  require_once "conexion.php";

  class AdminInicioModels{

    public function insertarModel($idsuscriptor, $encabezado, $descripcion, $tabla){

      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (encabezado, descripcion, idsuscriptor)
                                                  VALUES (:encabezado, :descripcion, :idsuscriptor)");
      $stmt -> bindParam(":encabezado", $encabezado, PDO::PARAM_STR);
      $stmt -> bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
      $stmt -> bindParam(":idsuscriptor", $idsuscriptor, PDO::PARAM_INT);

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

    public function subirLogoModel( $suscriptor, $file){

      $mensaje="";
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $fileType = $file['type'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = array('jpg', 'jpeg', 'png');

      if(in_array($fileActualExt, $allowed)){
        if ($fileError === 0) {
          if( $fileSize < 2000000){
            #Hasta 2mb
            //$fileNameNew = uniqid('', true).".".$fileActualExt;
            $fiNameTemp ='logo_'.$suscriptor;
            $fileNameNew = $fiNameTemp.".".$fileActualExt;
            $fileDestination ='../img/'.$suscriptor."/".$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            $mensaje ="1";

          }else{
            //$mensaje= "Tu archivo es demasiado grande. Debe ser menor a 1MB";
            $mensaje = "3";
            $fileNameNew ="";
            $fileDestination = "";
          }
          // code...
        }else{
          //$mensaje= "Ocurrio un error al cargar el archivo";
          $mensaje = "2";
          $fileNameNew = "";
          $fileDestination = "";
        }

      }else{
        //$mensaje= "No se permite cargar archivos de este tipo";
        $mensaje ="4";
        $fileNameNew = "";
        $fileDestination = "";
      }

      $arrayName = array('mensaje' => $mensaje,
                        'nombredocumento' => $fileNameNew,
                        'ubicacion' => $fileDestination);
      return $arrayName;

    }


  }
