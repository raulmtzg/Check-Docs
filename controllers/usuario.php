<?php

  class Usuario {

    public function insertarController($nombre_completo, $nombre_usuario, $perfil, $email){

      session_start();
      $caracteres='ABCDEFGHIJKLMNOPQRSTUVWXYZabdefgijklmnopqrstuvwxyz013456789';
      $longpalabra=4;
      for($pass='', $n=strlen($caracteres)-1; strlen($pass) < $longpalabra ; ) {
        $x = rand(0,$n);
        $pass.= $caracteres[$x];
      }

      $password_usuario = 'chk2'.$pass;

      $parametros = ParametrosModels::parametrosModel();
      $fecha_alta= date($parametros['formatoFecha']);
      $datosController = array("nombre_completo"  =>  $nombre_completo,
								               "nombre_usuario"   =>  $nombre_usuario,
                               "perfil"           =>  $perfil,
                               "email"            =>  $email,
                               "password_usuario" =>  $password_usuario,
	                             "fecha_alta"       =>  $fecha_alta,
	                             "usuario_alta"     =>  $_SESSION['usuario'],
                               "idsuscriptor"     =>  $_SESSION['idsuscriptor']
								               );

      $respuesta = UsuarioModels::insertarModel($datosController, "usuarios_suscriptores");

      echo $respuesta;

    }

  }
