<?php
session_start();
if(isset($_SESSION['validar'])){

  header("location:inicio");

}
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Bienvenidos - CheckDocs</title>
      <link rel="icon" type="image/png" href="views/img/checkdocs-icon.png" />
      <!-- <meta name="author" content="SACSI-Diseño &amp; Desarrollo Web ">
      <meta name="description" content="Sistema de Nombramientos de Personal">
      <meta name="keyworks" content="API, puerto de veracruz, sistema de nombramientos, control de acceso de personal"> -->
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
      <!-- Animate -->
      <link rel="stylesheet" href="../assets/animate/css/animate.min.css">
      <!-- Login Personalizado  -->
      <link rel="stylesheet" href="views/css/custom-login.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.css">

      <!-- fuentes utilizadas en el sitio web -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans" rel="stylesheet">

      <!-- hoja de estilos propio o personalizada -->
      <link rel="stylesheet" href="views/css/main-login.css">

      <!-- SWEET ALERT -->
      <link rel="stylesheet" href="../assets/sweetalert/sweetalert.css">

    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="contenedor-login clearfix">
          <div class="hero-login">
            <div class="contenedor-login">
              <h1>Administración</h1>
              <h2 class="titulo">Check-Docs</h2>
            </div>
          </div><!-- .hero-login -->
          <div class="form-login clearfix">
            <div class="form-title">
              <h2 class="titulo">Check-Docs</h2>
            </div>
            <div class="form-contenedor">
              <!-- <div class="form-caption">
                <h3>Iniciar Sesión</h3>
              </div> -->
              <div class="form-iniciar">
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <div id="wrapper">
                    <div id="login" class="animate form">
                      <section class="login_content">
                        <form name="formulario" id="formulario" method="POST">
                          <h1>Iniciar sesión</h1>
                          <div>
                            <input type="email" id="email_usuario" name="email_usuario" class="form-control"   placeholder="Email" required="required" autocomplete="off" />
                          </div>
                          <div>
                              <input type="password" id="pass_usuario" name="pass_usuario" class="form-control" autocomplete="off" placeholder="Password" required="required" />
                          </div>

                          <div class="logear-usuario">
                              <button type="submit" class="btn btn-primary" id="btnIniciar" style="width: 150px"><i class="fa fa-sign-in"></i> Iniciar Sesión</button>
                              <a class="reset_pass" href="#toregister">Olvidaste tu password?</a>
                          </div>
                          <div class="clearfix"></div>
                          <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                            <div>
                              <!-- <h1>LOGO EMPRESA</h1> -->
                              <!-- <div class="contenedor-logo">
                                <img src="img/logo.jpg" alt="">
                              </div> -->
                              <p>©2018 Todos los derechos reservados. <a href="#" target="_blank">Check-Docs</a></p>
                            </div>
                          </div>
                          <div id="mensaje" class="alert alert-warning ocultar-contenido"> <strong>Atención! </strong>El usuario no existe</div>

                        </form><!-- .form -->
                      </section><!-- .section -->
                    </div>
                    <div id="register" class="animate form">
                      <section class="login_content">
                        <form id="frmRecuperarPassword" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="login">
                          <h3>Recuperar password</h3>
                          <br>
                          <div>
                            <input type="email" id="email_recuperar"name="email_recuperar" class="form-control" placeholder="Email" required="required"/>
                          </div>
                          <div>
                            <button type="submit" class="btn btn-primary submit" style="width: 150px"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Enviar</button>
                          </div>
                          <div class="clearfix"></div>
                          <div class="separator">
                            <p class="change_link">Recordaste tu password?
                                <a href="#tologin" class="to_register"> Iniciar sesión </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                               <!-- <h1>LOGO EMPRESA</h1> -->
                              <p>©2018 Todos los derechos reservados. <a href="#">Check-Docs</a></p>
                            </div>
                          </div>
                        </form><!-- .form -->
                      </section><!-- .section -->
                    </div><!-- .register -->
                  </div><!-- .wrapper -->
              </div><!-- .form-iniciar -->
            </div><!-- .form-contenedor -->
          </div><!-- .form-login -->
        </div><!-- .contenedor-login -->

        <!-- jQuery 3.1.1 -->
        <script src="../assets/jquery/js/jquery-3.1.1.min.js"></script>

        <!-- <script src="js/plugins.js"></script> -->

        <!-- SWEET ALERT  -->
        <script src="../assets/sweetalert/sweetalert.min.js"></script>

        <script type="text/javascript" src="views/js/ingreso.js"></script>

    </body>
</html>
