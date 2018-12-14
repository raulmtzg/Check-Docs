<?php
  require_once "../../models/procesos.php";
  require_once "../../controllers/procesos.php";
  require_once "../../models/parametros.php";

  $idproceso=isset($_POST["idproceso"])? trim(filter_var($_POST['idproceso'], FILTER_SANITIZE_NUMBER_INT)):"";
  $proceso=isset($_POST["proceso"])? trim(mb_strtoupper(filter_var($_POST['proceso'],FILTER_SANITIZE_STRING), 'UTF-8')):"";
  //$descripcion=isset($_POST["descripcion"])? trim(mb_strtoupper(filter_var($_POST['descripcion'],FILTER_SANITIZE_STRING), 'UTF-8')):"";
  $condicion=isset($_POST["condicion"])? trim(filter_var($_POST['condicion'], FILTER_SANITIZE_NUMBER_INT)):"";

  $idsubproceso=isset($_POST["idsubproceso"])? trim(filter_var($_POST['idsubproceso'], FILTER_SANITIZE_NUMBER_INT)):"";
  $subprocesomod=isset($_POST["subprocesomod"])? trim(mb_strtoupper(filter_var($_POST['subprocesomod'],FILTER_SANITIZE_STRING), 'UTF-8')):"";
  $idprocesomod=isset($_POST["idprocesomod"])? trim(filter_var($_POST['idprocesomod'], FILTER_SANITIZE_NUMBER_INT)):"";


  switch ($_GET["op"]){
    case 'guardaryeditar':
      		if (empty($idproceso)){
            $listaSubprocesos= json_decode($_POST['array']);
            $stmt = new Procesos();
            $stmt -> insertarController($proceso, $listaSubprocesos);
      		}
      		else {
            $listaSubprocesos= json_decode($_POST['array']);
            //var_dump($listaSubprocesos);
             $stmt = new Procesos();
             $stmt -> editarController($idproceso, $proceso, $listaSubprocesos);
      		}
	        break;
    case 'listar':
        $stmt = new Procesos();
        $stmt -> listarProcesosController();
        break;
    case 'traerSubprocesos':
        $stmt = new Procesos();
        $stmt -> mostrarSubprocesosController($idproceso, $condicion);
        break;
    case 'actualizarSubproceso':
        $stmt = new Procesos();
        $stmt -> actualizarSubprocesoController($idsubproceso, $subprocesomod, $idprocesomod);
        break;
    case 'desactivarSub':
      $stmt = new Procesos();
      $stmt -> desactivarSubController($idsubproceso, $idproceso);
   		break;
    case 'activarSub':
      $stmt = new Procesos();
      $stmt -> activarSubController($idsubproceso, $idproceso);
      break;
    case 'eliminarSub':
      $stmt = new Procesos();
      $stmt -> eliminarSubController($idsubproceso, $idproceso);
      break;


  }
