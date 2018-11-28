<?php
  session_start();
  //Limpiamos las variables de sesión
  session_unset();
  //Destruìmos la sesión
  session_destroy();

  header("location:ingreso");
