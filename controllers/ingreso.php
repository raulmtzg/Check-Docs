<?php

class Ingreso{

  static public function iniciarSesionController($email_usuario, $pass_usuario){

      #240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9
      $claveHash= hash("SHA256",$pass_usuario);
      //echo $claveHash;
      $datosController= array(
        "email"   =>  $email_usuario,
        "password"  =>  $claveHash
      );

      $respuesta = IngresoModels::ingresoModel($datosController, "vwacceso");

      $lg = strlen($respuesta['password_usuario']);

      if($lg <= 8){
        echo "3";
        session_start();
        $_SESSION['cambiarPass']= true;
        exit();
      }



      $intentos = $respuesta['intentos'];
      $emailActual = $email_usuario;
      $maximoIntentos= 2;

      if(isset($_POST["g-recaptcha-response"])){

        $secret ="6Lc3Im4UAAAAAPaH8oC5BlSTkxWl4tE4D6UXZOl6";
        $response = $_POST["g-recaptcha-response"];
        $remoteip = $_SERVER["REMOTE_ADDR"];

        $result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");

        $array = json_decode($result,TRUE);

        if($array["success"]){
          $intentos = 0;
        }

      }

      if($intentos < $maximoIntentos){

        if($respuesta['email']== $email_usuario && $respuesta['password_usuario']== $claveHash){

          $intentos=0;
          $datosController = array("emailActual" => $emailActual, "actualizarIntentos" => $intentos);
          $respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "administradores");

          session_start();
          $_SESSION['validar']= true;
          #Datos Suscriptor
          $_SESSION['idsuscriptor']= $respuesta['idsuscriptor'];
          $_SESSION['nombre_empresa']= $respuesta['nombre_empresa'];
          $_SESSION['rfc']= $respuesta['rfc'];
          $_SESSION['limite_usuarios']= $respuesta['limite_usuarios'];
          $_SESSION['capacidad_almacenamiento']= $respuesta['capacidad_almacenamiento'];
          $_SESSION['carpeta']= $respuesta['carpeta'];
          $_SESSION['condicion_suscriptor']= $respuesta['condicion_suscriptor'];
          $_SESSION['descripcion']= $respuesta['descripcion'];
          $_SESSION['logo']= $respuesta['logo'];
          $_SESSION['encabezado']= $respuesta['encabezado'];

          #Datos usuario
          $_SESSION['idusuario_suscriptor']= $respuesta['idusuario_suscriptor'];
          $_SESSION['usuario']= $respuesta['nombre_usuario'];
          $_SESSION['nombre_usuario']= $respuesta['nombre_usuario'];
          $_SESSION['email']= $respuesta['email'];
          $_SESSION['perfil']= $respuesta['perfil'];
          $_SESSION['foto']= $respuesta['foto'];

          // echo "<pre>";
          // print_r($_SESSION);
          // echo "</pre>";
          // die;


          echo "1";

        }
        else{
          ++$intentos;

          $datosController = array("emailActual" => $emailActual, "actualizarIntentos" => $intentos);
          $respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "administradores");

          // echo '<div class="alert alert-danger">Error al ingresar</div>';
          #No existe el usuario o password incorrecto
          echo "2";
        }

      }
      else{
        //$intentos=0;
        $datosController = array("emailActual" => $emailActual, "actualizarIntentos" => $intentos);
        $respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "tblusuarios");

        // echo '<div class="alert alert-danger">Ha fallado 3 veces, ingrese el captcha</div>';
        #Ha superado los intentos
        echo "4";

      }

  }


}
