<?php
  session_start();
  if(!$_SESSION['validar']){
    header("location:ingreso");
    exit();
  }else{
    include "header.php";
    include "menu.php";
  }

 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
                <h1 class="box-title">Tipo Documento <button class="btn btn-success" id="btnNuevoDocto" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button></h1>
              <div class="box-tools pull-right">
              </div>
          </div>

          <div class="panel-body ocultar-contenido" id="formularioregistros">
              <form name="formulario" id="formulario" method="POST">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label>Descripción:</label>
                  <input type="text" name="idtipodocumento" id="idtipodocumento">
                  <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="" required autocomplete="off" autofocus>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6 btnfrmline">
                  <button class="btn btn-primary " type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                  <button class="btn btn-danger " onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                </div>
                <div class="row">
                  <br>
                  <div class="col-lg-12">
                    <div id="fail-label" class="alert alert-warning ocultar-contenido"></div>
                    <div id="exito-label" class="alert alert-success ocultar-contenido"></div>
                  </div>
                </div>
              </form>

          </div>

          <div class="panel-body table-responsive" id="listadoregistros">
              <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <!-- <th class="text-center">FECHA ALTA</th>                   -->
                  <th>DESCRIPCION</th>
                  <th class="text-center">ESTADO</th>
                  <th class="text-center">OPCIONES</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <!-- <th class="text-center">FECHA ALTA</th> -->
                  <th>DESCRIPCION</th>
                  <th class="text-center">ESTADO</th>
                  <th class="text-center">OPCIONES</th>
                </tfoot>
              </table>
          </div>

        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php
  include "footer.php";
 ?>
 <script type="text/javascript" src="views/js/tipo_documento.js"></script>
  </body>
</html>
