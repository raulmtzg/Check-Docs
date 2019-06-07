<?php
    include "./views/modules/header.php";
    include "./views/modules/menu.php";
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h1 class="box-title"> LISTADO DE DOCUMENTOS</h1>

            </div>

            <div class="panel-body ocultar-contenido"  id="formularioregistros">
              <?php
                require 'views/modules/documento_nuevo.php';
              ?>
            </div>

            <div class="panel-body table-responsive" id="listadoregistros">
              <ol id="ruta-documento" class="breadcrumb ">
                <!-- <li>Sistemas</li>
                <li>Procedimientos</li>
                <li class="active"><a id="btnNuevoDocto" href="javascript:mostrarform(true);"><i class="fa fa-plus-circle"></i> Nuevo</a></li> -->
              </ol>
              <div id="listadoDocumentos">
                
              </div>

                <div class="relleno">
                  <span>&nbsp;</span>
                </div>
            </div>

          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <?php
    include "./views/modules/footer.php";
   ?>
   <script src="./views/js/documentos.js"></script>
    </body>
