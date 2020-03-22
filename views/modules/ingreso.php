
<!doctype html>
<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Bienvenidos a Check-Docs</title>
      <link rel="icon" type="image/png" href="views/img/checkdocs-icon.png" />
      <!-- <meta name="author" content="SACSI-Diseño &amp; Desarrollo Web ">
      <meta name="description" content="Sistema de Nombramientos de Personal">
      <meta name="keyworks" content="API, puerto de veracruz, sistema de nombramientos, control de acceso de personal"> -->
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap Core CSS -->
      <link href="assets2/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- page css -->
      <link href="views/css2/pages/login-register-lock.css" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="views/css2/style.css" rel="stylesheet">

      <!-- You can change the theme colors from here -->
      <link href="views/css2/colors/default-dark.css" id="theme" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

    </head>
    <body class="card-no-border">
      <!-- ============================================================== -->
      <!-- Preloader - style you can find in spinners.css -->
      <!-- ============================================================== -->
      <div class="preloader">
          <div class="loader">
              <div class="loader__figure"></div>
              <p class="loader__label">Check-Docs</p>
          </div>
      </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
      <div class="login-register" style="background-image:url(assets2/images/login-register.jpg);">
        <div class="login-box card">
          <div class="card-body">
            <form class="form-horizontal form-material" name="formulario" id="formulario" method="POST">
                <h3 class="box-title m-b-20 text-center">Iniciar Sesión</h3>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input id="email_usuario" name="email_usuario" class="form-control" type="email" required="" placeholder="Email" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" id="pass_usuario" name="pass_usuario" required="" placeholder="Password"> </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-info pull-left p-t-0">
                            <input id="checkbox-signup" type="checkbox" class="filled-in chk-col-light-blue">
                            <label for="checkbox-signup"> Recordar </label>
                        </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Olvidaste password?</a> </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button id="btnIniciar" class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Entrar</button>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                        <div class="social">
                            <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                            <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        Don't have an account? <a href="pages-register.html" class="text-info m-l-5"><b>Sign Up</b></a>
                    </div>
                </div> -->
            </form>
            <form class="form-horizontal" id="recoverform" action="index.html">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <h3>Recuperar Password</h3>
                        <p class="text-muted">Ingresa tu Email y te enviaremos las instrucciones! </p>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Email"> </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Recuperar</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets2/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets2/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets2/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ==============================================================
        // Login and Recover Password
        // ==============================================================
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
    <script type="text/javascript" src="views/js/functions/ingreso.js"></script>

</body>

</html>
