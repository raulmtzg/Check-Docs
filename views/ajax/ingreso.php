<?php
  require_once "../../models/ingreso.php";
  require_once "../../controllers/ingreso.php";
  require_once "../../models/parametros.php";


  $email_usuario=isset($_POST["email_usuario"])? trim(filter_var($_POST['email_usuario'], FILTER_SANITIZE_STRING)):"";
  $pass_usuario=isset($_POST["pass_usuario"])? trim(filter_var($_POST['pass_usuario'], FILTER_SANITIZE_STRING)):"";


  switch ($_GET["op"]){
    case 'iniciarSesion':
        $stmt = new Ingreso();
        $stmt -> iniciarSesionController($email_usuario, $pass_usuario);
    break;


  }
