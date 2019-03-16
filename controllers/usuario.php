<?php

  class Usuario {

    public function listarController(){
      session_start();
      $rows= UsuarioModels::listarModel($_SESSION['idsuscriptor'], "usuarios_suscriptores");

      $data= Array();
      foreach ($rows as $row) {
        $info="";
        $perfil="";
        $info= "'".$row['idusuario_suscriptor']."-".$row['nombre_completo']."'";
        if($row['perfil']=="1"){
          $perfil = "SUPER ADMINISTRADOR";
          $clase = "disabled";
        }elseif ($row['perfil']=="2") {
          $perfil = "ADMINISTRADOR";
          $clase = "";
        }else{
          $perfil = "USUARIO BÁSICO";
          $clase="";
        }
        $data[]=array(
          "0"=>$row["nombre_completo"],
          "1"=>$row["nombre_usuario"],
          "2"=>$row["email"],
          "3"=>$perfil,
          "4"=>($row['condicion']==1)?'<p class="text-center"><span class="label bg-green">ACTIVO</span></p>':
          '<p class="text-center"><span class="label bg-red">BAJA</span></p>',
          "5"=>($row['condicion']==1)?'<p class="text-center"><button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Editar" onclick="mostrarDatosUsuario('.$row['idusuario_suscriptor'].')"><i class="fa fa-pencil icon-color-info"></i></button>'.
            ' <button class="btn  btn-sm btn-default '.$clase.'" data-toggle="tooltip" data-placement="top" title="Desactivar" onclick="desactivar('.$info.')"><i class="fa fa-ban icon-color-danger"></i></button>':
            '<p class="text-center"><button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Editar" onclick="mostrar('.$row['idsuscriptor'].')"><i class="fa fa-pencil icon-color-info"></i></button>'.
            '<button class="btn btn-sm btn-default '.$clase.'" data-toggle="tooltip" data-placement="top" title="Activar" onclick="activar('.$info.')"><i class="fa fa-check icon-color-success"></i></button></p>'
          );
      }
      $results = array(
        "sEcho"=>1, //Información para el datatables
        "iTotalRecords"=>count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
        "aaData"=>$data);
       echo json_encode($results);
    }

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

    public function mostrarController($idusuario_suscriptor){

      $respuesta = UsuarioModels::mostrarModel($idusuario_suscriptor, "usuarios_suscriptores");
      echo json_encode($respuesta);

    }

  }
