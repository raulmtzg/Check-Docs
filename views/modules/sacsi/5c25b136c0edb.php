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
              <!-- <h1 class="box-title">PROCEDIMIENTOS</h1>
              <button type="button" class="btn bg-navy margin"> <i class="fa fa-plus-circle"></i> Nuevo</button> -->
              <ol class="breadcrumb ">
                <li>Sistemas</li>
                <li>Procedimientos</li>
                <li class="active"><a href="#"><i class="fa fa-plus-circle"></i> Nuevo</a></li>
              </ol>
            </div>

            <div class="panel-body table-responsive" id="listadoregistros">
                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <!-- <th class="text-center">FECHA ALTA</th>                   -->
                    <th>ID</th>
                    <th class="text-center">Código</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Responsable</th>
                    <th class="text-center">Versión</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Última revisión</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td><i class="fa fa-file-text-o" aria-hidden="true"></i> 4852 </td>
                      <td>SIS-PROD21</td>
                      <td>Procedimiento de Sistemas</td>
                      <td>Admin</td>
                      <td>0</td>
                      <td>Procedimiento</td>
                      <td>2019-01-25</td>
                    </tr>
                  </tbody>

                </table>
            </div>

          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <?php
    include "./views/modules/footer.php";
   ?>
    </body>
