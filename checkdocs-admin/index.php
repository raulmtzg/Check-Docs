<?php

#=========== MODELOS ====================
  //Ingreso al sistema
  require_once "models/enlaces.php";
  require_once "models/ingreso.php";

  //Catalogos


  //Permisos


  //Administracion


#=============== CONTROLADORES ==================
  //Ingreso al sistema
  require_once "controllers/template.php";
  require_once "controllers/enlaces.php";
  require_once "controllers/ingreso.php";

  //Catalogos


  //Permisos


  //Administracion



  $template = new TemplateController();
  $template -> template();
