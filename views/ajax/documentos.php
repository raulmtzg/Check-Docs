<?php
  require_once "../../models/documentos.php";
  require_once "../../controllers/documentos.php";
  require_once "../../models/parametros.php";

  $ruta=isset($_POST["ruta"])? trim(mb_strtoupper(filter_var($_POST['ruta'],FILTER_SANITIZE_STRING), 'UTF-8')):"";
  $idsubproceso=isset($_POST["idsubproceso"])? trim(filter_var($_POST['idsubproceso'], FILTER_SANITIZE_NUMBER_INT)):"";
  $iddocumento=isset($_POST["iddocumento"])? trim(filter_var($_POST['iddocumento'], FILTER_SANITIZE_NUMBER_INT)):"";
  $codigodocumento=isset($_POST["codigodocumento"])? trim(mb_strtoupper(filter_var($_POST['codigodocumento'],FILTER_SANITIZE_STRING), 'UTF-8')):"";
  $nombredocumento=isset($_POST["nombredocumento"])? trim(mb_strtoupper(filter_var($_POST['nombredocumento'],FILTER_SANITIZE_STRING), 'UTF-8')):"";
  $responsable=isset($_POST["responsable"])? trim(mb_strtoupper(filter_var($_POST['responsable'],FILTER_SANITIZE_STRING), 'UTF-8')):"";
  $fecharevision=isset($_POST["fecharevision"])? trim(mb_strtoupper(filter_var($_POST['fecharevision'],FILTER_SANITIZE_STRING), 'UTF-8')):"";
  $version=isset($_POST["version"])? trim(mb_strtoupper(filter_var($_POST['version'],FILTER_SANITIZE_STRING), 'UTF-8')):"";
  $tipodocumento=isset($_POST["tipodocumento"])? trim(mb_strtoupper(filter_var($_POST['tipodocumento'],FILTER_SANITIZE_STRING), 'UTF-8')):"";



  switch ($_GET["op"]){

    case 'getRuta':
        $stmt = new Documentos();
        $stmt -> getRutaController($ruta);
    break;
    case 'guardaryeditar':
    		if (empty($iddocumento)){
          $stmt = new Documentos();
          $stmt -> insertarController($idsubproceso, $codigodocumento, $nombredocumento, $responsable, $fecharevision, $version, $tipodocumento, $_FILES['archivo']);
    		}
    		else {
          $stmt = new Documentos();
          $stmt -> editarController($idcentrocosto, $centroCosto, $descripcion);
    		}
    break;


  }
