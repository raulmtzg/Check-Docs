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
 <!-- ============================================================== -->
 <!-- Page wrapper  -->
 <!-- ============================================================== -->
 <div class="page-wrapper">

     <!-- ============================================================== -->
     <!-- Container fluid  -->
     <!-- ============================================================== -->
     <div class="container-fluid">
         <!-- ============================================================== -->
         <!-- Bread crumb and right sidebar toggle -->
         <!-- ============================================================== -->
         <div class="row page-titles">
             <div class="col-md-5 align-self-center">
                 <h3 class="text-themecolor">Configuración de página de inicio</h3>
             </div>
             <div class="col-md-7 align-self-center">
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item">
                         <a href="javascript:void(0)">Home</a>
                     </li>
                     <li class="breadcrumb-item">pages</li>
                     <li class="breadcrumb-item active">Blank Page</li>
                 </ol>
             </div>
         </div>
         <!-- ============================================================== -->
         <!-- End Bread crumb and right sidebar toggle -->
         <!-- ============================================================== -->

         <!-- ============================================================== -->
         <!-- Start Page Content -->
         <!-- ============================================================== -->
         <div class="row">
           <div class="col-lg-7 col-sm-7 col-sm-12 col-xs-12">
             <div class="card">
               <div class="card-body">
                 <h4 class="card-title"><span class="lstick"></span>Datos para página de Inicio</h4>
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
             </div>
           </div>

           <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
             <div class="card">
               <div class="card-body">
                 <h4 class="card-title"><span class="lstick"></span>Logotipo empresa</h4>
                 <!-- <img class="card-img-top img-responsive" src="../assets/images/big/img1.jpg" alt="Card image cap"> -->
                 <div id="data-loading" class="text-center">
                   <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>
                   <span class="sr-only">Loading...</span>
                 </div>
                 <div id="data-content" class="text-center ocultar-contenido">
                   <img id="logoempresa" src="views/img/loading.gif" class="card-img-top img-responsive " alt="Logotipo">
                 </div>
                 <div class="col-md-12">
                   <br>
                    <button type="button" class="btn btn-block btn-outline-info" data-toggle="modal" data-target="#myModal">Cambiar logotipo</button>
                 </div>
               </div>
             </div>

           </div>

         </div> <!-- Fin Row Principal -->
         <!-- ============================================================== -->
         <!-- End PAge Content -->
         <!-- ============================================================== -->
     </div>
     <!-- ============================================================== -->
     <!-- End Container fluid  -->
     <!-- ============================================================== -->

     <!-- ============================================================== -->
     <!-- Modal para cambiar el logotipo  -->
     <!-- ============================================================== -->
     <div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form name="formularioLogo" id="formularioLogo" method="POST">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Cambiar Logo Empresa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
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
              <button type="submit" id="btnCambiarLogo" class="btn btn-outline-info" ><i class="fa fa-save"></i> Guardar</button>
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
              <!-- <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button> -->
            </div>
          </form>
        </div>
      </div>
     </div>

 <?php
  include "footer.php";
 ?>
 <script type="text/javascript" src="views/js/functions/admin_inicio.js"></script>
 </body>
 </html>
