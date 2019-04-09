<form name="formulario" id="formulario" method="POST">
  <div class="row">

    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
      <label>Código documento:</label>
      <input type="hidden" name="iddocumento" id="iddocumento">
      <input type="hidden" name="idsubproceso" id="idsubproceso">
      <input type="text" class="form-control" name="codigodocumento" id="codigodocumento" placeholder="" maxlength="10" required>
    </div>
    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <label>Nombre documento:</label>
      <input type="text" class="form-control" name="nombredocumento" id="nombredocumento" placeholder="" maxlength="60" required>
    </div>
    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <label>Usuario responsable:</label>
      <select id="responsable" name="responsable" class="form-control selectpicker" data-live-search="true" required>
        <option value="">-- Elije --</option>
        <?php
        $usuarios = new Usuario();
        $usuarios ->listarUsuariosActivosController();
        ?>
      </select>
    </div>
    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <label>Última revisión:</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right" id="fecharevision" name="fecharevision" value="<?php echo date('d/m/Y');?>" autocomplete="off" >
      </div>
    </div>

  </div>
  <div class="row">

    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
      <label>Versión:</label>
      <input type="text" class="form-control" name="version" id="version" placeholder="" required autocomplete="off">
    </div>
    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <label>Tipo documento:</label>
      <select id="tipodocumento" name="tipodocumento" class="form-control" required>
        <option value="">-- Elije --</option>
        <?php
        $tipos = new TipoDocumento();
        $tipos ->listarTiposActivosController();
        ?>
      </select>
    </div>
    <div class=" form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <label for="lblcargardoctos">Cargar Documento (PDF, Word, Excel)</label>
      <input type="file" name="archivo" id="archivo" required>
    </div>

  </div>

  <div class="row">

    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
      <button class="btn btn-danger" onclick="mostrarform(false)" type="button"><i class="fa fa-arrow-circle-left"></i> Regresar</button>
    </div>

  </div>
    <div class="row">
      <br>
      <div class="col-lg-12">
        <div id="fail-label" class="alert alert-warning ocultar-contenido"></div>
        <div id="exito-label" class="alert alert-success ocultar-contenido"></div>
      </div>
    </div>
  </form>
