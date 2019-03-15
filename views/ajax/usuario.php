<?php
  require_once "../../models/usuario.php";
  require_once "../../controllers/usuario.php";
  require_once "../../models/parametros.php";

  $idusuario = isset($_POST["idusuario"])? trim(filter_var($_POST['idusuario'], FILTER_SANITIZE_NUMBER_INT)):"";
  $nombre_completo = isset($_POST["nombre_completo"])? trim(strtoupper(filter_var($_POST['nombre_completo'], FILTER_SANITIZE_STRING))):"";
  $nombre_usuario = isset($_POST["nombre_usuario"])? trim(strtoupper(filter_var($_POST['nombre_usuario'], FILTER_SANITIZE_STRING))):"";
  $perfil = isset($_POST["perfil"])? trim(filter_var($_POST['perfil'], FILTER_SANITIZE_NUMBER_INT)):"";
  $email=isset($_POST["email"])? trim(filter_var($_POST['email'], FILTER_SANITIZE_STRING)):"";


  switch ($_GET["op"]){
    case 'guardaryeditar':
      		if (empty($idusuario)){
            $stmt = new Usuario();
            $stmt -> insertarController($nombre_completo, $nombre_usuario, $perfil, $email);
            break;
      		}
      		else {
            $stmt = new Usuario();
            $stmt -> editarController($idusuario, $nombre_completo, $nombre_usuario, $perfil, $email);
            break;

      		}
	        break;
  	case 'listar':
          $stmt = new AdminPanel();
          $stmt -> listarController();
          break;
    case 'mostrar':
          $stmt = new AdminPanel();
          $stmt -> mostrarController($idsuscriptor);
          break;
    case 'desactivar':
          $stmt = new AdminPanel();
          $stmt -> desactivarController($idsuscriptor);
       		break;
    case 'activar':
          $stmt = new AdminPanel();
          $stmt -> activarController($idsuscriptor);
       		break;
    case 'guardaryeditarAdmin':
      		if (empty($idadmin)){
            $stmt = new AdminPanel();
            $stmt -> insertarAdminController($idadmin, $idsuscriptor_usuario, $nombre_completo, $email);
            break;
      		}
      		else {
            $stmt = new AdminPanel();
            $stmt -> editarAdminController($idadmin, $nombre_completo, $email);
            break;

      		}
	        break;
    case 'mostrarAdmin':
          $stmt = new AdminPanel();
          $stmt -> mostrarAdminController($idsuscriptor);
          break;
    case 'crearArchivo':
          $stmt = new AdminPanel();
          $stmt -> crearArchivoController();
          break;

  }
