<?php
  require_once "../../models/globals.php";
  require_once "../../controllers/globals.php";
  require_once "../../models/parametros.php";

  $ruta=isset($_POST["ruta"])? trim(mb_strtoupper(filter_var($_POST['ruta'],FILTER_SANITIZE_STRING), 'UTF-8')):"";


  switch ($_GET["op"]){
    // case 'listarOpcionesMenu':
    //     $stmt = new Globals();
    //     $stmt -> listarOpcionesMenuController();
    // break;
    case 'getRuta':
        $stmt = new Globals();
        $stmt -> getRutaController($ruta);
    break;


  }
