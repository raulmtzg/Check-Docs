<?php

#=========== MODELOS ====================
  // Configuraciones Globales
  require_once "models/menu_procesos.php";
  //Ingreso al sistema
  require_once "models/enlaces.php";
  require_once "models/ingreso.php";

  //Usuarios
  require_once "models/usuario.php";

  //Tipos Documento
  require_once "models/tipo_documento.php";

  //Permisos


  //Administracion


#=============== CONTROLADORES ==================
  // Configuraciones Globales
  require_once "controllers/menu_procesos.php";

  //Ingreso al sistema
  require_once "controllers/template.php";
  require_once "controllers/enlaces.php";
  require_once "controllers/ingreso.php";

  //Usuarios
  require_once "controllers/usuario.php";

  //Tipos Documento
  require_once "controllers/tipo_documento.php";


  //Permisos


  //Administracion



  $template = new TemplateController();
  $template -> template();
