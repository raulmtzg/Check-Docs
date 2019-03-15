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
                <h1 class="box-title">Crear usuario <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button></h1>
              <div class="box-tools pull-right">
              </div>
          </div>

          <div class="panel-body ocultar-contenido" id="formularioregistros">
              <form name="formulario" id="formulario" method="POST">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label>NOMBRE COMPLETO:</label>
                  <input type="hidden" name="idusuario" id="idusuario">
                  <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" placeholder="p.ej. JUAN PÉREZ FLORES" required autocomplete="off" autofocus maxlength="60">
                </div>

                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <label>NOMBRE USUARIO:</label>
                  <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" maxlength="15" placeholder="p.ej. JPEREZ" autocomplete="off" required>
                </div>

                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <label>PERFIL:</label>
                  <select id="perfil" name="perfil" class="form-control " required>
                    <option value="">-- Elije --</option>
                    <option value="2">ADMINISTRADOR</option>
                    <option value="3">USUARIO ESTANDAR</option>
                  </select>
                </div>

                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <label>EMAIL:</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="p.ej. micorreo@correo.com" autocomplete="off" required>
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


<?php
  include "footer.php";
 ?>
 <script type="text/javascript" src="views/js/usuario.js"></script>
  </body>
</html>
