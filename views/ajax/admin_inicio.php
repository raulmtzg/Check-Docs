<?php
  require_once "../../models/admin_inicio.php";
  require_once "../../controllers/admin_inicio.php";
  require_once "../../models/parametros.php";

  //$idsuscriptor=isset($_POST["idsuscriptor"])? trim(filter_var($_POST['idsuscriptor'], FILTER_SANITIZE_NUMBER_INT)):"";
  $encabezado=isset($_POST["encabezado"])? trim(strtoupper(filter_var($_POST['encabezado'], FILTER_SANITIZE_STRING))):"";
  $descripcion=isset($_POST["descripcion"])? trim(strtoupper(filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING))):"";



  switch ($_GET["op"]){
    case 'guardaryeditar':
      		if (empty($idsuscriptor)){
            $stmt = new AdminInicio();
            $stmt -> insertarController($encabezado, $descripcion);
            break;
      		}
      		else {
            $stmt = new AdminInicio();
            $stmt -> editarController($idsuscriptor, $rfc, $nombre_empresa, $cantidad_admin, $telefono, $limite_usuarios, $capacidad_almacenamiento);
            break;

      		}
	        break;

    case 'mostrar':
          $stmt = new AdminInicio();
          $stmt -> mostrarController();
          break;

    case 'cambiarLogo':
          $stmt = new AdminInicio();
          $stmt -> cambiarLogoController($_FILES['logotipo']);
          break;


  }
