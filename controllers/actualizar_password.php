<?php

class ActualizarPassword{

  public function actualizarPasswordController($email_usuario, $pass_usuario, $pass_nuevo){

      $claveHash= hash("SHA256",$pass_nuevo);
      //echo $claveHash;
      $datosController= array(
        "email"   =>  $email_usuario,
        "password"  =>  $pass_usuario
      );

      $respuesta = ActualizarPasswordModels::getDatosUsuarioModel($datosController, "usuarios_suscriptores");

      if($respuesta['email'] == $email_usuario && $respuesta['password_usuario']== $pass_usuario){

        $datosController = array("email" => $email_usuario, "password_usuario" => $claveHash);

        $actualizarPassword = ActualizarPasswordModels::actualizarPasswordModel($datosController, "usuarios_suscriptores");

      }else{
        $actualizarPassword ="3";
      }
      echo $actualizarPassword;

  }


}
