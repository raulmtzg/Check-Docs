<?php
  require_once "../../models/usuario.php";
  require_once "../../controllers/usuario.php";
  require_once "../../models/parametros.php";

  $idusuario_suscriptor = isset($_POST["idusuario_suscriptor"])? trim(filter_var($_POST['idusuario_suscriptor'], FILTER_SANITIZE_NUMBER_INT)):"";
  $nombre_completo = isset($_POST["nombre_completo"])? trim(strtoupper(filter_var($_POST['nombre_completo'], FILTER_SANITIZE_STRING))):"";
  $nombre_usuario = isset($_POST["nombre_usuario"])? trim(strtoupper(filter_var($_POST['nombre_usuario'], FILTER_SANITIZE_STRING))):"";
  $perfil = isset($_POST["perfil"])? trim(filter_var($_POST['perfil'], FILTER_SANITIZE_NUMBER_INT)):"";
  $email=isset($_POST["email"])? trim(filter_var($_POST['email'], FILTER_SANITIZE_STRING)):"";


  switch ($_GET["op"]){
    case 'guardaryeditar':
      		if (empty($idusuario_suscriptor)){
            $stmt = new Usuario();
            $stmt -> insertarController($nombre_completo, $nombre_usuario, $perfil, $email);
            break;
      		}
      		else {
            $stmt = new Usuario();
            $stmt -> editarController($idusuario_suscriptor, $nombre_completo, $nombre_usuario, $perfil, $email);
            break;

      		}
	        break;
  	case 'listar':
          $stmt = new Usuario();
          $stmt -> listarController();
          break;
    case 'mostrar':
          $stmt = new Usuario();
          $stmt -> mostrarController($idusuario_suscriptor);
          break;
    case 'desactivar':
          $stmt = new Usuario();
          $stmt -> desactivarController($idusuario_suscriptor);
       		break;
    case 'activar':
          $stmt = new Usuario();
          $stmt -> activarController($idusuario_suscriptor);
       		break;

  }
