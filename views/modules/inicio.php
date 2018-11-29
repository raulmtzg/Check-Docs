<?php
   session_start();
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
            <h1 class="box-title">Título de página de inicio</h1>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-offset-2 col-lg-8">
                <h3>Descripcion de la pagina de inicio</h3>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-offset-2 col-lg-8">
                <img src="views/img/sacsi/logo_sacsi.jpg" class="img img-responsive" alt="">
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
  </body>
