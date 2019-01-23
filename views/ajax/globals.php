<?php
  require_once "../../models/globals.php";
  require_once "../../controllers/globals.php";
  require_once "../../models/parametros.php";


  switch ($_GET["op"]){
    case 'listarOpcionesMenu':
        $stmt = new Globals();
        $stmt -> listarOpcionesMenuController();
    break;


  }
