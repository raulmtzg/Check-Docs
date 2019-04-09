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
                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <!-- <th class="text-center">FECHA ALTA</th>                   -->
                    <th></th>
                    <th>ID</th>
                    <th class="text-center">CÓDIGO</th>
                    <th class="text-center">NOMBRE</th>
                    <th class="text-center">RESPONSABLE</th>
                    <th class="text-center">VERSIÓN</th>
                    <th class="text-center">TIPO</th>
                    <th class="text-center">ÚLTIMA REVISIÓN</th>
                    <th class="text-center">ESTADO</th>
                    <th class="text-center">OPCIONES</th>

                  </thead>
                  <tbody>
                    <tr class="derecho fila-proceso" data-id="uno">
                      <td class="documento-aprobado">
                        <!-- <span data-toggle="tooltip" data-placement="top" title="Aprobado">&nbsp;</span> -->
                      </td>
                      <td ><i class="fa fa-file-text-o icon-color-info" aria-hidden="true"></i> 4852 </td>
                      <td>SIS-PROD-1</td>
                      <td>Procedimiento de Sistemas</td>
                      <td>Admin</td>
                      <td>0</td>
                      <td>Procedimiento</td>
                      <td>2019-01-25</td>
                      <td class="text-center"><span class="label bg-green">ACTIVO</span></td>
                      <td class="text-center">
                         <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Enviar" onclick="">
                           <i class="fa fa-paper-plane-o icon-color-info"></i>
                         </button>
                         <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Enviar" onclick="">
                           <i class="fa fa-refresh icon-color-success" aria-hidden="true" ></i>
                         </button>
                      </td>
                    </tr>
                    <tr class="derecho fila-proceso" data-id="dos">
                      <td class="documento-revision">
                        <!-- <span data-toggle="tooltip" data-placement="top" title="Revisión">&nbsp;</span> -->
                      </td>
                      <td><i class="fa fa-file-text-o icon-color-info" aria-hidden="true"></i> 4852 </td>
                      <td>SIS-PROD-2</td>
                      <td>Procedimiento de Sistemas</td>
                      <td>Admin</td>
                      <td>0</td>
                      <td>Procedimiento</td>
                      <td>2019-01-25</td>
                      <td class="text-center"><span class="label bg-warning">REVISIÓN</span></td>
                      <td class="text-center">
                         <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Enviar" onclick="">
                           <i class="fa fa-paper-plane-o icon-color-info"></i>
                         </button>
                      </td>
                    </tr>
                    <tr class="derecho fila-proceso" data-id="tres">
                      <td class="documento-edicion">
                        <!-- <span data-toggle="tooltip" data-placement="top" title="Edición">&nbsp;</span> -->
                      </td>
                      <td><i class="fa fa-file-text-o icon-color-info" aria-hidden="true"></i> 4852 </td>
                      <td>SIS-PROD-2</td>
                      <td>Procedimiento de Sistemas</td>
                      <td>Admin</td>
                      <td>0</td>
                      <td>Procedimiento</td>
                      <td>2019-01-25</td>
                      <td class="text-center"><span class="label bg-info">EDICIÓN</span></td>
                      <td class="text-center">
                         <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Enviar" onclick="">
                           <i class="fa fa-paper-plane-o icon-color-info"></i>
                         </button>
                      </td>
                    </tr>
                  </tbody>

                </table>
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
