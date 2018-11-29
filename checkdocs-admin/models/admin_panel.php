<?php
  require_once "conexion.php";

  class AdminPanelModels{

    public function listarModel($tabla){
      $stmt = Conexion::conectar()->prepare("SELECT idsuscriptor, nombre_empresa, rfc, condicion FROM $tabla");
      $stmt->execute();
      return $stmt->fetchAll();
      $stmt ->close();
    }


    public function mostrarModel($idsuscriptor, $tabla){
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsuscriptor = :idsuscriptor");
      $stmt ->bindParam(":idsuscriptor", $idsuscriptor, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetch();  #Si es mas de una fila es fetchAll
      $stmt ->close();
    }

    public function insertarModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE rfc= :rfc");
      $statement->execute(array(
        ':rfc' => $datosModel["rfc"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        //la categoria ya existe
        return "3";
      }else{

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (rfc, nombre_empresa, cantidad_admin, telefono, limite_usuarios, capacidad_almacenamiento, carpeta, logo, condicion, fecha_alta, usuario_alta)
                                                    VALUES (:rfc, :nombre_empresa, :cantidad_admin, :telefono, :limite_usuarios, :capacidad_almacenamiento, :carpeta, :logo, :condicion, :fecha_alta, :usuario_alta)");
    		$stmt -> bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
    		$stmt -> bindParam(":nombre_empresa", $datosModel["nombre_empresa"], PDO::PARAM_STR);
        $stmt -> bindParam(":cantidad_admin", $datosModel["cantidad_admin"], PDO::PARAM_INT);
        $stmt -> bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
        $stmt -> bindParam(":limite_usuarios", $datosModel["limite_usuarios"], PDO::PARAM_INT);
        $stmt -> bindParam(":capacidad_almacenamiento", $datosModel["capacidad_almacenamiento"], PDO::PARAM_STR);
        $stmt -> bindParam(":carpeta", $datosModel["carpeta"], PDO::PARAM_STR);
        $stmt -> bindParam(":logo", $datosModel["logo"], PDO::PARAM_STR);
        $stmt -> bindParam(":condicion", $datosModel["condicion"], PDO::PARAM_STR);
    		$stmt -> bindParam(":fecha_alta", $datosModel["fecha_alta"], PDO::PARAM_STR);
    		$stmt -> bindParam(":usuario_alta", $datosModel["usuario_alta"], PDO::PARAM_STR);

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

    public function editarModel($datosModel, $tabla){
      #Validar que exista el id
      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsuscriptor = :idsuscriptor");
      $statement->execute(array(
        ':idsuscriptor' => $datosModel["idsuscriptor"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET rfc = :rfc,
                                                   nombre_empresa           = :nombre_empresa,
                                                   cantidad_admin           = :cantidad_admin,
                                                   telefono                 = :telefono,
                                                   limite_usuarios          = :limite_usuarios,
                                                   capacidad_almacenamiento  = :capacidad_almacenamiento,
                                                   fecha_modificacion       = :fecha_modificacion,
                                                   usuario_modificacion     = :usuario_modificacion
                                               WHERE idsuscriptor = :idsuscriptor");

        $stmt -> bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
     		$stmt -> bindParam(":nombre_empresa", $datosModel["nombre_empresa"], PDO::PARAM_STR);
        $stmt -> bindParam(":cantidad_admin", $datosModel["cantidad_admin"], PDO::PARAM_INT);
        $stmt -> bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
        $stmt -> bindParam(":limite_usuarios", $datosModel["limite_usuarios"], PDO::PARAM_INT);
        $stmt -> bindParam(":capacidad_almacenamiento", $datosModel["capacidad_almacenamiento"], PDO::PARAM_STR);
     		$stmt -> bindParam(":fecha_modificacion", $datosModel["fecha_modificacion"], PDO::PARAM_STR);
     		$stmt -> bindParam(":usuario_modificacion", $datosModel["usuario_modificacion"], PDO::PARAM_STR);
        $stmt -> bindParam(":idsuscriptor", $datosModel["idsuscriptor"], PDO::PARAM_INT);

        if($stmt -> execute()){
          #Se guardo correctamente
          return "1";
        }
        else{
          #Error al grabar un registro
          return "2";
        }

      }else{
        #No existe el id de la categoria
        return "3";
      }

    }

    public function desactivarActivarModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsuscriptor = :idsuscriptor ");
      $statement->execute(array(
        ':idsuscriptor' => $datosModel["idsuscriptor"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        #Si existe la categoria
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET condicion = :condicion,
                                                                 fecha_modificacion = :fecha_modificacion,
                                                                 usuario_modificacion = :usuario_modificacion
                                               WHERE idsuscriptor = :idsuscriptor");

        $stmt -> bindParam(":condicion", $datosModel["condicion"], PDO::PARAM_STR);
        $stmt -> bindParam(":idsuscriptor", $datosModel["idsuscriptor"], PDO::PARAM_INT);
        $stmt -> bindParam(":fecha_modificacion", $datosModel["fecha_modificacion"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario_modificacion", $datosModel["usuario_modificacion"], PDO::PARAM_STR);

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

    public function listarCentrosActivosModel($condicion, $tabla){
      $stmt = Conexion::conectar()->prepare("SELECT idcentrocosto, descripcion FROM $tabla WHERE condicion = :condicion");
      $stmt ->bindParam(":condicion", $condicion, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetchAll();  #Si es mas de una fila es fetchAll
      $stmt ->close();
    }

    public function insertarAdminModel($datosModel, $tabla){

      $statement = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email= :email");
      $statement->execute(array(
        ':email' => $datosModel["email"]
      ));
      $resultado= $statement->fetch();
      if($resultado != false){
        //El correo ya existe
        return "3";
      }else{

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_completo, email, perfil, password_usuario, condicion, fecha_alta, usuario_alta, idsuscriptor)
                                                    VALUES (:nombre_completo, :email, :perfil, :password_usuario, :condicion, :fecha_alta, :usuario_alta, :idsuscriptor)");
    		$stmt -> bindParam(":nombre_completo", $datosModel["nombre_completo"], PDO::PARAM_STR);
    		$stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":perfil", $datosModel["perfil"], PDO::PARAM_INT);
        $stmt -> bindParam(":password_usuario", $datosModel["password_usuario"], PDO::PARAM_STR);
    		$stmt -> bindParam(":condicion", $datosModel["condicion"], PDO::PARAM_STR);
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

    public function mostrarAdminModel($idsuscriptor, $perfil, $tabla){
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idsuscriptor = :idsuscriptor AND perfil = :perfil");
      $stmt ->bindParam(":idsuscriptor", $idsuscriptor, PDO::PARAM_INT);
      $stmt ->bindParam(":perfil", $perfil, PDO::PARAM_INT);
      $stmt -> execute();
      return $stmt->fetch();  #Si es mas de una fila es fetchAll
      $stmt ->close();
    }



  }
