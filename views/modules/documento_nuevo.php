
<form name="formulario" id="formulario" method="POST">
  <div class="row">
    <div class="col-lg-3">
      <label>Código</label>
      <input type="text" class="form-control" name="nCodigo" id="nCodigo" maxlength="15" placeholder="" autofocus required autocomplete="off">
    </div>
    <div class=" col-lg-5 col-md-5 col-sm-5 col-xs-12">
      <label>Nombre documento:</label>
      <input type="text" class="form-control" name="nNombreDocumento" id="nNombreDocumento" maxlength="256" placeholder="" required autocomplete="off">
    </div>
    <div class=" col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <label>Responsable:</label>
      <input type="text" class="form-control" name="nResponsable" id="nResponsable"  maxlength="100" placeholder="" autocomplete="off">
    </div>
  </div>
  <div class="row">
    <div class=" col-lg-2 col-md-2 col-sm-2 col-xs-12">
      <label>Versión:</label>
      <input type="text" class="form-control" name="nVersión" id="nVersión"  maxlength="200" placeholder="" autocomplete="off">
    </div>
    <div class=" col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <label>Tipo documento:</label>
      <input type="text" class="form-control" name="nTipoDocumento" id="nTipoDocumento" placeholder="" maxlength="80" autocomplete="off">
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar" disabled><i class="fa fa-save"></i> Guardar</button>
      <button class="btn btn-danger" onclick="mostrarform(false)" type="button"><i class="fa fa-arrow-circle-left"></i> Regresar</button>
    </div>
  </div>
  <div class="row">
    <br>
    <br>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div id="fail-label" class="alert alert-warning ocultar-contenido"></div>
      <div id="exito-label" class="alert alert-success ocultar-contenido"></div>
    </div>
  </div>
</form>
