<?php
  require_once "../../models/actualizar_password.php";
  require_once "../../controllers/actualizar_password.php";
  require_once "../../models/parametros.php";


  $email_usuario=isset($_POST["email_usuario"])? trim(filter_var($_POST['email_usuario'], FILTER_SANITIZE_STRING)):"";
  $pass_usuario=isset($_POST["pass_usuario"])? trim(filter_var($_POST['pass_usuario'], FILTER_SANITIZE_STRING)):"";
  $pass_nuevo=isset($_POST["pass_nuevo"])? trim(filter_var($_POST['pass_nuevo'], FILTER_SANITIZE_STRING)):"";


  switch ($_GET["op"]){
    case 'actualizar_password':
        $stmt = new ActualizarPassword();
        $stmt -> actualizarPasswordController($email_usuario, $pass_usuario, $pass_nuevo);
    break;


  }
