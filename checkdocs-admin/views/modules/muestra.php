<?php
  // session_start();
  // if(!$_SESSION['validar']){
  //   header("location:ingreso");
  //   exit();
  // }else{
  //   include "header.php";
  //   include "menu.php";
  // }

  include "header.php";
  include "menu.php";
 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Nuevo</a></li>
              <li><a href="#"><i class="fa fa-folder-o" aria-hidden="true"></i> Procedimientos</a></li>
              <li><a href="#"><i class="fa fa-folder-o" aria-hidden="true"></i> Recursos Humanos</a></li>
              <li><a href="#"><i class="fa fa-folder-o" aria-hidden="true"></i> Operaciones</a></li>
              <li><a href="#"><i class="fa fa-folder-o" aria-hidden="true"></i> Mantenimiento</a></li>
              <li class="active"><i class="fa fa-folder-open-o" aria-hidden="true"></i> Gerencia</li>
            </ol>
            <h1 class="box-title">Tablero</h1>
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
