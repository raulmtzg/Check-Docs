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


                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <label>Nombre Proceso:</label>
                  <input type="hidden" name="idproceso" id="idproceso">
                  <input type="text" class="form-control" name="rfc" id="rfc" required autocomplete="off" autofocus maxlength="20">
                </div>
                <!-- <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <label>Contine Subprocesos:</label>
                  <select class="form-control" id="consubprocesos" name="consubprocesos" required>
                    <option value="">--Elije--</option>
                    <option value="0">NO</option>
                    <option value="1">SI</option>
                  </select>
                </div> -->
                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12 btnfrmline">
                  <button class="btn btn-info" onclick="" type="button"><i class="fa fa-plus"></i> Agregar subproceso</button>
                </div>

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
          </div>

          <div class="panel-body ocultar-contenido" id="formulariousuariosuscriptor">
              <form name="formularioAdmin" id="formularioAdmin" method="POST">
                <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                  <label>Nombre completo:</label>
                  <input type="hidden" name="idsuscriptor_usuario" id="idsuscriptor_usuario">
                  <input type="hidden" name="idadmin" id="idadmin">
                  <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" required autocomplete="off" autofocus>
                </div>
                <!-- <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <label>Nombre usuario:</label>
                  <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" required autocomplete="off" >
                </div> -->
                <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                  <label>email:</label>
                  <input type="email" class="form-control" name="email" id="email" required autocomplete="off" >
                </div>
                <!-- <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <label>Password:</label>
                  <input type="text" class="form-control" name="password_usuario" id="password_usuario" required autocomplete="off" >
                </div> -->
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button class="btn btn-primary" type="submit" id="btnGuardarUsuario"><i class="fa fa-save"></i> Guardar</button>
                  <button class="btn btn-danger" onclick="mostrarformUsuario(false)" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                </div>
                <div class="row">
                  <br>
                  <div class="col-lg-12">
                    <div id="fail-labelAdmin" class="alert alert-warning ocultar-contenido"></div>
                    <div id="exito-labelAdmin" class="alert alert-success ocultar-contenido"></div>
                  </div>
                </div>
              </form>
          </div>


          <div class="panel-body table-responsive" id="listadoregistros">
              <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <th># Id</th>
                  <th>Empresa</th>
                  <th>RFC</th>
                  <th>Estado</th>
                  <th>Opciones</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <th># Id</th>
                  <th>Empresa</th>
                  <th>RFC</th>
                  <th>Estado</th>
                  <th>Opciones</th>
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
 <script type="text/javascript" src="views/js/procesos.js"></script>
  </body>
</html>
