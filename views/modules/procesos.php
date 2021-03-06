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
                <h1 class="box-title">Crear Procesos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button></h1>
              <div class="box-tools pull-right">
              </div>
          </div>

          <div class="panel-body ocultar-contenido" id="formularioregistros">
              <form name="formulario" id="formulario" method="POST">
                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <label>PROCESO:</label>
                  <input type="hidden" name="idproceso" id="idproceso">
                  <input type="text" class="form-control" name="proceso" id="proceso" required autocomplete="off" autofocus maxlength="20">
                </div>


                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <label>SUBPROCESO:</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="subproceso" id="subproceso" onkeypress="insertarSubproceso(event)">
                    <span class="input-group-btn">
                      <button class="btn btn-info" id="subproceso" onclick="agregarSubproceso()" type="button" >
                        <i class="fa fa-plus"></i> Agregar
                      </button>
                    </span>
                  </div>
                  <!-- <input type="text" class="form-control" name="subproceso" id="subproceso" onkeypress="insertarSubproceso(event)" autocomplete="off" autofocus maxlength="20"> -->
                </div>

                <!-- <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12 btnfrmline">
                  <button class="btn btn-info" onclick="agregarSubproceso()" type="button"><i class="fa fa-plus"></i> Agregar </button>
                </div> -->

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                  <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                </div>
                <div class="row">
                  <br>
                  <div class="col-lg-12">
                    <div id="fail-label" class="alert alert-warning ocultar-contenido"></div>
                    <div id="exito-label" class="alert alert-success ocultar-contenido"></div>
                  </div>
                </div>
              </form>

              <div id="listado-subprocesos" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                <table id="table-subprocesos" class="table table-condensed table-striped">
                  <thead>
                    <tr>
                      <th># POSICIÓN</th>
                      <th class="text-center">SUBPROCESO</th>
                      <th class="text-center">ESTADO</th>
                      <th class="text-center col-sm-3">OPCIONES</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr id="filaCero" class="default sin-partidas">
                      <th class="text-center" colspan="4"><span class="sinDatos">No existen subprocesos<span> </th>
                    </tr>
                  </tbody>
                </table>
              </div>

          </div>




          <div class="panel-body table-responsive" id="listadoregistros">
              <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <!-- <th class="text-center">FECHA ALTA</th>                   -->
                  <th>PROCESO</th>
                  <th class="text-center">ESTADO</th>
                  <th class="text-center">OPCIONES</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <!-- <th class="text-center">FECHA ALTA</th> -->
                  <th>PROCESO</th>
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

<!-- Modal para editar subproceso -->
<div class="modal fade" id="modalEditarSubproceso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Subproceso</h4>
      </div>
      <div class="modal-body">
        <form name="formSubproceso" id="formSubproceso" method="POST">
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label>SUBPROCESO:</label>
            <input type="hidden" name="idsubproceso" id="idsubproceso">
            <input type="hidden" name="idprocesomod" id="idprocesomod">
            <input type="text" class="form-control" name="subprocesomod" id="subprocesomod" required autocomplete="off">
          </div>
          <div class="form-group col-md-12 text-right ">
            <button class="btn btn-primary" type="submit" id="btnGuardarSub"><i class="fa fa-save"></i> Guardar</button>
            <button class="btn btn-danger" data-dismiss="modal" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
          </div>
          <div class="row">
            <br>
            <div class="col-lg-12">
              <div id="fail-editarSubproceso" class="alert alert-warning ocultar-contenido"></div>
              <div id="exito-editarSubproceso" class="alert alert-success ocultar-contenido"></div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<?php
  include "footer.php";
 ?>
 <script type="text/javascript" src="views/js/procesos.js"></script>
  </body>
</html>
