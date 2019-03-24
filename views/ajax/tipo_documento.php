<?php
  require_once "../../models/tipo_documento.php";
  require_once "../../controllers/tipo_documento.php";
  require_once "../../models/parametros.php";

  $idtipodocumento = isset($_POST["idtipodocumento"])? trim(filter_var($_POST['idtipodocumento'], FILTER_SANITIZE_NUMBER_INT)):"";
  $descripcion = isset($_POST["descripcion"])? trim(strtoupper(filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING))):"";


  switch ($_GET["op"]){
    case 'guardaryeditar':
      		if (empty($idtipodocumento)){
            $stmt = new TipoDocumento();
            $stmt -> insertarController($descripcion);
            break;
      		}
      		else {
            $stmt = new TipoDocumento();
            $stmt -> editarController($idtipodocumento, $descripcion);
            break;

      		}
	        break;
  	case 'listar':
          $stmt = new TipoDocumento();
          $stmt -> listarController();
          break;
    case 'mostrar':
          $stmt = new TipoDocumento();
          $stmt -> mostrarController($idtipodocumento);
          break;
    case 'desactivar':
          $stmt = new TipoDocumento();
          $stmt -> desactivarController($idtipodocumento);
       		break;
    case 'activar':
          $stmt = new TipoDocumento();
          $stmt -> activarController($idtipodocumento);
       		break;

  }
