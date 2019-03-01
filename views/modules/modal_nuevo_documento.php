<div class="modal fade" id="nuevo-documento" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Actualizar password usuario</h4>
            </div>
            <div class="modal-body">
              <form name="formularioPass" id="formularioPass" method="post">
                <input type="hidden" name="idusuarioPass" id="idusuarioPass">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label for="lbl-nuevoPassword">Nuevo Password</label>
                      <input type="password" class="form-control" name="passwordNuevo" id="passwordNuevo"  required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label for="lbl-confirmarPass">Confirmar Password</label>
                      <input type="password" class="form-control" name="confirmarPass" id="confirmarPass" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <br>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="fail-labelPass" class="alert alert-warning ocultar-contenido"></div>
                    <div id="exito-labelPass" class="alert alert-success ocultar-contenido"></div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">

              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button class="btn btn-primary" type="button" id="btnGuardarPass" onclick="actualizarPassword()"><i class="fa fa-save"></i> Guardar</button>
              <!-- <button class="btn btn-primary" type="submit" id="btnGuardarPass"><i class="fa fa-save"></i> Guardar</button> -->


            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
