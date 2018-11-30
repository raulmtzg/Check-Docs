<?php
  require_once "../../models/admin_inicio.php";
  require_once "../../controllers/admin_inicio.php";
  require_once "../../models/parametros.php";

  //$idsuscriptor=isset($_POST["idsuscriptor"])? trim(filter_var($_POST['idsuscriptor'], FILTER_SANITIZE_NUMBER_INT)):"";
  $encabezado=isset($_POST["encabezado"])? trim(mb_strtoupper(filter_var($_POST['encabezado'],FILTER_SANITIZE_STRING), 'UTF-8')):"";
  $descripcion=isset($_POST["descripcion"])? trim(mb_strtoupper(filter_var($_POST['descripcion'],FILTER_SANITIZE_STRING), 'UTF-8')):"";



  switch ($_GET["op"]){
    case 'editarInicio':
          $stmt = new AdminInicio();
          $stmt -> editarController($encabezado, $descripcion);
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
