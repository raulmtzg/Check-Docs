<?php
   //session_start();
  if(!$_SESSION['validar']){
    header("location:ingreso");
    exit();
  }else{
    include "header.php";
    include "menu.php";
  }

  // include "header.php";
  // include "menu.php";
 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 id="encabezado" class="box-title ">Bienvenido</h1>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-offset-2 col-lg-8 text-center">
                <h3 id="descripcion"></h3>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-offset-3 col-lg-6 ">
                <img id="logoempresa" src="views/img/loading.gif" class="img img-responsive center-block" alt="">
              </div>
            </div>

          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

  <?php
    include "footer.php";
  ?>
  <script src="views/js/inicio.js"></script>
  </body>
