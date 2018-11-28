<?php
  require_once "../../models/admin_panel.php";
  require_once "../../controllers/admin_panel.php";
  require_once "../../models/parametros.php";

  $idsuscriptor=isset($_POST["idsuscriptor"])? trim(filter_var($_POST['idsuscriptor'], FILTER_SANITIZE_NUMBER_INT)):"";
  $rfc=isset($_POST["rfc"])? trim(strtoupper(filter_var($_POST['rfc'], FILTER_SANITIZE_STRING))):"";
  $nombre_empresa=isset($_POST["nombre_empresa"])? trim(strtoupper(filter_var($_POST['nombre_empresa'], FILTER_SANITIZE_STRING))):"";
  $cantidad_admin=isset($_POST["cantidad_admin"])? trim(strtoupper(filter_var($_POST['cantidad_admin'], FILTER_SANITIZE_STRING))):"";
  $telefono=isset($_POST["telefono"])? trim(strtoupper(filter_var($_POST['telefono'], FILTER_SANITIZE_STRING))):"";
  $limite_usuarios=isset($_POST["limite_usuarios"])? trim(strtoupper(filter_var($_POST['limite_usuarios'], FILTER_SANITIZE_NUMBER_INT))):"";
  $capacidad_almacenamiento=isset($_POST["capacidad_almacenamiento"])? trim(strtoupper(filter_var($_POST['capacidad_almacenamiento'], FILTER_SANITIZE_NUMBER_INT))):"";
  $carpeta=isset($_POST["carpeta"])? trim(strtolower(filter_var($_POST['carpeta'], FILTER_SANITIZE_STRING))):"";

  $idsuscriptor_usuario=isset($_POST["idsuscriptor_usuario"])? trim(filter_var($_POST['idsuscriptor_usuario'], FILTER_SANITIZE_NUMBER_INT)):"";
  $idadmin=isset($_POST["idadmin"])? trim(filter_var($_POST['idadmin'], FILTER_SANITIZE_NUMBER_INT)):"";
  $nombre_completo=isset($_POST["nombre_completo"])? trim(strtoupper(filter_var($_POST['nombre_completo'], FILTER_SANITIZE_STRING))):"";
  $email=isset($_POST["email"])? trim(filter_var($_POST['email'], FILTER_SANITIZE_STRING)):"";


  switch ($_GET["op"]){
    case 'guardaryeditar':
      		if (empty($idsuscriptor)){
            $stmt = new AdminPanel();
            $stmt -> insertarController($rfc, $nombre_empresa, $cantidad_admin, $telefono, $limite_usuarios, $capacidad_almacenamiento,$carpeta);
            break;
      		}
      		else {
            $stmt = new AdminPanel();
            $stmt -> editarController($idsuscriptor, $rfc, $nombre_empresa, $cantidad_admin, $telefono, $limite_usuarios, $capacidad_almacenamiento);
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
