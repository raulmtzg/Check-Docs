<?php
   //session_start();
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
            <h1 class="box-title">Configuración de página de inicio</h1>
          </div>

          <div class="panel-body">
            <div class="row">
              <div class="col-lg-7 col-sm-7 col-sm-12 col-xs-12">
                <form name="formulario" id="formulario" method="POST">
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Título en página de incio:</label>
                    <!-- <input type="hidden" name="idsuscriptor" id="idsuscriptor"> -->
                    <input type="text" class="form-control" name="encabezado" id="encabezado" required autocomplete="off" autofocus>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Descipción de inicio:</label>
                    <textarea class="form-control" rows="10" name="descripcion" id="descripcion"></textarea>
                    <!-- <textarea  rows="8" class="form-control" name="descripcion" id="descripcion" required autocomplete="off" ></texarea> -->
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                    <!-- <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button> -->
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
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading ">
                      <h3 class="panel-title">
                        <span class="text-izq">Logotipo empresa.</span>
                        <small class="pull-right" >
                          <button
                              type="button"
                              name="btnLogo"
                              class="btn btn-primary btn-xs"
                              data-toggle="modal"
                              data-target="#myModal">
                                Cambiar logo
                          </button>
                        </small>
                      </h3>
                    </div>
                    <div class="panel-body">
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img id="logoempresa" src="views/img/loading.gif" class="img-responsive img-rounded center-block" alt="Logotipo">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-lg-12 col-md-12">
                  <form name="formularioLogo" id="formularioLogo" method="POST">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Imagen descatada en página de inicio</h3>
                      </div>
                      <div class="panel-body">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <h3>imagen</h3>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <label>Imagen de inicio:</label>
                          <input type="file" name="imagendestacada" class="btn btn-default" id="imagendestacada" >
                        </div>
                      </div>
                    </div>
                  </form>
                </div> -->

              </div>
            </div>

        </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- ===================================================================
      Modal para subir Logotipo
========================================================================-->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form name="formularioLogo" id="formularioLogo" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cambiar Logo Empresa</h4>
        </div>
        <div class="modal-body">
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label>Cambiar logotipo:</label>
            <input type="file" name="logotipo" class="btn btn-default" id="logotipo" required>
          </div>
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p>Solo imagenes tipo: JPG, JPEG y PNG. Con un tamaño máximo de 2MB</p>
          </div>
          <br>
          <div class="col-lg-12">
            <div id="fail-logo" class="alert alert-warning ocultar-contenido"></div>
            <div id="exito-logo" class="alert alert-success ocultar-contenido"></div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary" type="submit" id="btnCambiarLogo"><i class="fa fa-save"></i> Guardar</button>
          <!-- <button type="button" class="btn btn-primary">Guardar</button> -->
        </div>



      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
  include "footer.php";
 ?>
  <script type="text/javascript" src="views/js/admin_inicio.js"></script>
  </body>
